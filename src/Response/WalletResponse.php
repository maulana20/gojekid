<?php
namespace Maulana20\Response;

class BalanceResponse
{
	private $qrId;
	
	public function __construct($res)
	{
		$this->qrId = $res->data->qr_id;
	}
	
	public function getQrId()
	{
		return $this->qrId;
	}
}
