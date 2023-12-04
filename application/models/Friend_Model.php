<?php
    class Friend_Model extends CI_Model {
        function getPendingFriendRequests($User){
            return $this->db->query("SELECT * FROM Friends WHERE (Sender=? OR Receiver=?) AND Pending=?;", array($User['UserId'], $User['UserId'], 1))->result_array();
            // return $this->db->query("SELECT * FROM Friends")->result_array();
        }

        function getUserFriendsList($UserId){
            return $this->db->query("SELECT * FROM Friends WHERE (Sender=? OR Receiver=?) AND Pending=?;", array($UserId, $UserId, 0))->result_array();
        }
        
        function sendFriendRequest($requestSenderId, $requestReceiverId){
            $query = "INSERT INTO Friends (Sender, Receiver, Pending) VALUES(?,?,?)";
            $values = array($requestSenderId, $requestReceiverId, 1);
            return $this->db->query($query, $values);
        }

        function processRequest($requestSenderId, $requestReceiverId, $decision){
            if($decision == 1){ //Accept friend request.
                return $this->db->query("UPDATE Friends SET Pending=? WHERE Sender=? AND Receiver=? AND Pending=?;", array(0,$requestSenderId, $requestReceiverId, 1));
            } else { //Decline friend request.
                return $this->db->query("DELETE FROM Friends WHERE Sender=? AND Receiver=? AND Pending=?", array($requestSenderId, $requestReceiverId, 1));
            }
        }

    }
?>