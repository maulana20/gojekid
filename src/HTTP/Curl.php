<?php
namespace Maulana20\HTTP;

use Maulana20\ParseResponse;

class Curl
{
	public $ch;
	
	private function _getHeaders($headers)
	{
		$result = [];
		
		foreach ($headers as $key => $val) { array_push($result, $key . ': ' . $val); }
		
		return $result;
	}
	
	public function __construct()
	{
		$this->ch = curl_init();
	}
	
	public function delete($url, $data, $headers)
	{
		$headers['Content-Type'] = 'application/json;charset=UTF-8';
		
		curl_setopt($this->ch, CURLOPT_URL, $url);
		curl_setopt($this->ch, CURLOPT_POST, false);
		curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->_getHeaders($headers));
		
		$result = curl_exec($this->ch);
		
		curl_close($this->ch);
		
		return new ParseResponse($result, $url);
	}
	
	public function get($url, $data, $headers)
	{
		$headers['Content-Type'] = 'application/json;charset=UTF-8';
		
		curl_setopt($this->ch, CURLOPT_URL, $url);
		curl_setopt($this->ch, CURLOPT_POST, false);
		curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->_getHeaders($headers));
		
		$result = curl_exec($this->ch);
		
		curl_close($this->ch);
		
		return new ParseResponse($result, $url);
	}
	
	public function post($url, $data, $headers)
	{
		$headers['Content-Type'] = 'application/json;charset=UTF-8';
		
		curl_setopt($this->ch, CURLOPT_URL, $url);
		curl_setopt($this->ch, CURLOPT_POST, true);
		curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->_getHeaders($headers));
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($data));
		
		$result = curl_exec($this->ch);
		
		curl_close($this->ch);
		
		return new ParseResponse($result, $url);
	}
}
