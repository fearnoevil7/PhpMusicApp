<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Like extends CI_Controller {
        public function Create($userId, $songid)
        {
            $this->load->model("Like_Model");
            $new_like = $this->Like_Model->LikeSong($userId, $songid);
            redirect('http://localhost:8888/song/show/' . $songid);
        }
        public function New()
        {
            $this->load->view('Home/test');
        }
        public function Destroy($userid, $songid)
        {
            $this->load->Model("Like_Model");
            $selectedLike = $this->Like_Model->removeLike($userid, $songid);
            redirect('http://localhost:8888/dashboard/' . $this->session->userdata('UserId'));
        }
    }
?>