<?php

require_once(WSS_EXTESION_DIR . '/includes/script/class.CurrentUser.php');

class RequestService
{

	private $currentUser;
	private $config;

	public function __construct()
	{
		$this->currentUser = new CurrentUser;
		$this->config = include(WSS_EXTESION_DIR . '/includes/resources/config.php');
	}

	public function sendRequest($route, $user_data)
	{

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $route);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($user_data));

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec ($ch);

		curl_close ($ch);

		echo $result;

		return $result;

	}

	public function register($user)
	{

		$user_data = array('register_name' => $user['register_name'], 'register_company' => $user['register_company'], 'register_email' => $user['register_email'], 'cms_id' => $this->getHash(), 'cms_username' => $this->currentUser->getUserName(), 'cms_email' => $this->currentUser->getEmail(), 'cms_url' => $this->currentUser->getUrl(), 'cms_register_date' => $this->currentUser->getRegisterDate());

		echo $this->sendRequest($this->config['register'], $user_data);
	}

	public function authenticate()
	{
		$user_data = array('cms_id' => $this->currentUser->getId(), 'cms_username' => $this->currentUser->getUserName(), 'cms_email' => $this->currentUser->getEmail(), 'cms_url' => $this->currentUser->getUrl(), 'cms_register_date' => $this->currentUser->getRegisterDate());

		return $this->sendRequest($this->config['auth'], $user_data);
	}

	public function scan($user)
	{
		$user_data = array('request_name' => $user['request_name'], 'request_company' => $user['request_company'], 'request_email' => $user['request_email'], 'type' => $user['type'], 'report' => $user['report'], 'cms_id' => $this->currentUser->getId(),'cms_name' => $this->currentUser->getUserName(), 'cms_url' => $this->currentUser->getUrl(), 'cms_email' => $this->currentUser->getEmail());

		return $this->sendRequest($this->config['scan'], $user_data);
	}

	public function getHash()
	{
		$salt = substr(rand(), 0, 4);

		$hash = $salt . md5(
	 	$this->currentUser->getId().
	 	$this->currentUser->getUserName().
	 	$this->currentUser->getEmail().
	 	$this->currentUser->getUrl().
	 	$this->currentUser->getRegisterDate());

		return $hash;
	}

}