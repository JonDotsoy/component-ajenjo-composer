<?php

namespace ajenjo;

class connect {

	protected $path_consult;
	protected $base_uri;
	public $token;
	public $auth;
	public $user;

	function __construct($base_uri, $path_consult) {
		$this->base_uri = $base_uri;
		$this->path_consult = $path_consult;
	}

	function generateToken()
	{
		$response = file_get_contents($this->base_uri.$this->path_consult);
		$obj = json_decode($response);

		if ($obj->token) {
			$this->auth = $obj->auth;
			$this->token = $obj->token;
			return $this->token;
		} else {
			return null;
		}
	}

	function login($user,$password) {
		$response = file_get_contents(
			$this->base_uri.$this->path_consult // url
			. "?token=" . $this->token
			. "&user=" . $user
			. "&password=" . $password
		);
		$obj = json_decode($response);

		$this->auth = $obj->auth;
		if ($obj->auth) $this->user = $obj->user;

		return (bool) ($this->auth);

	}

	function logout() {
		$response = file_get_contents(
			$this->base_uri.$this->path_consult // url
			. "?token=" . $this->token
			. "&logout=1"
		);
		$obj = json_decode($response);

		$this->auth = $obj->auth;
		if ($obj->auth) $this->user = $obj->user;
		else $this->user = null;

		return (bool) !($this->auth);
	}
	
	function check() {
		$response = file_get_contents(
			$this->base_uri.$this->path_consult // url
			. "?token=" . $this->token
		);
		$obj = json_decode($response);

		$this->auth = $obj->auth;
		if ($obj->auth) $this->user = $obj->user;
		else $this->user = null;

		return true;
	}
}