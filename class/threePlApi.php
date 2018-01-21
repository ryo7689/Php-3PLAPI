<?php
/*
 *		This class is the main class of 3PL API 
 *
 */
?> 
<?php

class threePlApi{
	
	public $threePlId;
	public $threePlKey;
	public $username;
	public $pass;
	public $facilityId;
	public $customerId;
	public $xmlDoc;
	
	
	public function __construct(){
		$this->threePlId  = 'ThreePlId';
		$this->threePlKey = 'ThreePlKey';
		$this->username   = 'Username';
		$this->pass       = 'Password';
		$this->facilityId = 'FacilityId';
		$this->customerId = 'CustomerId';
		$this->xmlDoc = new DOMDocument;		
	}
	
	public function getThreePlId(){
		return $this->threePlId;
	}
	
	public function getThreePlKey(){
		return $this->threePlKey;
	}
	
	public function getThreePlUsername(){
		return $this->username;
	}
	public function getThreePlPass(){
		return $this->pass;
	}
	public function getFacilityId(){
		return $this->facilityId;
	}
	public function getCustomerId(){
		return $this->customerId;
	}
	public function getXMLDoc(){
		return $this->xmlDoc;
	}
	
	
}


?>
