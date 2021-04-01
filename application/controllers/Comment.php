<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Comment extends CI_Controller {
        public function Create($userid, $messageid, $songid)
        {
            $this->load->model("Comment_Model");
            $this->load->model("Message_Model");
            $this->load->model("User");
            $user = $this->User->Show($userid);
            $poster = $this->User->Show($this->session->userdata('UserId'));
            $message = $this->Message_Model->getMessage($messageid);
            $errors = array();
            $commentcontent = str_split($this->input->post('Content'));
            if(count($commentcontent) < 3) {
                $errors[] = "Comment must be atleast 3 characters";
            }
            if(count($errors) == 0){
                $comment_details = array(
                    "Content" => $this->input->post('Content'),
                    "MessageId" => $message['MessageId'],
                    "PosterId" => $this->session->userdata('UserId'),
                    "PersonBeingCommentedOnName" => $user['FirstName'] . " " . $user['LastName'],
                    "PosterName" => $poster['FirstName'] . " " . $poster['LastName'],
                    "PosterPicUrl" => $poster['ProfilePicUrl'],
                    "CreatedAt" => date("Y-m-d, H:i"),
                    "UpdatedAt" => date("Y-m-d, H:i"),
                    "IsWallPostComment" => $this->input->post('IsWallPostComment'),
                );
                $created_comment = $this->Comment_Model->CreateComment($comment_details);
                redirect('http://localhost:8888/song/show/' . $songid);
            }
        }
    }
?>