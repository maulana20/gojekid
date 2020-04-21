<?php
namespace Maulana20\Response;

class DefaultResponse
{
	private $result;
	private $result_v2;
	
	public function __construct($res)
	{
		$this->result = $res->data;
		$this->result_v2 = $res;
	}
	
	public function getResult()
	{
		return $this->result;
	}
	
	public function getResultV2()
	{
		return $this->result_v2;
	}
}
