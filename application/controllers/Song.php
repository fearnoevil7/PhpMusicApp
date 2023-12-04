<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Song extends CI_Controller {
        public function New()
        {
            $this->load->model('User');
            $this->load->model('Like_Model');
            $user = $this->User->Show($this->session->userdata('UserId'));

            $view_data['loggedUser'] = array(
                'IdNumber' => $user['UserId'],
                'FirstName' => $user['FirstName'],
                'LastName' => $user['LastName'],
                'Email' => $user['Email'],
                'user' => $user,
            );
            $this->load->view('Song/New', $view_data);
        }

        public function uploadSong() {
            $this->load->helper('string');
            $config['upload_path'] = "./assets/uploads/";
            $config['remove_spaces'] = TRUE;
            $config['allowed_types'] = 'mp4|m4a|mp3|jpeg|jpg';
            $fileName = explode(".", $_FILES['song']['name']);

            // create file extension
            $file_extension = "." . $fileName[count($fileName) - 1];
            unset($fileName[count($fileName) - 1]);
            $fileName = implode("", $fileName);

            // remove special characters from fileName
            $fileName = preg_replace('/[^a-zA-Z0-9_ -]/s','',$fileName);
            //  remove whitespace
            $fileName = preg_replace('/\s+/', '', $fileName);

            $song_name =  $fileName . $file_extension;

            $config['file_name'] = $song_name;
            $this->load->library('upload', $config);
            // $this->upload->do_upload('song');
            $this->upload->initialize($config);
            $this->upload->do_upload('song');
            return $song_name;
        }

        public function Create()
        {
            $data;
            if($this->input->post() != NULL) {
                $data = $_POST;
                // echo $data['Name']
            } else {
                header("Content-Type: application/json");
                $data = json_decode(file_get_contents("php://input"));
                // echo $data->Name;
            }

            $this->load->model("Song_Model");
            $match;
            $this->input->post() ? $match = $this->Song_Model->getSongsByName($data['Name'], $data['Artist']) : $match = $this->Song_Model->getSongsByName($data->Name, $data->Artist);

            if($match) {
                if($this->input->post()) {
                    $this->session->set_flashdata('Error', 'The song is present in database.');
                    redirect('http://localhost:8888/upload/' . $this->session->userdata('UserId'));
                } else {
                    echo json_encode(array("Song" => $match));
                }
            } else {
                $song_details = array(
                    'Name' => $this->input->post() ? $data['Name'] : $data->Name,
                    'Artist' => $this->input->post() ? $data['Artist'] : $data->Artist,
                    'Url' => $this->input->post() ? "/assets/uploads/" . $this->uploadSong() : $data->Url,
                    'UploaderId' => $this->input->post() ? $this->session->userdata('UserId') : NULL,
                    'AlbumTitle' => $this->input->post() ? NULL : $data->AlbumTitle,
                    'PictureUrl' => $this->input->post() ? NULL : $data->Picture,
                    'ApiUrl' => $this->input->post() ? NULL : $data->ApiUrl
                );
    
                $added_song = $this->Song_Model->AddSong($song_details);
                if($this->input->post()) {
                    if($added_song == true) {
                        redirect('http://localhost:8888/dashboard/' . $this->session->userdata('UserId'));
                    }
                    else {
                        redirect('http://localhost:8888/upload/' . $this->session->userdata('UserId'));
                    }
                } else {
                    echo json_encode(array("Song" => $this->input->post() ? $match = $this->Song_Model->getSongsByName($data['Name'], $data['Artist']) : $match = $this->Song_Model->getSongsByName($data->Name, $data->Artist)));
                }
            }     
        }

        public function Show($cancionId)
        {
            $this->load->model('Song_Model');
            $this->load->model('Like_Model');
            $this->load->model('Message_Model');
            $this->load->model('User');
            $this->load->model('Comment_Model');
            $logged_user  = $this->User->Show($this->session->userdata('UserId'));
            $song = $this->Song_Model->get_song_by_id($cancionId);
            $userlikes = $this->Like_Model->getUsersLikes($this->session->userdata('UserId'));
            $messages = $this->Message_Model->getMessages($cancionId);
            $comments = $this->Comment_Model->getAllComments();
            $isLiked = false;
            // var_dump($userlikes);
            for($i=0; $i < count($userlikes); $i++){
                // var_dump($userlikes[$i]['SongId']);
                if($userlikes[$i]['SongId'] == $song['SongId']){
                    $isLiked = true;
                }
            }

            $friends = array();
            $decodedFriendRequests = array();
            $unwrappedFriendsList = json_decode($logged_user['FriendsList']);
            $unwrappedRequests = json_decode($logged_user['PendingFriendRequests'], true);
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
                'IdNumber' => $logged_user['UserId'],
                'FirstName' => $logged_user['FirstName'],
                'LastName' => $logged_user['LastName'],
                'Email' => $logged_user['Email'],
                'pendingrequests' => $decodedFriendRequests,
                'friends' => $friends,
                'user' => $logged_user,
                'likes' => $userlikes,
            );
            $view_data['current_song'] = array(
                'SongId' => $song['SongId'],
                'Name' => $song['Name'],
                'Artist' => $song['Artist'],
                'Url' => $song['Url'],
                'isLiked' => $isLiked,
            );
            $view_data['liked_songs'] = array(
                'Playlist' => $userlikes,
            );
            $view_data['messages4song'] = array(
                'Messages' => $messages,
            );
            $view_data['user'] = array(
                'loggedUser' => $logged_user,
            );
            $view_data['comments'] = array(
                'allcomments' => $comments,
            );
            $this->load->view('Song/Show', $view_data);
        }
        public function getArtist()
        {
            // $url = "";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://deezerdevs-deezer.p.rapidapi.com/artist/" . $this->input->post('Artist'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                // CURLOPT_ENCODING => "",
                // CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                // CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "x-rapidapi-host: deezerdevs-deezer.p.rapidapi.com",
                    "x-rapidapi-key: dd6ffc04a3msh18681626f688b74p186903jsn35bf211cc1c8"
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $data = json_decode($response, true);
                // var_dump($data);
                // $data2 = $data['data'];
                // for($i = 0; $i < count($data['data']); $i++){
                //     echo "<p>" . $data['data'][$i]['title'] . "</p>";
                //     echo "<p>" . $data['data'][$i]['artist']['name'] . "</p>";
                //     echo "<audio src =" . $data['data'][$i]['preview'] . "   controls ></audio><br>";
                // }
                // echo $data['tracklist'];
                $this->session->set_userdata('Artist', $data);
                redirect('http://localhost:8888/Artist');
            }
        }
        public function getTunes()
        {
            // $url = "";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "" . $this->session->userdata('Artist')['tracklist'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                // CURLOPT_ENCODING => "",
                // CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                // CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "x-rapidapi-host: deezerdevs-deezer.p.rapidapi.com",
                    "x-rapidapi-key: dd6ffc04a3msh18681626f688b74p186903jsn35bf211cc1c8"
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
            if ($err) {
                echo "cURL Error #:" . $err;
                $this->session->set_userdata('Prestine', FALSE);
                redirect('http://localhost:8888/register/');
            } else {
                $data = json_decode($response, true);
                // var_dump($data);
                // $data2 = $data['data'];
                // for($i = 0; $i < count($data['data']); $i++){
                //     echo "<p>" . $data['data'][$i]['title'] . "</p>";
                //     echo "<p>" . $data['data'][$i]['artist']['name'] . "</p>";
                //     echo "<audio src =" . $data['data'][$i]['preview'] . "   controls ></audio><br>";
                // }
                // echo $data['tracklist'];
                $this->session->set_userdata('Prestine', TRUE);
                $this->session->set_userdata('test', $data);
                redirect('http://localhost:8888/Artist/');
            }
        }
        public function getStation()
        {
            // $url = "";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://deezerdevs-deezer.p.rapidapi.com/radio/" . $this->input->post('Station'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                // CURLOPT_ENCODING => "",
                // CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                // CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "x-rapidapi-host: deezerdevs-deezer.p.rapidapi.com",
                    "x-rapidapi-key: dd6ffc04a3msh18681626f688b74p186903jsn35bf211cc1c8"
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $data = json_decode($response, true);
                // var_dump($data);
                // $data2 = $data['data'];
                // for($i = 0; $i < count($data['data']); $i++){
                //     echo "<p>" . $data['data'][$i]['title'] . "</p>";
                //     echo "<p>" . $data['data'][$i]['artist']['name'] . "</p>";
                //     echo "<audio src =" . $data['data'][$i]['preview'] . "   controls ></audio><br>";
                // }
                // echo $data['tracklist'];
                $this->session->set_userdata('Station', $data);
                redirect('http://localhost:8888/Station/');
            }
        }
        public function getStationTunes()
        {
            // $url = "";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "" . $this->session->userdata('Station')['tracklist'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                // CURLOPT_ENCODING => "",
                // CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                // CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "x-rapidapi-host: deezerdevs-deezer.p.rapidapi.com",
                    "x-rapidapi-key: dd6ffc04a3msh18681626f688b74p186903jsn35bf211cc1c8"
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $data = json_decode($response, true);
                // var_dump($data);
                // $data2 = $data['data'];
                // for($i = 0; $i < count($data['data']); $i++){
                //     echo "<p>" . $data['data'][$i]['title'] . "</p>";
                //     echo "<p>" . $data['data'][$i]['artist']['name'] . "</p>";
                //     echo "<audio src =" . $data['data'][$i]['preview'] . "   controls ></audio><br>";
                // }
                // echo $data['tracklist'];
                // $this->session->set_userdata('Prestine', $data);
                $this->session->set_userdata('StationTunes', $data);
                $this->session->set_userdata('Prestine', TRUE);
                redirect('http://localhost:8888/Station/');
            }
        }
        public function getAlbum()
        {
            // $url = "";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "" . $this->input->post('songAlbum'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                // CURLOPT_ENCODING => "",
                // CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                // CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "x-rapidapi-host: deezerdevs-deezer.p.rapidapi.com",
                    "x-rapidapi-key: dd6ffc04a3msh18681626f688b74p186903jsn35bf211cc1c8"
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $data = json_decode($response, true);
                // var_dump($data);
                // $data2 = $data['data'];
                // for($i = 0; $i < count($data['data']); $i++){
                //     echo "<p>" . $data['data'][$i]['title'] . "</p>";
                //     echo "<p>" . $data['data'][$i]['artist']['name'] . "</p>";
                //     echo "<audio src =" . $data['data'][$i]['preview'] . "   controls ></audio><br>";
                // }
                // echo $data['tracklist'];
                if($data['error']['message'] != 'no data'){
                    $this->session->set_userdata('Album', $this->input->post('album'));
                    $this->session->set_userdata('AlbumSongs', $data);
                    $this->session->set_userdata('AlbumTitle', $this->input->post('thisAlbumTitle'));
                    $this->session->set_userdata('AlbumCover', $this->input->post('thisAlbumCover'));
                    $this->session->set_userdata('2prestine2', TRUE);
                }
                else
                {
                    $this->session->set_flashdata('error_message', "We are sorry the album's tracklist currently does not exist in our database or the album that was selected to be initially loaded has failed please select another.");
                    
                    $count = $this->session->userdata('4count4') + 1;
                    $this->session->set_userdata('4count4', $count);
                }
                redirect('http://localhost:8888/Artist/');
            }
        }

        public function getSongByName($name, $artist) {
            $this->load->model("Song_Model");
            // Certain characters are not allowed to be passed through the url so the parameters had to converted to base64 then urlencoded.
            $song = $this->Song_Model->getSongsByName(base64_decode(urldecode($name)), base64_decode(urldecode($artist)));
            // $details = array("Name" => base64_decode(urldecode($name)), "Artist" => base64_decode(urldecode($artist)));

            echo json_encode($song);
        }
    }
?>