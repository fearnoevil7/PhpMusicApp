<?php
    class Comment_Model extends CI_Model
    {
        function CreateComment($comment)
        {
            $date = array();
            $time = array();
            date_default_timezone_set('America/Chicago');
            if(date("H") > 12) {
                // echo date("H") - 12 . ":" . date("i") . "<br>";
                if(date("m") == "01"){
                    $date = array("NumericalMonth" => date("m"), "Month" => "January", "Day" => date("d"), "Year" => date("Y"));
                    $time = array("Hour" => date("H") - 12, "Minutes" => date("i"), "AMPM" => "PM");
                }
                if(date("m") == "02"){
                    $date = array("NumericalMonth" => date("m"), "Month" => "February", "Day" => date("d"), "Year" => date("Y"));
                    $time = array("Hour" => date("H") - 12, "Minutes" => date("i"), "AMPM" => "PM");
                }
                if(date("m") == "03"){
                    $date = array("NumericalMonth" => date("m"), "Month" => "March", "Day" => date("d"), "Year" => date("Y"));
                    $time = array("Hour" => date("H") - 12, "Minutes" => date("i"), "AMPM" => "PM");
                }
                if(date("m") == "04"){
                    $date = array("NumericalMonth" => date("m"), "Month" => "April", "Day" => date("d"), "Year" => date("Y"));
                    $time = array("Hour" => date("H") - 12, "Minutes" => date("i"), "AMPM" => "PM");
                }
                if(date("m") == "05"){
                    $date = array("NumericalMonth" => date("m"), "Month" => "May", "Day" => date("d"), "Year" => date("Y"));
                    $time = array("Hour" => date("H") - 12, "Minutes" => date("i"), "AMPM" => "PM");
                }
                if(date("m") == "06"){
                    $date = array("NumericalMonth" => date("m"), "Month" => "June", "Day" => date("d"), "Year" => date("Y"));
                    $time = array("Hour" => date("H") - 12, "Minutes" => date("i"), "AMPM" => "PM");
                }
                if(date("m") == "07"){
                    $date = array("NumericalMonth" => date("m"), "Month" => "July", "Day" => date("d"), "Year" => date("Y"));
                    $time = array("Hour" => date("H") - 12, "Minutes" => date("i"), "AMPM" => "PM");
                }
                if(date("m") == "08"){
                    $date = array("NumericalMonth" => date("m"), "Month" => "August", "Day" => date("d"), "Year" => date("Y"));
                    $time = array("Hour" => date("H") - 12, "Minutes" => date("i"), "AMPM" => "PM");
                }
                if(date("m") == "09"){
                    $date = array("NumericalMonth" => date("m"), "Month" => "September", "Day" => date("d"), "Year" => date("Y"));
                    $time = array("Hour" => date("H") - 12, "Minutes" => date("i"), "AMPM" => "PM");
                }
                if(date("m") == "10"){
                    $date = array("NumericalMonth" => date("m"), "Month" => "October", "Day" => date("d"), "Year" => date("Y"));
                    $time = array("Hour" => date("H") - 12, "Minutes" => date("i"), "AMPM" => "PM");
                }
                if(date("m") == "11"){
                    $date = array("NumericalMonth" => date("m"), "Month" => "November", "Day" => date("d"), "Year" => date("Y"));
                    $time = array("Hour" => date("H") - 12, "Minutes" => date("i"), "AMPM" => "PM");
                }
                if(date("m") == "12"){
                    $date = array("NumericalMonth" => date("m"), "Month" => "December", "Day" => date("d"), "Year" => date("Y"));
                    $time = array("Hour" => date("H") - 12, "Minutes" => date("i"), "AMPM" => "PM");
                }
            }
            else
            {
                if(date("m") == "01"){
                    $date = array("NumericalMonth" => date("m"), "Month" => "January", "Day" => date("d"), "Year" => date("Y"));
                    $time = array("Hour" => date("H"), "Minutes" => date("i"), "AMPM" => "AM");
                }
                if(date("m") == "02"){
                    $date = array("NumericalMonth" => date("m"), "Month" => "February", "Day" => date("d"), "Year" => date("Y"));
                    $time = array("Hour" => date("H"), "Minutes" => date("i"), "AMPM" => "AM");
                }
                if(date("m") == "03"){
                    $date = array("NumericalMonth" => date("m"), "Month" => "March", "Day" => date("d"), "Year" => date("Y"));
                    $time = array("Hour" => date("H"), "Minutes" => date("i"), "AMPM" => "AM");
                }
                if(date("m") == "04"){
                    $date = array("NumericalMonth" => date("m"), "Month" => "April", "Day" => date("d"), "Year" => date("Y"));
                    $time = array("Hour" => date("H"), "Minutes" => date("i"), "AMPM" => "AM");
                }
                if(date("m") == "05"){
                    $date = array("NumericalMonth" => date("m"), "Month" => "May", "Day" => date("d"), "Year" => date("Y"));
                    $time = array("Hour" => date("H"), "Minutes" => date("i"), "AMPM" => "AM");
                }
                if(date("m") == "06"){
                    $date = array("NumericalMonth" => date("m"), "Month" => "June", "Day" => date("d"), "Year" => date("Y"));
                    $time = array("Hour" => date("H"), "Minutes" => date("i"), "AMPM" => "AM");
                }
                if(date("m") == "07"){
                    $date = array("NumericalMonth" => date("m"), "Month" => "July", "Day" => date("d"), "Year" => date("Y"));
                    $time = array("Hour" => date("H"), "Minutes" => date("i"), "AMPM" => "AM");
                }
                if(date("m") == "08"){
                    $date = array("NumericalMonth" => date("m"), "Month" => "August", "Day" => date("d"), "Year" => date("Y"));
                    $time = array("Hour" => date("H"), "Minutes" => date("i"), "AMPM" => "AM");
                }
                if(date("m") == "09"){
                    $date = array("NumericalMonth" => date("m"), "Month" => "September", "Day" => date("d"), "Year" => date("Y"));
                    $time = array("Hour" => date("H"), "Minutes" => date("i"), "AMPM" => "AM");
                }
                if(date("m") == "10"){
                    $date = array("NumericalMonth" => date("m"), "Month" => "October", "Day" => date("d"), "Year" => date("Y"));
                    $time = array("Hour" => date("H"), "Minutes" => date("i"), "AMPM" => "AM");
                }
                if(date("m") == "11"){
                    $date = array("NumericalMonth" => date("m"), "Month" => "November", "Day" => date("d"), "Year" => date("Y"));
                    $time = array("Hour" => date("H"), "Minutes" => date("i"), "AMPM" => "AM");
                }
                if(date("m") == "12"){
                    $date = array("NumericalMonth" => date("m"), "Month" => "December", "Day" => date("d"), "Year" => date("Y"));
                    $time = array("Hour" => date("H"), "Minutes" => date("i"), "AMPM" => "AM");
                }
            }
            $creation_details = array("Date" => $date, "Time" => $time);
            if($comment['IsWallPostComment'] == 'FALSE'){
                $query = "INSERT INTO Comments (Content, MessageId, PosterId, CreatedAt, UpdatedAt, PersonBeingCommentedOnName, PosterName, PosterPicUrl) VALUES(?,?,?,?,?,?,?,?)";
                $values = array($comment['Content'], $comment['MessageId'], $comment['PosterId'], json_encode($creation_details), json_encode($creation_details), $comment['PersonBeingCommentedOnName'], $comment['PosterName'], $comment['PosterPicUrl']);
                return $this->db->query($query, $values);
            }
            if($comment['IsWallPostComment'] == 'TRUE'){
                $query = "INSERT INTO PostComments (Content, WallPostId, PosterId, CreatedAt, UpdatedAt, PersonBeingCommentedOnName, PosterName, PosterPicUrl) VALUES(?,?,?,?,?,?,?,?)";
                $values = array($comment['Content'], $comment['MessageId'], $comment['PosterId'], json_encode($creation_details), json_encode($creation_details), $comment['PersonBeingCommentedOnName'], $comment['PosterName'], $comment['PosterPicUrl']);
                return $this->db->query($query, $values);
            }
        }
        function getMessageComments($messageid)
        {
            return $this->db->query("SELECT * FROM Comments WHERE MessageId=?", array($messageid)) -> row_array();
        }
        function getAllComments()
        {
            return $this->db->query("SELECT * FROM Comments")->result_array();
        }
        function getAllWallPostComments()
        {
            return $this->db->query("SELECT * FROM PostComments")->result_array();
        }
    }
?>