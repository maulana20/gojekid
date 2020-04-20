<?php
namespace Maulana20;

use Maulana20\Meta\Action;

class ParseResponse
{
	private $response;
	
	public $storeClass = [
		GojekID::BASE_ENDPOINT . Action::loginPhone				=> 'Maulana20\Response\LoginPhoneResponse',
		GojekID::BASE_ENDPOINT . Action::loginGojek				=> 'Maulana20\Response\LoginGojekResponse',
		GojekID::BASE_ENDPOINT . Action::checkBalance			=> 'Maulana20\Response\BalanceResponse',
		GojekID::BASE_ENDPOINT . Action::gopayTransfer			=> 'Maulana20\Response\TransferResponse',
		GojekID::BASE_ENDPOINT . Action::gopayDetail			=> 'Maulana20\Response\DetailResponse',
	];
	
	public function __construct($res, $url)
	{
		$res_json = json_decode($res);
		
		if (isset($res_json->success)) {
			if ($res_json->success == false) throw new ParseException($url . ' ' . $res_json->errors[0]->code . ' => ' . $res_json->errors[0]->message);
		}
		
		$parts = parse_url($url);
		
		if ($parts['path'] == '/wallet/qr-code') {
			$this->response = new \Maulana20\Response\WalletResponse($res_json);
		} else {
			$this->response = new $this->storeClass[$url]($res_json);
		}
	}
	
	public function getResponse()
	{
		return $this->response;
	}
}

class ParseException extends \Exception
{}
