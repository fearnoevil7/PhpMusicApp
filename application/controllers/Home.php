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



            $this->load->helper('string');
            $config['upload_path'] = "./assets/images/";
            $config['remove_spaces'] = TRUE;
            $config['allowed_types'] = 'jpeg|jpg|png';
            $filename = str_replace(' ', '', $_FILES['profilepic']['name']);
            $config['file_name'] = $filename;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload('profilepic');



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
                $Salt = bin2hex(openssl_random_pseudo_bytes(22));
                $EncryptedPassword = md5($this->input->post('Password') . '' . $Salt);
                $user_details = array(
                    'FirstName' => $this->input->post('FirstName'),
                    'LastName' => $this->input->post('LastName'),
                    'Email' => $this->input->post('Email'),
                    'Password' => $EncryptedPassword,
                    'Salt' => $Salt,
                    'ProfilePicUrl' => "/assets/images/" . $_FILES['profilepic']['name'],
                );
                $registered_user = $this->User->CreateUser($user_details);
                if($registered_user == true)
                {
                    redirect('http://localhost:8888/');
                }
                else
                {
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
            $user = $this->User->Show($Id);
            $songs = $this->Song_Model->get_All_Songs();
            $likes = $this->Like_Model->getUsersLikes($this->session->userdata('UserId'));
            $playlist = array();
            $friends = array();
            // var_dump($likes);
            for($i = 0; $i < count($likes); $i++){
                $track = $this->Song_Model->get_song_by_id($likes[$i]['SongId']);
                array_push($playlist, $track);
                // var_dump($likes[$i]['SongId']);
            }
            $unwrappedFriendsList = json_decode($user['FriendsList']);
            $unwrappedRequests = json_decode($user['PendingFriendRequests'], true);
            $decodedFriendRequests = array();
            if($unwrappedRequests != null){
                for($x = 0; $x < count($unwrappedRequests); $x++){
                    $requestReceiver = $this->User->Show($unwrappedRequests[$x]['RequestReceiverId']);
                    $requestSender = $this->User->Show($unwrappedRequests[$x]['RequestSenderId']);
                    $request = array("Sender" => $requestSender, "Receiver" => $requestReceiver);
                    array_push($decodedFriendRequests, $request);
                }
            }
            if($unwrappedFriendsList != null){
                for($z = 0; $z < count($unwrappedFriendsList); $z++){
                    $friend = $this->User->Show($unwrappedFriendsList[$z]);
                    array_push($friends, $friend);
                }
            }
            $view_data['loggedUser'] = array(
                'IdNumber' => $user['UserId'],
                'FirstName' => $user['FirstName'],
                'LastName' => $user['LastName'],
                'Email' => $user['Email'],
                'pendingrequests' => $decodedFriendRequests,
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
            $user = $this->User->Show($Id);
            $logged_user  = $this->User->Show($this->session->userdata('UserId'));
            $messages = $this->Message_Model->getWallPosts($Id);
            $comments = $this->Comment_Model->getAllWallPostComments();
            $playlist = array();
            $likes = $this->Like_Model->getUsersLikes($Id);
            for($i = 0; $i < count($likes); $i++){
                $track = $this->Song_Model->get_song_by_id($likes[$i]['SongId']);
                array_push($playlist, $track);
                // var_dump($likes[$i]['SongId']);
            }
            $friends = array();
            $DisplayedUserFriendsList = array();
            $decodedFriendRequests = array();
            $unwrappedFriendsList = json_decode($logged_user['FriendsList']);
            $unwrappedRequests = json_decode($logged_user['PendingFriendRequests'], true);
            $DisplayedUserUnwrappedFriendsList = json_decode($user['FriendsList']);
            if($unwrappedRequests != null){
                for($x = 0; $x < count($unwrappedRequests); $x++){
                    $requestReceiver = $this->User->Show($unwrappedRequests[$x]['RequestReceiverId']);
                    $requestSender = $this->User->Show($unwrappedRequests[$x]['RequestSenderId']);
                    $request = array("Sender" => $requestSender, "Receiver" => $requestReceiver);
                    array_push($decodedFriendRequests, $request);
                }
            }
            if($unwrappedFriendsList != null){
                for($z = 0; $z < count($unwrappedFriendsList); $z++){
                    $friend = $this->User->Show($unwrappedFriendsList[$z]);
                    array_push($friends, $friend);
                }
            }
            if($DisplayedUserUnwrappedFriendsList != null){
                for($r = 0; $r < count($DisplayedUserUnwrappedFriendsList); $r++){
                    $friend = $this->User->Show($DisplayedUserUnwrappedFriendsList[$r]);
                    array_push($DisplayedUserFriendsList, $friend);
                }
            }
            $view_data['loggedUser'] = array(
                'IdNumber' => $logged_user['UserId'],
                'FirstName' => $logged_user['FirstName'],
                'LastName' => $logged_user['LastName'],
                'Email' => $logged_user['Email'],
                'pendingrequests' => $decodedFriendRequests,
                'friends' => $friends,
                'user' => $logged_user,
                'Url' => $logged_user['ProfilePicUrl']
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
            $view_data['comments'] = array(
                'allcomments' => $comments,
            );
            $this->load->view('Home/wall', $view_data);
        }


        public function sendFriendRequest($userid, $prospectfriendid)
        {
            $this->load->model('User');
            $user = $this->User->Show($prospectfriendid);
            $sender = $this->User->Show($this->session->userdata('UserId'));
            $friendslist = json_decode($user['FriendsList']);
            $friendrequests = json_decode($user['PendingFriendRequests'], true);
            $senderrequests = json_decode($sender['PendingFriendRequests'], true);
            // for($i = 0; $i < count($friendslist); $i++){
            //     if($friendslist[$i] == $this->session->userdata('UserId')){
            //         redirect('http://localhost:8888/user/show/' . $prospectfriendid);
            //     }
            // }
            if($friendrequests != null){
                for($q = 0; $q < count($friendrequests); $q++){
                    if($friendrequests[$q]['RequestSenderId'] == $prospectfriendid && $friendrequests[$q]['RequestReceiverId'] == $this->session->userdata('UserId') || $friendrequests[$q]['RequestSenderId'] == $this->session->userdata('UserId') & $friendrequests[$q]['RequestReceiverId'] == $prospectfriendid){
                        redirect('http://localhost:8888/user/show/' . $prospectfriendid);
                    }
                }
                $requestDetails = array("RequestSenderId" => $this->session->userdata('UserId'), "RequestReceiverId" => $prospectfriendid);
                array_push($friendrequests, $requestDetails);
                $request = $this->User->sendRequest($prospectfriendid, $friendrequests);
            } else {
                $friendrequests2 = array();
                $requestDetails = array("RequestSenderId" => $this->session->userdata('UserId'), "RequestReceiverId" => $prospectfriendid);
                array_push($friendrequests2, $requestDetails);
                $request = $this->User->sendRequest($prospectfriendid, $friendrequests2);
            }




            if($senderrequests != null){
                for($q = 0; $q < count($senderrequests); $q++){
                    if($friendrequests[$q]['RequestSenderId'] == $prospectfriendid && $friendrequests[$q]['RequestReceiverId'] == $this->session->userdata('UserId') || $friendrequests[$q]['RequestSenderId'] == $this->session->userdata('UserId') && $friendrequests[$q]['RequestReceiverId'] == $prospectfriendid){
                        redirect('http://localhost:8888/user/show/' . $prospectfriendid);
                    }
                }
                $requestDetails = array("RequestSenderId" => $this->session->userdata('UserId'), "RequestReceiverId" => $prospectfriendid);
                array_push($senderrequests, $requestDetails);
                $request = $this->User->sendRequest($this->session->userdata('UserId'), $senderrequests);
            } else {
                $senderrequests2 = array();
                $requestDetails = array("RequestSenderId" => $this->session->userdata('UserId'), "RequestReceiverId" => $prospectfriendid);
                array_push($senderrequests2, $requestDetails);
                $request = $this->User->sendRequest($this->session->userdata('UserId'), $senderrequests2);
            }
            // $this->session->userdata('test1', $friendrequests);


            // for($i = 0; $i < count($friendrequests); $i++){
            // }
            redirect('http://localhost:8888/user/show/' . $prospectfriendid);
        }
        public function acceptFriendRequest($userid, $prospectfriendid)
        {
            $this->load->Model('User');
            $user = $this->User->Show($prospectfriendid);
            $logged_user = $this->User->Show($this->session->userdata('UserId'));
            $friendrequests = json_decode($logged_user['PendingFriendRequests'], TRUE);
            $senderFriendsrequests = json_decode($user['PendingFriendRequests'], TRUE);
            $friendslist = json_decode($logged_user['FriendsList']);
            $senderFriendsList = json_decode($user['FriendsList']);
            // array_push($senderFriendsList, $this->session->userdata('UserId'));
            // $confirmed_request2 = $this->User->confirmRequest($prospectfriendid, $senderFriendsList);
            // $this->session->set_userdata('arraytest', $this->session->userdata('UserId'));
            if($friendrequests != null){
                for($q = 0; $q < count($friendrequests); $q++){
                    if($friendrequests[$q]['RequestSenderId'] == $prospectfriendid && $friendrequests[$q]['RequestReceiverId'] == $this->session->userdata('UserId')){
                        $temp = $friendrequests[$q];
                        $friendrequests[$q] = $friendrequests[count($friendrequests) - 1];
                        $friendrequests[count($friendrequests) - 1] = $temp;
                    }
                    array_pop($friendrequests);
                    
                }
                
            }
            else
            {
                redirect('http://localhost:8888/dashboard/' . $this->session->userdata('UserId'));
            }
            if($senderFriendsrequests != null){
                for($q = 0; $q < count($senderFriendsrequests); $q++){
                    if($senderFriendsrequests[$q]['RequestSenderId'] == $prospectfriendid && $senderFriendsrequests[$q]['RequestReceiverId'] == $this->session->userdata('UserId')){
                        $temp = $senderFriendsrequests[$q];
                        $senderFriendsrequests[$q] = $senderFriendsrequests[count($senderFriendsrequests) - 1];
                        $senderFriendsrequests[count($senderFriendsrequests) - 1] = $temp;
                        
                    }
                    array_pop($senderFriendsrequests);
                    
                }
                
            }
            else
            {
                redirect('http://localhost:8888/dashboard/' . $this->session->userdata('UserId'));
            }



            if($senderFriendsList == null){
                $senderFriendsList = array();
                array_push($senderFriendsList, $this->session->userdata('UserId'));
                $confirmed_request = $this->User->confirmRequest($prospectfriendid, $senderFriendsList);
                $remove_from_pendingRequests = $this->User->sendRequest($prospectfriendid, $senderFriendsrequests);
            }
            else
            {
                array_push($senderFriendsList, $this->session->userdata('UserId'));
                $confirmed_request = $this->User->confirmRequest($prospectfriendid, $senderFriendsList);
                $remove_from_pendingRequests = $this->User->sendRequest($prospectfriendid, $senderFriendsrequests);
            }
            if($friendslist != null){
                for($q = 0; $q < count($friendslist); $q++){
                    if($friendslist[$q] == $prospectfriendid){
                        redirect('http://localhost:8888/dashboard/' . $this->session->userdata('UserId'));
                    }
                }
                array_push($friendslist, $prospectfriendid);
                $confirmed_request = $this->User->confirmRequest($this->session->userdata('UserId'), $friendslist);
                $remove_from_pendingRequests = $this->User->sendRequest($this->session->userdata('UserId'), $friendrequests);
                // redirect('http://localhost:8888/dashboard/' . $this->session->userdata('UserId'));
            } 
            else
            {
                $friendslist2 = array();
                array_push($friendslist2, $prospectfriendid);
                $confirmed_request = $this->User->confirmRequest($this->session->userdata('UserId'), $friendslist2);
                $remove_from_pendingRequests = $this->User->sendRequest($this->session->userdata('UserId'), $friendrequests);
                // redirect('http://localhost:8888/dashboard/' . $this->session->userdata('UserId'));
            }
            
            
            redirect('http://localhost:8888/dashboard/' . $this->session->userdata('UserId'));


            // if($this->input->post('boolean') == 'FALSE'){
            //     if($friendrequests != null){
            //         for($q = 0; $q < count($friendrequests); $q++){
            //             if($friendrequests[$q] == $prospectfriendid){
            //                 $temp = $friendrequests[$q];
            //                 $friendrequests[$q] = $friendrequests[count($friendrequests) - 1];
            //                 $friendrequests[count($friendrequests) - 1] = $temp;
            //             }
            //             array_pop($friendrequests);
            //         }
            //     }
            //     else
            //     {
            //         redirect('http://localhost:8888/dashboard/' . $this->session->userdata('UserId'));
            //     }
            //     $remove_request = $this->User->sendRequest($this->session->userdata('UserId'), $friendrequests);
            //     redirect('http://localhost:8888/dashboard/' . $this->session->userdata('UserId'));
            // }
        }
        public function declineFriendRequest($userid, $prospectfriendid)
        {
            $this->load->Model('User');
            $logged_user = $this->User->Show($this->session->userdata('UserId'));
            $receiver = $this->User->Show($prospectfriendid);
            $receiver_requests = json_decode($receiver['PendingFriendRequests'], true);
            $friendrequests = json_decode($logged_user['PendingFriendRequests'], true);
            if($friendrequests != null){
                for($q = 0; $q < count($friendrequests); $q++){
                    if($this->input->post('boolean') == 'FALSE'){
                        if($friendrequests[$q]['RequestSenderId'] == $prospectfriendid && $friendrequests[$q]['RequestReceiverId'] == $this->session->userdata('UserId')){
                            $temp = $friendrequests[$q];
                            $friendrequests[$q] = $friendrequests[count($friendrequests) - 1];
                            $friendrequests[count($friendrequests) - 1] = $temp;
                        }
                    }
                    else
                    {
                        if($this->input->post('boolean') == 'TRUE'){
                            if($friendrequests[$q]['RequestReceiverId'] == $prospectfriendid && $friendrequests[$q]['RequestSenderId'] == $this->session->userdata('UserId')){
                                $temp = $friendrequests[$q]; 
                                $friendrequests[$q] = $friendrequests[count($friendrequests) - 1];
                                $friendrequests[count($friendrequests) - 1] = $temp;
                            }
                        }
                    }
                    $this->session->set_userdata('arraytest3', $prospectfriendid);
                    array_pop($friendrequests);
                    $this->session->set_userdata('arraytest', $friendrequests[count($friendrequests) - 1]);
                }
            }
            else
            {
                redirect('http://localhost:8888/dashboard/' . $this->session->userdata('UserId'));
            }
            if($receiver_requests != null){
                for($x = 0; $x < count($receiver_requests); $x++){
                    if($this->input->post('boolean') == 'FALSE'){
                        if($receiver_requests[$x]['RequestSenderId'] == $prospectfriendid && $receiver_requests[$x]['RequestReceiverId'] == $this->session->userdata('UserId')){
                            $temp = $receiver_requests[$x];
                            $receiver_requests[$x] = $receiver_requests[count($receiver_requests) - 1];
                            $receiver_requests[count($receiver_requests) - 1] = $temp;
                        }
                    }
                    else
                    {
                        if($this->input->post('boolean') == 'TRUE'){
                            if($receiver_requests[$x]['RequestReceiverId'] == $this->session->userdata('UserId') && $receiver_requests[$x]['RequestSenderId'] == $prospectfriendid){
                                $temp = $receiver_requests[$x]; 
                                $receiver_requests[$x] = $receiver_requests[count($receiver_requests) - 1];
                                $receiver_requests[count($receiver_requests) - 1] = $temp;
                            }
                        }
                    }
                    $this->session->set_userdata('arraytest5', $prospectfriendid);
                    array_pop($receiver_requests);
                    $this->session->set_userdata('arraytest7', $receiver_requests[count($receiver_requests) - 1]);
                }
            }
            $this->session->set_userdata('arraytest2', $this->input->post('boolean'));
            $remove_request = $this->User->sendRequest($this->session->userdata('UserId'), $friendrequests);
            $remove_request2 = $this->User->sendRequest($prospectfriendid, $receiver_requests);
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
    }

?>