<?php
namespace Maulana20\Response;

class LoginGojekResponse
{
	private $authToken;
	private $fullName;
	private $email;
	private $phoneNumber;
	
	public function __construct($res)
	{
		$this->authToken = $res->data->access_token;
		$this->fullName = $res>data->name;
		$this->email = $res>data->email_address;
		$this->phoneNumber = $res>data->phone_number;
	}
	
	public function getLoginToken()
	{
		return $this->loginToken;
	}
	
	public function getFullName()
	{
		return $this->fullName;
	}
	
	public function getEmail()
	{
		return $this->email;
	}
	
	public function getPhoneNumber()
	{
		return $this->phoneNumber;
	}
}
