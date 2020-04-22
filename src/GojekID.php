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
	
	private $authToken;
	
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
	
	public function setAuthToken($authToken)
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
	 * loginEmail
	 * 
	 * @param String			$email
	 * @return \Maulana20\Response\EmailResponse
	 */
	
	public function loginEmail($email)
	{
		$ch = new Curl();
		
		$data = [
			'email'				=> $email
		];
		
		return $ch->post(GojekID::BASE_ENDPOINT . Action::loginEmail, $data, $this->headers)->getResponse();
	}
	
	/**
	 * Login GOJEK
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
	 * Get Balance GOJEK
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
	 * Get Customer GOJEK
	 * 
	 * @return \Maulana20\Response\DefaultResponse
	 */
	
	public function getCustomer()
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GojekID::BASE_ENDPOINT . Action::getCustomer, $data, $this->headers)->getResponse();
	}
	
	/**
	 * Edit Akun Pengguna GOJEK
	 * 
	 * @return \Maulana20\Response\DefaultResponse
	 */
	
	public function editAccount($mobilePhone, $email, $name)
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [
			'phone'				=> $mobilePhone,
			'email'				=> $email,
			'name'				=> $name,
		];
		
		return $ch->post(GojekID::BASE_ENDPOINT . Action::editAccount, $data, $this->headers)->getResponse();
	}
	
	/**
	 * Logout GOJEK
	 * 
	 * @return \Maulana20\Response\DefaultResponse
	 */
	
	public function logout()
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->delete(GojekID::BASE_ENDPOINT . Action::logout, $data, $this->headers)->getResponse();
	}
	
	/**
	 * Get GOPAY Detail
	 * 
	 * @return \Maulana20\Response\DefaultResponse
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
	 * @return \Maulana20\Response\DefaultResponse
	 */
	
	public function gopayHistory($page, $limit)
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GojekID::BASE_ENDPOINT . Action::gopayHistory . '?' . http_build_query([ 'page' => $page, 'limit' => $limit ]), $data, $this->headers)->getResponse();
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
		
		return $ch->get(GojekID::BASE_ENDPOINT . Action::gopayWalletCode . '?phone_number=%2B62' . ltrim($mobilePhoneTo, '0'), $data, $this->headers)->getResponse();
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
	
	/**
	 * Get GOJEK History
	 * 
	 * @param String			$userId
	 * @return \Maulana20\Response\DefaultResponse
	 */
	
	public function gojekHistory($userId)
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GojekID::BASE_ENDPOINT . Action::gojekHistory . '/' . $userId, $data, $this->headers)->getResponse();
	}
	
	/**
	 * Get GOJEK Active Booking
	 * 
	 * @return \Maulana20\Response\DefaultResponse
	 */
	
	public function gojekActive()
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GojekID::BASE_ENDPOINT . Action::gojekActive, $data, $this->headers)->getResponse();
	}

	/**
	 * Get GOJEK By Order No
	 * 
	 * @param String			$orderNo
	 * @return \Maulana20\Response\DefaultResponse
	 */
	
	public function gojekByOrder($orderNo)
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GojekID::BASE_ENDPOINT . Action::gojekByOrder . '/' . $orderNo, $data, $this->headers)->getResponse();
	}
	
	/**
	 * Get GOJEK Calculate
	 * 
	 * @return \Maulana20\Response\DefaultResponse
	 */
	
	public function gojekCalculate()
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->post(GojekID::BASE_ENDPOINT . Action::gojekCalculate . '/', $data, $this->headers)->getResponse();
	}
	
	/**
	 * Get GOFOOD Home
	 * 
	 * @param String			$latLong
	 * @return \Maulana20\Response\DefaultResponse
	 */
	
	public function gofoodHome($latLong)
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GojekID::BASE_ENDPOINT . Action::gofoodHome . '?' . http_build_query([ 'location' => $latLong ]), $data, $this->headers)->getResponse();
	}
	
	/**
	 * Get GOFOOD Nearby
	 * 
	 * @param String			$latLong
	 * @param String			$page
	 * @param String			$limit
	 * @return \Maulana20\Response\DefaultResponse
	 */
	
	public function gofoodNearby($latLong, $page, $limit)
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GojekID::BASE_ENDPOINT . Action::gofoodHome . '?' . http_build_query([ 'location' => $latLong, 'page' => $page, 'limit' => $limit ]), $data, $this->headers)->getResponse();
	}
	
	/**
	 * Get GOFOOD Restaurant By Id
	 * 
	 * @param String			$restaurantId
	 * @return \Maulana20\Response\DefaultResponse
	 */
	
	public function gofoodRestaurantById($restaurantId)
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GojekID::BASE_ENDPOINT . Action::gofoodRestaurant . '/' . $restaurantId, $data, $this->headers)->getResponse();
	}
	
	/**
	 * Get GOFOOD Restaurant By Category
	 * 
	 * @param String			$category
	 * @param String			$page
	 * @param String			$limit
	 * @return \Maulana20\Response\DefaultResponse
	 */
	
	public function gofoodRestaurantByCategory($category, $page, $limit)
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GojekID::BASE_ENDPOINT . Action::gofoodRestaurant . '?' . http_build_query([ 'category' => $category, 'page' => $page, 'limit' => $limit ]), $data, $this->headers)->getResponse();
	}
	
	/**
	 * Get Driver Location
	 * 
	 * @param String			$latLong
	 * @return \Maulana20\Response\DefaultResponse
	 */
	
	public function areaLocation($latLong)
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GojekID::BASE_ENDPOINT . Action::areaLocation . '?' . http_build_query([ 'location' => $latLong ]), $data, $this->headers)->getResponse();
	}
	
	/**
	 * Get GORIDE Location
	 * 
	 * @param String			$latLong
	 * @return \Maulana20\Response\DefaultResponse
	 */
	
	public function gorideNearby($latLong)
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GojekID::BASE_ENDPOINT . Action::gorideNearby . '?' . http_build_query([ 'location' => $latLong ]), $data, $this->headers)->getResponse();
	}
	
	/**
	 * Get GOCAR Location
	 * 
	 * @param String			$latLong
	 * @return \Maulana20\Response\DefaultResponse
	 */
	
	public function gocarNearby($latLong)
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GojekID::BASE_ENDPOINT . Action::gocarNearby . '?' . http_build_query([ 'location' => $latLong ]), $data, $this->headers)->getResponse();
	}
	
	/**
	 * Get GOSEND Location
	 * 
	 * @param String			$latLong
	 * @return \Maulana20\Response\DefaultResponse
	 */
	
	public function gosendNearby($latLong)
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GojekID::BASE_ENDPOINT . Action::gosendNearby . '?' . http_build_query([ 'location' => $latLong ]), $data, $this->headers)->getResponse();
	}
	
	/**
	 * Get GOMART Location
	 * 
	 * @param String			$latLong
	 * @return \Maulana20\Response\DefaultResponse
	 */
	
	public function gomartNearby($latLong)
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GojekID::BASE_ENDPOINT . Action::gomartNearby . '?' . http_build_query([ 'location' => $latLong ]), $data, $this->headers)->getResponse();
	}
	
	/**
	 * Get GOPOINTS Balance
	 * 
	 * @return \Maulana20\Response\DefaultResponse
	 */
	
	public function gopointBalance()
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->get(GojekID::BASE_ENDPOINT . Action::gopointBalance, $data, $this->headers)->getResponse();
	}
	
	/**
	 * Get GOPOINTS Next Point
	 * 
	 * @return \Maulana20\Response\DefaultResponse
	 */
	
	public function gopointNext()
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->post(GojekID::BASE_ENDPOINT . Action::gopointNext, $data, $this->headers)->getResponse();
	}
	
	/**
	 * Get GOPOINTS Reedem Point
	 * 
	 * @return \Maulana20\Response\DefaultResponse
	 */
	
	public function gopointReedem($goPointsToken)
	{
		$ch = new Curl();
		
		$this->headers['Authorization'] = 'Bearer ' . $this->authToken;
		
		$data = [];
		
		return $ch->post(GojekID::BASE_ENDPOINT . Action::gopointReedem . '?' . http_build_query([ 'points_token_id' => $goPointsToken ]), $data, $this->headers)->getResponse();
	}
}
