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
		GojekID::BASE_ENDPOINT . Action::transferGopay			=> 'Maulana20\Response\TransferResponse',
	];
	
	public function __construct($res, $url)
	{
		$res_json = json_decode($res);
		
		if (!$res_json->success) throw new ParseException($res_json->errors[0]->code . ' => ' . $res_json->errors[0]->message);
		
		$parts = parse_url($url);
		
		if ($parts['path'] == 'wallet/qr-code') {
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
