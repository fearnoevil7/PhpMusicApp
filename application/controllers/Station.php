<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Station extends CI_Controller {

        public function makeApi_Call($url){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "x-rapidapi-host: deezerdevs-deezer.p.rapidapi.com",
                    "x-rapidapi-key: dd6ffc04a3msh18681626f688b74p186903jsn35bf211cc1c8"
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
            if ($err) {
                echo "cURL Error:" . $err;
            } else {
                return json_decode($response, true);
            }
        }

        public function RadioStation()
        {
            $this->load->model('Song_Model');
            $this->load->model('Like_Model');
            $this->load->model('Message_Model');
            $this->load->model('User');
            $this->load->model('Comment_Model');
            $this->load->model('Playlist_Model');
            $logged_user  = $this->User->Show($this->session->userdata('UserId'));
            $userPlaylists = $this->Playlist_Model->getUserPlaylists($this->session->userdata('UserId'));
            $playlists = array();

            foreach($userPlaylists as $playlist) {
                $songs = $this->Playlist_Model->getAllSongsForPlaylist(intval($playlist['PlaylistId']));
                array_push($playlists, array("Playlist" => $playlist, "Songs" => $songs));
            }


            $decodedFriendRequests = array();


            $allRadioStations = $this->makeApi_Call("https://deezerdevs-deezer.p.rapidapi.com/radio/lists")['data'];

            $response = $this->makeApi_Call("https://api.deezer.com/chart/playlists");

            $unpackagedData = array();
            $hottestArtists = array();
            $hottestAlbums = array();
            $hottestTracks = array();
            $hottestPodcasts = array();
            $hottestPlaylists = array();

            foreach($response as $track){
                foreach($track['data'] as $data){
                    // array_push($unpackagedData, $data);
                    if($data['type'] == 'artist'){
                        array_push($hottestArtists, $data);

                    } elseif($data['type'] == 'album') {
                        array_push($hottestAlbums, $data);

                    } if($data['type'] == 'track') {
                        $index = array();
                        $index['track'] = $data;

                        $albumTrackList = $this->makeApi_Call($data['album']['tracklist']);
                        $index['numberOfTracksInAlbum'] = count($albumTrackList['data']);

                        array_push($hottestTracks, $index);

                    } if($data['type'] == 'podcast') {
                        array_push($hottestPodcasts, $data);

                    } if($data['type'] == 'playlist') {
                        array_push($hottestPlaylists, $data);

                    }
                }
            }

            $view_data['user'] = array(
                'loggedUser' => $logged_user,
                'playlists' => $playlists,
                'testBoolean' => false
            );

            $view_data['DeezerApi'] = array(
                'RadioStations' => $allRadioStations,
                'artists' => array_reverse($hottestArtists),
                'albums' => $hottestAlbums,
                'tracks' => $hottestTracks,
                'podcasts' => $hottestPodcasts,
                'playlists' => $hottestPlaylists,
            );


            $this->load->view('Station/StationView', $view_data);
        }

        public function receiveURL(){
            $response = $this->makeApi_Call($this->input->post('url'));

            (array_key_exists("data", $response) == true) ? ($response = $response['data']) : ($response = $response);

            header('Content-Type: application/json');
            echo json_encode($response);
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