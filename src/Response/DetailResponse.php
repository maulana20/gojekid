<?php
namespace Maulana20\Response;

class DetailResponse
{
	private $result;
	
	public function __construct($res)
	{
		$this->result = $res->data;
	}
	
	public function getResult()
	{
		return $this->result;
	}
}
