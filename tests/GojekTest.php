<?php
use PHPUnit\Framework\TestCase;

use Maulana20\GojekID;

use Maulana20\Meta\Meta;
use Maulana20\Meta\Action;

use Maulana20\Response\LoginPhoneResponse;
use Maulana20\Response\LoginGojekResponse;
use Maulana20\Response\BalanceResponse;
use Maulana20\Response\WalletResponse;
use Maulana20\Response\TransferResponse;
use Maulana20\Response\CustomerResponse;

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
		// Akun Pengguna GOJEK
		$this->assertSame('https://api.gojekapi.com/v3/customers/login_with_phone', GojekID::BASE_ENDPOINT . Action::loginPhone);
		$this->assertNotEquals('https://api.gojekapi.com', GojekID::BASE_ENDPOINT);
		$this->assertSame('https://api.gojekapi.com/v3/customers/token', GojekID::BASE_ENDPOINT . Action::loginGojek);
		$this->assertSame('https://api.gojekapi.com/gojek/v2/customer', GojekID::BASE_ENDPOINT . Action::getCustomer);
		$this->assertSame('https://api.gojekapi.com/gojek/v2/customer/edit/v2', GojekID::BASE_ENDPOINT . Action::editAccount);
		$this->assertSame('https://api.gojekapi.com/wallet/profile', GojekID::BASE_ENDPOINT . Action::checkBalance);
		$this->assertSame('https://api.gojekapi.com/v3/auth/token', GojekID::BASE_ENDPOINT . Action::logout);
		// Akun Pengguna GOPAY
		$this->assertSame('https://api.gojekapi.com/v2/fund/transfer', GojekID::BASE_ENDPOINT . Action::gopayTransfer);
		$this->assertSame('https://api.gojekapi.com/wallet/profile/detailed', GojekID::BASE_ENDPOINT . Action::gopayDetail);
	}
	
	public function testLoginPhoneResponse()
	{
		$data = <<<JSON
		{
			"data": { "login_token": "e16e7cf0-7621-419d-9f67-36aa8b919f34" }
		}
JSON;
		
		$loginToken = (new LoginPhoneResponse(json_decode($data)))->getLoginToken();
		$this->assertEquals("e16e7cf0-7621-419d-9f67-36aa8b919f34", $loginToken);
	}
	
	public function testLoginGojekResponse()
	{
		$data = <<<JSON
		{
			"data": { "access_token": "d5579ff6-d194-473a-b3cf-0b903f5f7324" }
		}
JSON;
		
		$authToken = (new LoginGojekResponse(json_decode($data)))->getAuthToken();
		$this->assertEquals("d5579ff6-d194-473a-b3cf-0b903f5f7324", $authToken);
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
			"data": { "qr_id": "3b62005b-8905-406d-9830-26c06c55b3ed" }
		}
JSON;
		
		$QrId = (new WalletResponse(json_decode($data)))->getQrId();
		$this->assertEquals("3b62005b-8905-406d-9830-26c06c55b3ed", $QrId);
	}
	
	public function testTransferResponse()
	{
		$data = <<<JSON
		{
			"data": { "transaction_ref": "02137d45-31e4-4d70-b0a0-40ec73f451e4" }
		}
JSON;
		
		$ref = (new TransferResponse(json_decode($data)))->getRef();
		$this->assertEquals("02137d45-31e4-4d70-b0a0-40ec73f451e4", $ref);
	}
	
	public function testCustomerResponse()
	{
		$data = <<<JSON
		{
			"customer": { "name": "maulana20" }
		}
JSON;
		
		$result = (new CustomerResponse(json_decode($data)))->getResult();
		$this->assertEquals("maulana20", $result->name);
	}
}
