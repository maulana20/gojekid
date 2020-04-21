<?php
namespace Maulana20\Response;

class CustomerResponse
{
	private $result;
	
	public function __construct($res)
	{
		$this->result = $res->customer;
	}
	
	public function getResult()
	{
		return $this->result;
	}
}
