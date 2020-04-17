<?php
use PHPUnit\Framework\TestCase;

use Maulana20\GojekID;

use Maulana20\Meta\Meta;
use Maulana20\Meta\Action;

use Maulana20\Response\LoginPhoneResponse;

class GojekTest extends TestCase
{
	/*
	 * gojek
	 * 
	 * @var \Maulana20\GojekID
	 */
	
	private $gojek;
	
	public function setUp()
	{
		$this->gojek = new GojekID();
	}
	
	public function tearDown()
	{}
	
	public function testMetaValue()
	{
		$this->assertSame('3.34.2', Meta::APP_VERSION);
		$this->assertNotSame('test', Meta::APP_VERSION);
		$this->assertIsString(Meta::APP_VERSION);
		
		$this->assertSame('Apple, iPhone 8', Meta::PHONE_MODEL);
		$this->assertNotSame('Android', Meta::PHONE_MODEL);
	}
	
	public function testEndPointUrlValue()
	{
		$this->assertSame('https://api.gojekapi.com/v3/customers/login_with_phone', GojekID::BASE_ENDPOINT . Action::loginPhone);
		$this->assertNotEquals('https://api.gojekapi.com', GojekID::BASE_ENDPOINT);
		$this->assertSame('https://api.gojekapi.com/v3/customers/token', GojekID::BASE_ENDPOINT . Action::loginGojek);
		$this->assertSame('https://api.gojekapi.com/wallet/profile', GojekID::BASE_ENDPOINT . Action::checkBalance);
	}
	
	public function testLoginPhoneResponse()
	{
		$data = <<<JSON
		{
			"data": { "login_token": "123" }
		}
JSON;
		
		$loginToken = (new LoginPhoneResponse(json_decode($data)))->getLoginToken();
		$this->assertEquals("123", $loginToken);
	}
}
