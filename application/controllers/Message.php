<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Message extends CI_Controller {
        public function Create($userid, $id)
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
                if($this->input->post('whatIsBeingCommentedOn') == 'TRUE') {
                    // If $whatIsBeingCommentedOn variable returns 'TRUE' then it is a user being commented on else it is a song being commented on.
                    $message_details = array(
                        "Content" => $this->input->post('Content'),
                        "Sender" => $userid,
                        "CreatedAt" => date("Y-m-d, H:i"),
                        "UpdatedAt" => date("Y-m-d, H:i"),
                        "UserBeingCommentedOn" => $id,
                        "SongBeingCommentedOn" => NULL,
                    );
                } else {
                    $message_details = array(
                        "Content" => $this->input->post('Content'),
                        "Sender" => $userid,
                        "CreatedAt" => date("Y-m-d, H:i"),
                        "UpdatedAt" => date("Y-m-d, H:i"),
                        "UserBeingCommentedOn" => NULL,
                        "SongBeingCommentedOn" => $id,
                    );
                }

                $created_message = $this->Message_Model->PostMessage($message_details);
            }
            redirect('http://localhost:8888/user/show/' . $userid);
        }
    }
?>