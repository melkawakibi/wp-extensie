<?php

class CurrentUser
{

	public function __construct()
	{
		$current_user = wp_get_current_user();
		$this->user_info = get_userdata($current_user->ID);
	}


	public function getId()
	{
		return $this->user_info->ID;
	}

	public function getUserName()
	{
		return $this->user_info->user_login;
	}

	public function getEmail()
	{
		return $this->user_info->user_email;
	}

	public function getRegisterDate()
	{
		return $this->user_info->user_registered;
	}

	public function getUrl()
	{
		return $this->user_info->user_url;
	}

}