<?php
namespace Maulana20\Response;

class DetailResponse
{
	private $qrId;
	private $currency;
	private $name;
	private $mobile;
	private $result;
	
	public function __construct($res)
	{
		$this->qrId = $res->data->qr_id;
		$this->currency = $res->data->currency;
		$this->name = $res->data->name;
		$this->mobile = $res->data->mobile;
		$this->result = $res->data;
	}
	
	public function getResult()
	{
		return $this->result;
	}
	
	public function getQrId()
	{
		return $this->qrId;
	}
	
	public function getCurrency()
	{
		return $this->currency;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function getMobile()
	{
		return $this->mobile;
	}
}
