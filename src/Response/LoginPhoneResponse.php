<?php
namespace Maulana20\Response;

class LoginPhoneResponse
{
	private $loginToken;
	
	public function __construct($res)
	{
		$this->loginToken = $res->data->login_token;
	}
	
	public function getLoginToken()
	{
		return $this->loginToken;
	}
}
