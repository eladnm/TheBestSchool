<?php
// A class to help work with Sessions
// In our case, primarily to manage logging users in and out

// Keep in mind when working with sessions that it is generally 
// inadvisable to store DB-related objects in sessions
require_once '../conn.php';
class Session {
	
	private $logged_in=false;
	public $admin_id;
	
	function __construct() {
		session_start();
		$this->check_login();
    if($this->logged_in) {
      // actions to take right away if user is logged in
    } else {
      // actions to take right away if user is not logged in
    }
	}
	
  public function is_logged_in() {
    return $this->logged_in;
  }

	public function login($admin) {
    // database should find user based on username/password
    if($admin){
      $this->admin = $_SESSION['admin_id'] = $admin->id;
      $this->logged_in = true;
    }
  }
  
  public function logout() {
    unset($_SESSION['admin_id']);
    unset($this->admin_id);
    $this->logged_in = false;
  }

	private function check_login() {
    if(isset($_SESSION['admin_id'])) {
      $this->admin_id = $_SESSION['admin_id'];
      $this->logged_in = true;
    } else {
      unset($this->admin_id);
      $this->logged_in = false;
    }
  }
  
}

$session = new Session();