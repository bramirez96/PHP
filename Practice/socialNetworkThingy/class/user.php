<?php
/**
* User class that holds a shit ton of info on everyone
*/
class User {

	private function set_name($x) {
		$this->name = $x;
	}
	public function get_name() {
		return $this->name;
	}
	private function set_age($x) {
		$this->age = $x;
	}
	public function get_age() {
		return $this->age;
	}
	private function set_username($x) {
		$this->username = $x;
	}
	public function get_username() {
		return $this->username;
	}
	private function set_password($x) {
		$this->password = $x;
	}
	private function get_password() {
		return $this->password;
	}
	function User($name, $age, $username, $password) {
		$this->clean_input(set_name($name));
		$this->clean_input(set_age($age));
		$this->clean_input(set_username($username));
		$this->clean_input(set_password($password));
	}
	function clean_input($value) {
		$value = htmlspecialchars(stripslashes(trim($value)));
	}

}





?>