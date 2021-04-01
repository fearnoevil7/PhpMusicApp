<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Message extends CI_Controller {
        public function Create($userid, $songid)
        {
            $this->load->model("Message_Model");
            $this->load->model("User");
            $user = $this->User->Show($userid);
            $errors = array();
            $content = str_split($this->input->post('Content'));
            if(count($content) < 3){
                $errors[] = "Message must have content with a length of atleast 3 characters.";
            }
            if(count($errors) == 0){
                $message_details = array(
                    "Content" => $this->input->post('Content'),
                    "UserId" => $userid,
                    "CreatedAt" => date("Y-m-d, H:i"),
                    "UpdatedAt" => date("Y-m-d, H:i"),
                    "SongId" => $songid,
                    "PosterName" => "" . $user['FirstName'] . " " . $user['LastName'],
                    "PosterPicUrl" => "" . $user['ProfilePicUrl'],
                    "IsMessage" => $this->input->post('MessageTypeBoolean'),
                );
                // if($this->input->post('MessageTypeBoolean') == 'TRUE'){
                //     $message_details['SongId'] = 
                // }
                $created_message = $this->Message_Model->PostMessage($message_details);
                var_dump($songid);
                redirect('http://localhost:8888/song/show/' . $songid);
            }
            else
            {
                redirect('http://localhost:8888/song/show/' . $songid);
            }
        }
    }
?>