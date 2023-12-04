<?php 

    class Playlist_Model extends CI_Model {

        public function Create($Name, $UserId) {
            $query = "INSERT INTO Playlists (Name, UserId) VALUES (?,?)";
            $values = array($Name, $UserId);
            return $this->db->query($query, $values);
        }

        function getUserPlaylists($UserId) {
            return $this->db->query("SELECT * FROM Playlists WHERE UserId = ?", array($UserId))->result_array();
        }

        function getPlaylist($UserId, $Name) {
            return $this->db->query("SELECT * FROM Playlists WHERE UserId = ? AND Name = ?", array($UserId, $Name))->row_array();
        }

        function addSongToPlaylist($PlaylistId, $SongId) {
            $query = "INSERT INTO PlaylistTracks (PlaylistId, SongId) VALUES(?,?)";
            $values = array($PlaylistId, $SongId);
            return $this->db->query($query, $values);
        }

        function getAllSongsForPlaylist($PlaylistId) {
            return $this->db->query("SELECT * FROM PlaylistTracks WHERE PlaylistId = ?", array($PlaylistId))->result_array();
        }

        function pinPlaylist($PlaylistId, $UserId, $Boolean) {
            $query = "UPDATE Playlists SET Pinned = ? WHERE PlaylistId = ? AND UserId = ?";
            $values = array($Boolean, $PlaylistId, $UserId);
            return $this->db->query($query, $values);
        }

        function deleteAllTracksFromPlaylist($PlaylistId) {
            return $this->db->query("DELETE FROM PlaylistTracks WHERE PlaylistId = ?", array($PlaylistId));
        }

        function deleteUsersPlaylists($UserId) {
            return $this->db->query("DELETE FROM Playlists WHERE UserId = ?", array($UserId));
        }
        
        function deletePlaylistById($PlaylistId) {
            return $this->db->query("DELETE FROM Playlists WHERE PlaylistId = ?", array($PlaylistId));
        }
    }

?>