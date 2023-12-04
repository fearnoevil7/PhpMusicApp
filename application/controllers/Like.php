<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Like extends CI_Controller {
        public function Create() {
            // $this->load->model("Like_Model");
            // $new_like = $this->Like_Model->LikeSong($userId, $songid);
            // redirect('http://localhost:8888/song/show/' . $songid);

            $this->load->model("Song_Model");

            $data = json_decode(file_get_contents("php://input"));

            $match = $this->Song_Model->getSongsByName($data->Name, $data->Artist);

            $this->load->model("Like_Model");

            $response;
            if($match) {
                $response = $this->Like_Model->Like($this->session->userdata('UserId'), $match['SongId']);
            } else {
                $song_details = array(
                    'Name' => $data->Name,
                    'Artist' => $data->Artist,
                    'Url' => $data->Url,
                    'UploaderId' => $data->ApiUrl ? NULL : $this->session->userdata('UserId'),
                    'AlbumTitle' => $data->AlbumTitle ? $data->AlbumTitle : NULL,
                    'PictureUrl' => $data->Picture ? $data->Picture : NULL,
                    'ApiUrl' => $data->ApiUrl ? $data->ApiUrl : NULL
                );
    
                $added_song = $this->Song_Model->AddSong($song_details);

                $match = $this->Song_Model->getSongsByName($data->Name, $data->Artist);
                $response = $this->Like_Model->Like($this->session->userdata('UserId'), $match['SongId']);
            }

            $this->load->model("Playlist_Model");
            $playlist = $this->Playlist_Model->getPlaylist($this->session->userdata('UserId'), "Likes");

            $this->Playlists_Model->addSongToPlaylist($playlist['PlaylistId'], $match['SongId']);

            echo json_encode($response);
        }

        public function New() {
            $this->load->view('Home/test');
        }

        public function Destroy($userid, $songid) {
            $this->load->Model("Like_Model");
            $selectedLike = $this->Like_Model->removeLike($userid, $songid);
            redirect('http://localhost:8888/dashboard/' . $this->session->userdata('UserId'));
        }

        // public function Test() {
        //     $test = array("test" => "testing");
        //     header("Content-Type: application/json");
        //     echo json_encode($test);
        // }
    }
?>