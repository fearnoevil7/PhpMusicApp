<?php
    class Playlist extends CI_Controller {
        public function Create($name) {
            $this->load->model('Playlist_Model');
            $playlist = $this->Playlist_Model->getPlaylist($this->session->userdata('UserId'), base64_decode(urldecode($name)));
            $response = false;
            if($playlist == null) {
                $response = $this->Playlist_Model->Create(base64_decode(urldecode($name)), $this->session->userdata('UserId'));
                $playlists = $this->Playlist_Model->getUserPlaylists($this->session->userdata('UserId'));
                echo json_encode(array("Message" => "Playlist successfully created.", "Playlists" => $playlists, "Playlist With the Same Name" => NULL)); 
                
            } else {
                echo json_encode(array("Error" => "Playlist with that name already exists!", "Playlist With the Same Name" => $playlist));
            }
        }

        public function Show($name) {
            $this->load->model('Playlist_Model');
            $playlist = $this->Playlist_Model->getPlaylist($name);
            echo json_encode(array("Playlist" => $playlist));
        }

        public function appendSongToPlaylist($PlaylistId, $SongId) {
            $this->load->model('Playlist_Model');
            $response = $this->Playlist_Model->addSongToPlaylist($PlaylistId, $SongId);

            if($response == true) {
                $tracks = $this->Playlist_Model->getSongsFromPlaylist($PlaylistId, $SongId);
                $tracks = array("Tracks" => $tracks);
                echo json_encode($tracks);
            } else {
                echo json_encode(array("Error" => "Failed to add song to playlist."));
            }
        }

        public function Pin($PlaylistId, $Name) {
            $this->load->model('Playlist_Model');
            $playlist = $this->Playlist_Model->getPlaylist($this->session->userdata('UserId'), urldecode(base64_decode($Name)));
            
            $response;
            if($playlist != NULL) {
                ($playlist['Pinned'] == NULL || $playlist['Pinned'] == 0) ? $response = $this->Playlist_Model->pinPlaylist($PlaylistId, $this->session->userdata('UserId'), 1) : $response = $this->Playlist_Model->pinPlaylist($PlaylistId, $this->session->userdata('UserId'), 0);
                $playlist = $this->Playlist_Model->getPlaylist($this->session->userdata('UserId'), urldecode(base64_decode($Name)));
                echo json_encode(array("Message" => "Playlist successfully pinned.", "Playlist" => $playlist));
            } else {
                echo json_encode(array("Error" => "Playlist does not exist", "Playlist" => $playlist, "UserId" => $this->session->userdata('UserId'), "Name" => urldecode(base64_decode($Name))));
            }
        }

        public function Delete($PlaylistId) {
            $this->load->model('Playlist_Model');
            $response = $this->Playlist_Model->deletePlaylistById($PlaylistId);
            if($response == true) {
                $currentUsersPlaylists = $this->Playlist_Model->getUserPlaylists($this->session->userdata('UserId'));
                echo json_encode(array("Message" => "Deleted playlist." , "Playlists" => $currentUsersPlaylists));
            } else {
                echo json_encode(array("Error" => "Unable to delete playlists", "Response" => $response));
            }
        }
    }
?>