<?php
namespace Maulana20;

use Maulana20\Http\Curl;
use Maulana20\Meta\Meta;
use Maulana20\Meta\Action;

class GojekID
{
	const BASE_ENDPOINT = 'https://api.gojekapi.com/';
	
	/** 
	 * Authorization Token
	 * 
	 * @var String
	 */
	
	public $authToken;
	
	private $headers = [
		'X-AppVersion'	=> Meta::APP_VERSION,
		'X-Location'	=> Meta::LOCATION,
		'X-PhoneModel'	=> Meta::PHONE_MODEL,
		'X-DeviceOS'	=> Meta::DEVICE_OS,
	];
	
	public function __construct()
	{
		$this->headers['X-Uniqueid'] = gen_uuid();
	}
	
	/**
	 *  Authorization Token
	 * 
	 * @var String
	 */
	
	public function setToken($authToken)
	{
		$this->authToken = $authToken;
	}
	
	/**
	 * loginPhone
	 * 
	 * @param String			$mobilePhone
	 * @return \Maulana20\Response\LoginPhoneResponse
	 */
	
	public function loginPhone($mobilePhone)
	{
		$ch = new Curl();
		
		$data = [
			'phone'				=> $mobilePhone
		];
		
		return $ch->post(GojekID::BASE_ENDPOINT . Action::loginPhone, $data, $this->headers)->getResponse();
	}
	
	/**
	 * loginGojek
	 * 
	 * @param String			$loginToken
	 * @param String			$OTP
	 * @return \Maulana20\Response\LoginGojekResponse
	 */
	
	public function loginGojek($loginToken, $OTP)
	{
		$ch = new Curl();
		
		$data = [
			'scopes'			=> 'gojek:customer:transaction gojek:customer:readonly',
			'grant_type'		=> 'password',
			'login_token'		=> $loginToken,
			'otp'				=> $OTP,
			'client_id'			=> 'gojek:cons:android',
			'client_secret'		=> '83415d06-ec4e-11e6-a41b-6c40088ab51e'
		];
		
		return $ch->post(GojekID::BASE_ENDPOINT . Action::loginGojek, $data, $this->headers)->getResponse();
	}
	
	/**
	 * Get Balance Gojek
	 * 
	 * @return \Maulana20\Response\BalanceResponse
	 */
	
	public function checkBalance()
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GojekID::BASE_ENDPOINT . Action::checkBalance, $data, $this->headers)->getResponse();
	}
	
	/**
	 * Get GOPAY Detail
	 * 
	 * @return \Maulana20\Response\DetailResponse
	 */
	
	public function gopayDetail()
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GojekID::BASE_ENDPOINT . Action::gopayDetail, $data, $this->headers)->getResponse();
	}
	
	/**
	 * Get GOPAY History
	 * 
	 * @return \Maulana20\Response\HistoryResponse
	 */
	
	public function gopayHistory($page, $limit)
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GojekID::BASE_ENDPOINT . 'wallet/history?page=' . $page . '&limit=' . $limit, $data, $this->headers)->getResponse();
	}
	
	/**
	 * Get Wallet Code
	 * 
	 * @param String			$mobilePhoneTo
	 * @return \Maulana20\Response\WalletResponse
	 */
	
	public function checkWalletCode($mobilePhoneTo)
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GojekID::BASE_ENDPOINT . 'wallet/qr-code?phone_number=%2B62' . ltrim($mobilePhoneTo, '0'), $data, $this->headers)->getResponse();
	}
	
	/**
	 * Transfer GOPAY
	 * 
	 * @param String			$QRID
	 * @param String			$PIN
	 * @param Float				$amount
	 * @param String			$description
	 * @return \Maulana20\Response\WalletResponse
	 */
	
	public function gopayTransfer($QRID, $PIN, $amount, $description)
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		$this->headers['pin'] = $PIN;
		$this->headers['User-Agent'] = 'Gojek/3.34.1 (com.go-jek.ios; build:3701278; iOS 12.3.1) Alamofire/4.7.3';
		
		$data = [
			'qr_id'				=> $QRID,
			'amount'			=> $amount,
			'description'		=> $description
		];
		
		return $ch->post(GojekID::BASE_ENDPOINT . Action::gopayTransfer, $data, $this->headers)->getResponse();
	}
}
