<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Home extends CI_Controller {
        public function index()
        {
            $this->load->view('Home/index');
        }
        public function Register()
        {
            $this->session->set_userdata('test', $_FILES['profilepic']);


            var_dump($this->input->post('profilepic'));


            $this->load->model("User");
            $errors = array();
            if(empty($this->input->post('FirstName'))){
                $errors[] = "First name must not be left blank!";
            }
            if(empty($this->input->post('LastName'))){
                $errors[] = "Last name must not be left blank!";
            }
            if(empty($this->input->post('Email'))){
                $errors[] = "Email must not be left blank!";
            }
            if(empty($this->input->post('Password'))){
                $errors[] = "Password must not be left blank!";
            }
            if($this->input->post('Password') != $this->input->post("ConfirmPassword")){
                $errors[] = "Password and password confirmation must match each other!";
            }
            if(filter_var($this->input->post('Email'), FILTER_VALIDATE_EMAIL) == false){
                $errors[] = "Email must be a valid email address!";
            }
            if(count($errors) == 0){
               
                $this->load->helper('string');
                $config['upload_path'] = "./assets/profilePictures/";
                $config['remove_spaces'] = TRUE;
                $config['allowed_types'] = 'jpeg|jpg|png';
                $filename = str_replace(' ', '', $_FILES['profilepic']['name']);
                $config['file_name'] = $filename;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('profilepic');

                $Salt = bin2hex(openssl_random_pseudo_bytes(22));
                $EncryptedPassword = md5($this->input->post('Password') . '' . $Salt);
                $user_details = array(
                    'FirstName' => $this->input->post('FirstName'),
                    'LastName' => $this->input->post('LastName'),
                    'Email' => $this->input->post('Email'),
                    'Password' => $EncryptedPassword,
                    'Salt' => $Salt,
                    'ProfilePicUrl' => "/assets/profilePictures/" . $filename,
                );
                $registered_user = $this->User->CreateUser($user_details);
                if($registered_user == true) {
                    $signin_details = array(
                        "Email" => $this->input->post('Email'),
                        "Password" => $this->input->post("Password"),
                    );
                    $logged_user = $this->User->Login($signin_details);

                    if($logged_user == true){
                        $EncryptedPassword = md5($this->input->post("Password") . '' . $logged_user['Salt']);
                        if($logged_user['Password'] == $EncryptedPassword){
                            $this->session->set_userdata('UserId', $logged_user['UserId']);

                            $this->load->model('Playlist_Model');
                            $this->Playlist_Model->Create("Likes", $logged_user['UserId']);
                            
                            redirect('http://localhost:8888/dashboard/' . $this->session->userdata('UserId'));
                        }
                        else
                        {
                            $this->session->set_flashdata('EncryptPassCheck', 'Password is not correct!');
                            redirect('http://localhost:8888/');
                        }
                    }
                }
                else
                {
                    $this->session->set_flashdata('Error', 'Could not create user.');
                    redirect('http://localhost:8888/');
                }
            }
            else
            {
                $this->session->set_flashdata('errors', $errors);
                $this->session->set_flashdata('message', 'Failed to register user!');
                redirect('http://localhost:8888/');
            }
            // redirect('http://localhost:8888/');
        }
        
        public function login(){
            $this->load->model("User");
            $errors = array();
            if(empty($this->input->post('Email'))){
                $errors[] = "Email must be provided to sign in.";
            }
            if(empty($this->input->post('Password'))){
                $errors[] = "Password must be provided sign in.";
            }
            if(count($errors) == 0){
                $signin_details = array(
                    "Email" => $this->input->post('Email'),
                    "Password" => $this->input->post("Password"),
                );
                $logged_user = $this->User->Login($signin_details);

                if($logged_user == true){
                    $EncryptedPassword = md5($this->input->post("Password") . '' . $logged_user['Salt']);
                    if($logged_user['Password'] == $EncryptedPassword){
                        $this->session->set_userdata('UserId', $logged_user['UserId']);
                        $this->session->set_userdata('Prestine', FALSE);
                        $this->session->set_userdata('2prestine2', FALSE);
                        $this->session->set_userdata('3count3', 0);
                        $this->session->set_userdata('4count4', 0);
                        redirect('http://localhost:8888/dashboard/' . $this->session->userdata('UserId'));
                    }
                    else
                    {
                        $this->session->set_flashdata('EncryptPassCheck', 'Password is not correct!');
                        redirect('http://localhost:8888/');
                    }
                }
                else
                {
                    redirect('http://localhost:8888/');
                }
            }
            else
            {
                $this->session->set_flashdata('errors', $errors);
                $this->session->set_flashdata('message', "Failed to sign in!");
                redirect('http://localhost:8888/');
            }
        }
        
        public function user_dashboard($Id){
            $this->load->model('User');
            $this->load->model('Song_Model');
            $this->load->model('Like_Model');
            $this->load->model('Friend_Model');
            $user = $this->User->Show($Id);
            $songs = $this->Song_Model->get_All_Songs();
            $likes = $this->Like_Model->getUsersLikes($this->session->userdata('UserId'));

            $pendingRequests = $this->Friend_Model->getPendingFriendRequests($user);
            $playlist = array();
            $friends = array();

            for($i = 0; $i < count($likes); $i++){
                $track = $this->Song_Model->get_song_by_id($likes[$i]['SongId']);
                array_push($playlist, $track);
            }

            $unwrappedFriendsList = NULL;
            $pendingSentRequests = array();
            $pendingReceivedRequests = array();
            
            // Getting all users who sent friend requests to this user.
            for($i = 0; $i < count($pendingRequests); $i++){
                if($pendingRequests[$i]['Sender'] == $user['UserId']){
                    // Users the logged in user has sent requests to.
                    $receipient = $this->User->Show($pendingRequests[$i]['Receiver']);
                    array_push($pendingSentRequests, $receipient);
                } else {
                    // Users who've sent requests to logged in user.
                    $sender = $this->User->Show($pendingRequests[$i]['Sender']);
                    array_push($pendingReceivedRequests, $sender);
                }
            }

            

            $view_data['loggedUser'] = array(
                'IdNumber' => $user['UserId'],
                'FirstName' => $user['FirstName'],
                'LastName' => $user['LastName'],
                'Email' => $user['Email'],
                'pendingrequests' => $pendingRequests,
                'sentRequests' => $pendingSentRequests,
                'receivedRequests' => $pendingReceivedRequests,
                'friends' => $friends,
                'user' => $user,
                'likes' => $likes,
            );
            $view_data['songs'] = array(
                'AllSongs' => $songs,
            );
            $view_data['liked_songs'] = array(
                'Playlist' => $playlist,
            );

            $this->load->view('Home/dashboard', $view_data);

        }

        public function show($Id){
            $this->load->model('Song_Model');
            $this->load->model('Like_Model');
            $this->load->model('Message_Model');
            $this->load->model('User');
            $this->load->model('Comment_Model');
            $this->load->model('Friend_Model');
            $user = $this->User->Show($Id);
            $logged_user  = $this->User->Show($this->session->userdata('UserId'));
            $packaged_messages = $this->Message_Model->getWallPosts($Id);
            $comments = $this->Comment_Model->getAllWallPostComments($Id);

            $messages = array();

            for($i = 0; $i < count($packaged_messages); $i++){

                $message = array();
                $message_sender = $this->User->Show($packaged_messages[$i]['Sender']);
                array_push($message, $packaged_messages[$i]);
                array_push($message, $message_sender);

                $packaged_comments = [$this->Comment_Model->commentsBelongingToMessage($packaged_messages[$i]['MessageId'])];
                $comments = array();

                for($x = 0; $x < count($packaged_comments); $x++){
                    $comment = array();
                    array_push($comment, $packaged_comments[$x]);

                    $commentPoster = $this->User->Show($packaged_comments[$x]['PosterId']);
                    array_push($comment, $commentPoster);

                    array_push($comments, $comment);
                }


                array_push($message, $comments);

                array_push($messages, $message);

            };

            $playlist = array();
            $likes = $this->Like_Model->getUsersLikes($Id);
            for($i = 0; $i < count($likes); $i++){
                $track = $this->Song_Model->get_song_by_id($likes[$i]['SongId']);
                array_push($playlist, $track);
                // var_dump($likes[$i]['SongId']);
            }
            $pendingRequests = $this->Friend_Model->getPendingFriendRequests($user);
            
            $friends = $this->Friend_Model->getUserFriendsList($Id);
            $DisplayedUserFriendsList = array();
            $decodedFriendRequests = array();

            $view_data['loggedUser'] = array(
                'IdNumber' => $logged_user['UserId'],
                'FirstName' => $logged_user['FirstName'],
                'LastName' => $logged_user['LastName'],
                'Email' => $logged_user['Email'],
                'pendingrequests' => $pendingRequests,
                'friends' => $friends,
                'user' => $logged_user,
                'Url' => $logged_user['ProfilePicUrl'],
                'messages' => $messages,
                // 'likes' => $userlikes,
            );
            $view_data['messages4song'] = array(
                'Messages' => $messages,
            );
            $view_data['UserToBeShown'] = array(
                'Id' => $user['UserId'],
                'Name' => $user['FirstName'] . ' ' . $user['LastName'],
                'FirstName' => $user['FirstName'],
                'Url' => $user['ProfilePicUrl'],
                'Friends' => $DisplayedUserFriendsList,
                'Playlist' => $playlist,
            );
            $this->load->view('Home/wall', $view_data);
        }


        public function sendFriendRequest($userid, $possibleFriendId)
        {
        }

        public function processIncomingRequests($userid, $possibleFriendId, $decision) // sender, receiver, yes or no accept request
        {
            $this->load->Model('FriendModel');
            $logged_user = $this->User->Show($userid);
            
            redirect('http://localhost:8888/dashboard/' . $this->session->userdata('UserId'));

        }

        public function edit(){
            $this->load->model('User');
            $decodedFriendRequests = array();
            $user = $this->User->Show($this->session->userdata('UserId'));
            $unwrappedRequests = json_decode($user['PendingFriendRequests'], true);
            if($unwrappedRequests != null){
                for($x = 0; $x < count($unwrappedRequests); $x++){
                    $requestReceiver = $this->User->Show($unwrappedRequests[$x]['RequestReceiverId']);
                    $requestSender = $this->User->Show($unwrappedRequests[$x]['RequestSenderId']);
                    $request = array("Sender" => $requestSender, "Receiver" => $requestReceiver);
                    array_push($decodedFriendRequests, $request);
                }
            }
            $view_data['loggedUser'] = array(
                'IdNumber' => $user['UserId'],
                'FirstName' => $user['FirstName'],
                'LastName' => $user['LastName'],
                'Email' => $user['Email'],
                'pendingrequests' => $decodedFriendRequests,
                'user' => $user,
            );
            $this->load->view('Home/edit', $view_data);
        }

        public function logout(){
            session_destroy();
            redirect('http://localhost:8888/');
        }

        public function update(){
            $this->load->model("User");
            $errors = array();
            if(empty($this->input->post('FirstName'))){
                $errors[] = "First name must be filled out!";
            }
            if(empty($this->input->post('LastName'))){
                $errors[] = "Last name must filled out!";
            }
            if(empty($this->input->post('Email'))){
                $errors[] = "Email must be filled out!";
            }
            if(filter_var($this->input->post('Email'), FILTER_VALIDATE_EMAIL) == false){
                $errors[] = "Email must be in valid email format!";
            }
            if(count($errors) == 0){
                $user_details = array(
                    'FirstName' => $this->input->post('FirstName'),
                    'LastName' => $this->input->post('LastName'),
                    'Email' => $this->input->post('Email'),
                );
                $update_user = $this->User->edit_Update($user_details, $this->session->userdata('UserId'));
                redirect('http://localhost:8888/edit');
            }
            else
            {
                $this->session->set_flashdata('errors', $errors);
                $this->session->set_flashdata('message', 'Update failed!');
                redirect('http://localhost:8888/edit');
            }
        }
        public function updatePassword(){
            $this->load->model('User');
            $errors = array();
            if(empty($this->input->post('Password'))){
                $errors[] = "Password must be filled out!";
            }
            if($this->input->post('Password') != $this->input->post("ConfirmPassword")){
                $errors[] = "Password and password confirmation must match each other!";
            }
            if(count($errors) == 0){
                $Salt = bin2hex(openssl_random_pseudo_bytes(22));
                $EncryptedPassword = md5($this->input->post('Password'). '' . $Salt);
                $user_details = array(
                    'Password' => $EncryptedPassword,
                    'Salt' => $Salt,
                );
                $update_user = $this->User->updateMyPassword($user_details, $this->session->userdata('UserId'));
                $this->session->set_flashdata('message', 'Password successfully changed!');
                redirect('http://localhost:8888/edit');
            }
            else
            {
                $this->session->set_flashdata('1test1', $this->input->post('Password'));
                $this->session->set_flashdata('7test7', $this->input->post('ConfirmPassword'));
                $this->session->set_flashdata('errors', $errors);
                $this->session->set_flashdata('message', 'Failed to update password!');
                redirect('http://localhost:8888/edit');
            }
        }
        public function updateProfilePic(){
            $this->load->helper('string');
            $config['upload_path'] = "./assets/images/";
            $config['remove_spaces'] = TRUE;
            $config['allowed_types'] = 'jpeg|jpg|png';
            $filename = str_replace(' ', '', $_FILES['profilepic']['name']);
            $config['file_name'] = $filename;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload('profilepic');

            $this->load->model('User');
            $url = "/assets/images/" . $_FILES['profilepic']['name'];
            $update_profilepic = $this->User->updateMyProfilePic($url, $this->session->userdata('UserId'));
            if($update_profilepic == true)
            {
                $this->session->set_flashdata('profilepicupdateresult', "Profile pic successfully updated");
                redirect('http://localhost:8888/edit');
            }
            else
            {
                $this->session->set_flashdata('profilepicupdateresult', "failed to update profile pic");
                redirect('http://localhost:8888/edit');
            }
        }
        
        public function deleteUser() {
            $this->load->model('Playlist_Model');
            $this->load->model('Song_Model');
            $this->load->model('Like_Model');
            $this->load->model('User');

            $playlists = $this->Playlist_Model->getUserPlaylists($this->session->userdata('UserId'));
            
            if($playlists && count($playlists) > 0) {
                for($x = 0; $x < count($playlists) - 1; $x++) {
                    $this->Playlist_Model->deleteAllTracksFromPlaylist($playlists[$x]['PlaylistId']);
                }
            }

            $playlists = $this->Playlist_Model->deleteUsersPlaylists($this->session->userdata('UserId'));

            $likes = $this->Like_Model->deleteAllOfUserLikes($this->session->userdata('UserId'));

            $songs = $this->Song_Model->deleteAllSongsUploadedByUser($this->session->userdata('UserId'));

            $user = $this->User->delete($this->session->userdata('UserId'));
            
            // $user = $this->User->Show($this->session->userdata('UserId'));
            redirect('http://localhost:8888/');
            // var_dump(array("UserId" => $this->session->userdata('UserId'), "Response" => $user ));
        }
    }

?>