<?php

class Dispatcher{
	
	protected $_request;

	protected $_controller;

	protected $_moduleName;

	public function __construct($request)
	{
		$this->_request = $request;
		$this->_resolveModule();
	}	

	public function setRequest($request)
	{
		$this->_request = $request;
		return $this;
	}

	public function getRequest()
	{
		return $this->_request;
	}

	protected function _resolveController()
	{
		
	}

	protected function _resolveModule()
	{
		

	}
}