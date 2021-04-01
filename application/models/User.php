<?php
    class User extends CI_Model {
        function CreateUser($User)
        {
            $query = "INSERT INTO Users (FirstName, LastName, Email, Password, Salt, ProfilePicUrl) VALUES(?,?,?,?,?,?)";
            $values = array($User['FirstName'], $User['LastName'], $User['Email'], $User['Password'], $User['Salt'], $User['ProfilePicUrl']);
            return $this->db->query($query, $values);
        }
        function Login($User)
        {
            return $this->db->query("SELECT * FROM Users WHERE Email = ?", array($User['Email']))->row_array();
        }
        function Show($userId)
        {
            return $this->db->query("SELECT * FROM Users WHERE UserId = ?", array($userId))->row_array();
        }
        function sendRequest($userid, $requests)
        {
            $query = "UPDATE Users SET PendingFriendRequests = ? WHERE UserId = ?";
            return $this->db->query($query, array(json_encode($requests), $userid));
        }
        function confirmRequest($userid, $request)
        {
            $query = "UPDATE Users SET FriendsList = ? WHERE UserId = ?";
            return $this->db->query($query, array(json_encode($request), $userid));
        }
        function edit_Update($User, $userid)
        {
            // $query = "UPDATE Users SET FirstName = ?, LastName = ?, Email = ? WHERE UserId = ?";
            // $values = array($User['FirstName'], $User['LastName'], $User['Email']);
            // return $this->db->query($query, $User['FirstName'], $User['LastName'], $User['Email'], $userid);
            return $this->db->update('Users', $User, array('UserId' => $userid));
        }
        function updateMyPassword($User, $userid)
        {
            $this->db->set('Password', $User['Password']);
            $this->db->set('Salt', $User['Salt']);
            $this->db->where('UserId', $userid);
            return $this->db->update('Users');
        }
        function updateMyProfilePic($url, $userid)
        {
            // $query = "UPDATE Users SET ProfilePicUrl = ? WHERE UserId = ?";
            // return $this->db->query($query, array($url), $userid);
            $this->db->set('ProfilePicUrl', $url);
            $this->db->where('UserId', $userid);
            return $this->db->update('Users');
        }
    }
?>