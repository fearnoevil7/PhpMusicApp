<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function ArtistWall()
	{
		$this->load->model('Song_Model');
		$this->load->model('Like_Model');
		$this->load->model('Message_Model');
		$this->load->model('User');
		$this->load->model('Comment_Model');
		$logged_user  = $this->User->Show($this->session->userdata('UserId'));
		$friends = array();
		$decodedFriendRequests = array();
		$unwrappedFriendsList = json_decode($logged_user['FriendsList']);
		$unwrappedRequests = json_decode($logged_user['PendingFriendRequests'], true);
		if($unwrappedRequests != null){
			for($x = 0; $x < count($unwrappedRequests); $x++){
				$requestReceiver = $this->User->Show($unwrappedRequests[$x]['RequestReceiverId']);
				$requestSender = $this->User->Show($unwrappedRequests[$x]['RequestSenderId']);
				$request = array("Sender" => $requestSender, "Receiver" => $requestReceiver);
				array_push($decodedFriendRequests, $request);
			}
		}
		if($unwrappedFriendsList != null){
			for($z = 0; $z < count($unwrappedFriendsList); $z++){
				$friend = $this->User->Show($unwrappedFriendsList[$z]);
				array_push($friends, $friend);
			}
		}
		$view_data['loggedUser'] = array(
			'IdNumber' => $logged_user['UserId'],
			'FirstName' => $logged_user['FirstName'],
			'LastName' => $logged_user['LastName'],
			'Email' => $logged_user['Email'],
			'pendingrequests' => $decodedFriendRequests,
			'friends' => $friends,
			'user' => $logged_user,
			// 'likes' => $userlikes,
		);
		$this->load->view('Artist/ArtistView', $view_data);
	}
}
