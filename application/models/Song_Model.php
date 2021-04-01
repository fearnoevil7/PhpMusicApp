<?php
    class Song_Model extends CI_Model {
        function AddSong($Song)
        {
            $query = "INSERT INTO Songs (Name, Artist, Url, UserId) VALUES(?,?,?,?)";
            $values = array($Song['Name'], $Song['Artist'], $Song['Url'], $Song['UserId']);
            return $this->db->query($query, $values);
        }
        function get_All_Songs()
        {
            return $this->db->query("SELECT * FROM Songs")->result_array();
        }
        function get_song_by_id($songid)
        {
            return $this->db->query("SELECT * FROM Songs WHERE SongId = ?", array($songid))->row_array();
        }
    }
?>