<?php
    class Song_Model extends CI_Model {
        function AddSong($Song) {
            $query = "INSERT INTO Songs (Name, Artist, Url, UploaderId, AlbumTitle, PictureUrl, ApiUrl) VALUES(?,?,?,?,?,?,?)";
            $values = array(
                        $Song['Name'],
                        $Song['Artist'],
                        $Song['Url'],
                        $Song['UploaderId'] ? $Song['UploaderId'] : NULL,
                        $Song['AlbumTitle'] ? $Song['AlbumTitle'] : NULL,
                        $Song['PictureUrl'] ? $Song['PictureUrl'] : NULL,
                        $Song['ApiUrl'] ? $Song['ApiUrl'] : NULL
                        );
            return $this->db->query($query, $values);
            // return $values;
        }

        function addSongFromAPI($Song) {
            $query = "INSERT INTO Songs (SongId, Name, Artist, Url, UploaderId, AlbumTitle, PictureUrl, ApiUrl) VALUES(?,?,?,?,?,?,?,?)";
            $values = array($Song['Name'], $Song['Artist'], $Song['Url'], NULL, $Song['AlbumTitle'], $Song['Picture'], $Song['ApiUrl']);
            return $this->db->query($query, $values);
        }

        function get_All_Songs() {
            return $this->db->query("SELECT * FROM Songs")->result_array();
        }

        function get_song_by_id($songid) {
            return $this->db->query("SELECT * FROM Songs WHERE SongId = ?", array($songid))->row_array();
        }

        function getSongsByName($name, $artist) {
            return $this->db->query("SELECT * FROM Songs WHERE Name = ? AND Artist = ?", array($name, $artist))->row_array();
        }

        function deleteAllSongsUploadedByUser($userid) {
            return $this->db->query("DELETE FROM Songs WHERE UploaderId = ?", array($userid));
        }
    }
?>