<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Station extends CI_Controller {
        public function RadioStation()
        {
            $this->load->model('Song_Model');
            $this->load->model('Like_Model');
            $this->load->model('Message_Model');
            $this->load->model('User');
            $this->load->model('Comment_Model');
            $logged_user  = $this->User->Show($this->session->userdata('UserId'));
            $decodedFriendRequests = array();
            $unwrappedRequests = json_decode($logged_user['PendingFriendRequests'], true);
            if($unwrappedRequests != null){
                for($x = 0; $x < count($unwrappedRequests); $x++){
                    $requestReceiver = $this->User->Show($unwrappedRequests[$x]['RequestReceiverId']);
                    $requestSender = $this->User->Show($unwrappedRequests[$x]['RequestSenderId']);
                    $request = array("Sender" => $requestSender, "Receiver" => $requestReceiver);
                    array_push($decodedFriendRequests, $request);
                }
            }

            $view_data['loggedUser'] = array(
                'IdNumber' => $logged_user['UserId'],
                'FirstName' => $logged_user['FirstName'],
                'LastName' => $logged_user['LastName'],
                'Email' => $logged_user['Email'],
                'pendingrequests' => $decodedFriendRequests,
                'user' => $logged_user,
            );

            $view_data['user'] = array(
                'loggedUser' => $logged_user,
            );


            $this->load->view('Station/StationView', $view_data);
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
                    // $this->session->set_userdata('2prestine2', TRUE);
                    $count = $this->session->userdata('3count3') + 1;
                    $this->session->set_userdata('3count3', $count);
                    // redirect('http://localhost:8888/');
                }
                redirect('http://localhost:8888/Station/');
            }
        }
    }
?>