<?php
namespace Maulana20;

use Maulana20\Meta\Action;

class ParseResponse
{
	private $response;
	
	public $storeClass = [
		// Akun Pengguna GOJEK
		GojekID::BASE_ENDPOINT . Action::loginEmail				=> 'Maulana20\Response\LoginEmailResponse',
		GojekID::BASE_ENDPOINT . Action::loginPhone				=> 'Maulana20\Response\LoginPhoneResponse',
		GojekID::BASE_ENDPOINT . Action::loginGojek				=> 'Maulana20\Response\LoginGojekResponse',
		GojekID::BASE_ENDPOINT . Action::checkBalance			=> 'Maulana20\Response\BalanceResponse',
		GojekID::BASE_ENDPOINT . Action::getCustomer			=> 'Maulana20\Response\CustomerResponse',
		// Akun Pengguna GOPAY
		GojekID::BASE_ENDPOINT . Action::gopayTransfer			=> 'Maulana20\Response\TransferResponse',
	];
	
	public function __construct($res, $url)
	{
		$res_json = json_decode($res);
		
		if (isset($res_json->message) && $res_json->message != 'OK') throw new ParseException($url . ' ' . $res_json->message);
		if (isset($res_json->success) && $res_json->success == false) throw new ParseException($url . ' ' . $res_json->errors[0]->code . ' => ' . $res_json->errors[0]->message);
		
		$parts = parse_url($url);
		
		if ($parts['path'] == '/wallet/qr-code') {
			$this->response = new \Maulana20\Response\WalletResponse($res_json);
		} else if ($parts['path'] == '/wallet/history') {
			$this->response = new \Maulana20\Response\DefaultResponse($res_json);
		} else {
			$this->response = (!empty($this->storeClass[$url])) ? new $this->storeClass[$url]($res_json) : new \Maulana20\Response\DefaultResponse($res_json);
		}
	}
	
	public function getResponse()
	{
		return $this->response;
	}
}

class ParseException extends \Exception
{}
