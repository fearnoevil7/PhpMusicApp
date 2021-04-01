<?php 
    class Like_Model extends CI_Model {
        function LikeSong($userid, $songid)
        {
            $query = "INSERT INTO Likes (UserId, SongId, CreatedAt, UpdatedAt) VALUES(?,?,?,?)";
            $values = array($userid, $songid, date("Y-m-d, H:i"), date("Y-m-d, H:i"));
            return $this->db->query($query, $values);
        }
        function getUsersLikes($userid)
        {
            return $this->db->query("SELECT * FROM Likes WHERE UserId = ?", array($userid))->result_array();
        }
        function removeLike($userid, $songid)
        {
            $like = array();
            array_push($like, $userid);
            array_push($like, $songid);
            $query = "DELETE FROM Likes WHERE UserId =? AND SongId =?";
            return $this->db->query($query, array($userid, $songid));
        }
    }
?>