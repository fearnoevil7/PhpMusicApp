<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Comment extends CI_Controller {
        public function Create($messagePoster, $messageid, $userId)
        {
            $this->load->model("Comment_Model");
            $this->load->model("Message_Model");
            $this->load->model("User");
            $poster = $this->User->Show($this->session->userdata($userId));
            $message = $this->Message_Model->getMessageById($messageid);
            $errors = array();
            $commentcontent = str_split($this->input->post('Content'));
            if(count($commentcontent) < 3) {
                $errors[] = "Comment must be atleast 3 characters";
            }
            if(count($errors) == 0){
                $comment_details = array(
                    "MessageId" => $messageid,
                    "PosterId" => $userId,
                    "Content" => $this->input->post('Content'),
                    "CreatedAt" => date("Y-m-d, H:i"),
                    "UpdatedAt" => date("Y-m-d, H:i"),
                );
                $created_comment = $this->Comment_Model->CreateComment($comment_details);
                redirect('http://localhost:8888/user/show/' . $userId);
            }
        }
    }
?>