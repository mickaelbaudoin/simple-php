<?php

namespace MickaelBaudoin\SimplePhp;

class Request{

	protected $_method;
	protected $_params = array();
	protected $_remoteIp;
	protected $_moduleName = "Front";
	protected $_controllerName = "index";
	protected $_actionName = "index";


	public function __construct()
	{
		$this->_init();
	}	

	protected function _init()
	{
		$this->_method = $_SERVER['REQUEST_METHOD'];
		$this->_remoteIp = $_SERVER['REMOTE_ADDR'];
		
		$this->_extractParams();
		$this->_verifyParams();
		$this->_resolveModuleName();
		$this->_resolveControllerName();
		$this->_resolveActionName();
		$this->_resolveParams();
	}

	protected function _extractParams()
	{
		$uri = explode("/", $_SERVER['REQUEST_URI']);
		//Delete first element
		array_shift($uri);
		if( count($uri) > 0){
			if(empty($uri[0])){
				array_shift($uri);
			}
		}
		$this->_params = $uri;
	}

	public function setRemoteIp($ip)
	{
		$this->_remoteIp = $ip;
		return $this->_remoteIp;
	}

	public function getRemoteIp()
	{
		return $this->_remoteIp;
	}

	public function setMethod($string)
	{
		$this->_method = $string;
		return $this;
	}

	public function getMethod()
	{
		if(empty($this->_method)){
			throw new \Exception("Not specified type request");
		}
		return $this->_method;
	}

	public function getControllerName()
	{
		return $this->_controllerName;
	}

	public function setControllerName($controllerName)
	{
		$this->_controllerName = $controllerName;
		return $this;
	}

	public function getModuleName()
	{
		return $this->_moduleName;
	}

	public function setModuleName($moduleName)
	{
		$this->_moduleName = $moduleName;
		return $this;
	}

	public function getActionName()
	{
		return $this->_actionName;
	}

	public function setActionName($actionName)
	{
		$this->_actionName = $actionName;
		return $this;
	}

	public function addParam($key, $value)
	{
		$this->_params[$key] = $value;
		return $this;
	}

	public function setParams($params)
	{
		$this->_params = $params;
		return $this;
	}

	public function getParams()
	{
		return $this->_params;
	}

	public function getParam($key)
	{
		if(array_key_exists($key, $this->_params)){
			if(!empty($this->_params[$key])){
				return $this->_params[$key];
			}
		}

		throw new \Exception("key not found");
	}

	protected function _resolveModuleName()
	{
		if(count($this->_params) > 0){
			$moduleName = ucfirst($this->_params[0]);
			if( !empty($moduleName) && is_dir(APPLICATION_MODULE_PATH . $moduleName)){
				array_shift($this->_params);
				$this->_moduleName = ucfirst($moduleName);
			}
		}
	}

	protected function _resolveControllerName()
	{
		if(count($this->_params) > 0){
			if(isset($this->_params[0]) && !empty($this->_params[0])){
				$this->_controllerName = $this->_params[0];
				array_shift($this->_params);
			}
		}
	}

	protected function _resolveActionName()
	{

		if(count($this->_params) > 0){
			if(isset($this->_params[0]) && !empty($this->_params[0])){
				$this->_actionName = $this->_params[0];
				array_shift($this->_params);
			}
		}
	}

	protected function _resolveParams()
	{
		$paramResolved = array();
		if(count($this->_params) > 0){
			$nextValue = "";
			foreach($this->_params as $key => $value){
				if($this->_isPair($key)){
					$nextValue = $value;
					$paramResolved[$value] = "undefined";
				}else{
					$paramResolved[$nextValue] = $value;
				}
			}
		}

		$this->_params = $paramResolved;
	}

	protected function _verifyParams()
	{
		//Delete balise html and php
		if(count($this->_params) > 0){
			$params = $this->_params;
			foreach($params as $key => $value) {
				strip_tags($this->_params[$key]);
			}
			
		}
	}

	protected function _isPair($nbr)
	{
		if( ($nbr % 2) == 0){
			return true;
		}

		return false;
	}
}