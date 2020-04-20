<?php
use PHPUnit\Framework\TestCase;

use Maulana20\GojekID;

use Maulana20\Meta\Meta;
use Maulana20\Meta\Action;

use Maulana20\Response\LoginPhoneResponse;
use Maulana20\Response\LoginGojekResponse;
use Maulana20\Response\BalanceResponse;
use Maulana20\Response\WalletResponse;

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
		
		$this->assertSame('iOS, 12.3.1', Meta::DEVICE_OS);
		$this->assertNotSame('Apple', Meta::DEVICE_OS);
	}
	
	public function testEndPointUrlValue()
	{
		$this->assertSame('https://api.gojekapi.com/v3/customers/login_with_phone', GojekID::BASE_ENDPOINT . Action::loginPhone);
		$this->assertNotEquals('https://api.gojekapi.com', GojekID::BASE_ENDPOINT);
		$this->assertSame('https://api.gojekapi.com/v3/customers/token', GojekID::BASE_ENDPOINT . Action::loginGojek);
		$this->assertSame('https://api.gojekapi.com/wallet/profile', GojekID::BASE_ENDPOINT . Action::checkBalance);
		$this->assertSame('https://api.gojekapi.com/v2/fund/transfer', GojekID::BASE_ENDPOINT . Action::transferGopay);
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
	
	public function testLoginGojekResponse()
	{
		$data = <<<JSON
		{
			"data": { "access_token": "123" }
		}
JSON;
		
		$authToken = (new LoginGojekResponse(json_decode($data)))->getAuthToken();
		$this->assertEquals("123", $authToken);
	}
	
	public function testBalanceResponse()
	{
		$data = <<<JSON
		{
			"data": { "balance": "2500" }
		}
JSON;
		
		$balance = (new BalanceResponse(json_decode($data)))->getBalance();
		$this->assertEquals("2500", $balance);
	}
	
	public function testWalletResponse()
	{
		$data = <<<JSON
		{
			"data": { "qr_id": "123" }
		}
JSON;
		
		$QrId = (new WalletResponse(json_decode($data)))->getQrId();
		$this->assertEquals("123", $QrId);
	}
}
