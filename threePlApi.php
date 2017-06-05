<?php


class threePlApi
{
	private $threePlId;
	private $threePlKey;
	private $username;
	private $pass;
	private $facilityId;
	private $customerId;
	
	
	function __construct()
	{
		$threePlId = 'ThreePlId';
		$threePlKey = 'ThreePlKey';
		$username   = 'Username';
		$pass       = 'Password';
		$facilityId = 'FacilityId';
		$customerId = 'CustomerId';		
	}
	
	function getThreePlId()
	{
		return $this->threePlId;
	}
	
	function getThreePlKey()
	{
		return $this->threePlKey;
	}
	
	function getThreePlUsername()
	{
		return $this->username;
	}
	function getThreePlPass()
	{
		return $this->pass;
	}
	
	function getFacilityId()
	{
		return $this->facilityId;
	}
	
	function getCustomerId()
	{
		return $this->customerId;
	}
	
	function findOrder($beginDate, $endDate)
	{
		$doc = new DOMDocument;
		$xmldata = file_get_contents("Request/findOrders.xml");
		$doc->loadXML($xmldata);

		$doc->getElementsByTagName('ThreePLID')->item(0)->nodeValue = $this->getThreePlId();
		$doc->getElementsByTagName('Login')->item(0)->nodeValue     = $this->getThreePlUsername();
		$doc->getElementsByTagName('Password')->item(0)->nodeValue  = $this->getThreePlPass();

		$doc->getElementsByTagName('CustomerID')->item(0)->nodeValue = $this->getCustomerId();
		$doc->getElementsByTagName('FacilityID')->item(0)->nodeValue = $this->getFacilityId();
		$doc->getElementsByTagName('BeginDate')->item(0)->nodeValue  = $beginDate;
		$doc->getElementsByTagName('EndDate')->item(0)->nodeValue    = $endDate;

		$resultXML = $doc->saveXML();

		return $resultXML;
	}
	
	function createItems($sku, $desc1)
	{

		$doc = new DOMDocument;
		$xmldata = file_get_contents("Request/createItems.xml");
		$doc->loadXML($xmldata);

		$doc->getElementsByTagName('ThreePLKey')->item(0)->nodeValue = $this->getThreePlKey();
		$doc->getElementsByTagName('Login')->item(0)->nodeValue      = $this->getThreePlUsername();
		$doc->getElementsByTagName('Password')->item(0)->nodeValue   = $this->getThreePlPass();
		$doc->getElementsByTagName('FacilityID')->item(0)->nodeValue = $this->getFacilityId();
		
		$doc->getElementsByTagName('SKU')->item(0)->nodeValue         = $sku;
		$doc->getElementsByTagName('Description')->item(0)->nodeValue = $desc1;

		$resultXML = $doc->saveXML();

		return $resultXML;
	}
	
	function createOrders($data) //Return 1 on successful
	{
		$doc = new DOMDocument;
		$doc->preserveWhiteSpace = false;
		$doc->formatOutput = true;
		$xmldata = file_get_contents("Request/createOrders.xml");
		$doc->loadXML($xmldata);

		$doc->getElementsByTagName('ThreePLKey')->item(0)->nodeValue = $this->getThreePlKey();
		$doc->getElementsByTagName('Login')->item(0)->nodeValue      = $this->getThreePlUsername();
		$doc->getElementsByTagName('Password')->item(0)->nodeValue   = $this->getThreePlPass();
		$doc->getElementsByTagName('FacilityID')->item(0)->nodeValue = $this->getFacilityId();

		$doc->getElementsByTagName('ReferenceNum')->item(0)->nodeValue  = $data['ref'];
		$doc->getElementsByTagName('PONum')->item(0)->nodeValue         = $data['poNum'];
		
		$doc->getElementsByTagName('Name')->item(0)->nodeValue          = $data['name'];
		$doc->getElementsByTagName('CompanyName')->item(0)->nodeValue   = $data['companyName'];
		$doc->getElementsByTagName('Address1')->item(0)->nodeValue      = $data['address1'];
		$doc->getElementsByTagName('City')->item(0)->nodeValue          = $data['city'];
		$doc->getElementsByTagName('ZIP')->item(0)->nodeValue           = $data['postcode'];
		$doc->getElementsByTagName('Notes')->item(0)->nodeValue         = $data['note'];
		$doc->getElementsByTagName('ShippingNotes')->item(0)->nodeValue = $data['note'];
		
		$doc->getElementsByTagName('PhoneNumber1')->item(0)->nodeValue  = $data['phoneNumber1'];
		$doc->getElementsByTagName('EmailAddress1')->item(0)->nodeValue = $data['emailAddress1'];
		
		
		foreach ($data['items'] as $item)
		{
			$itemArray   = explode('*',$item);

			$newItem = $doc->createElement('OrderLineItem');
			$newSku  = $doc->createElement('SKU', $itemArray[0]);
			$newItem->appendChild($newSku);
			$newQty = $doc->createElement('Qty', $itemArray[1]);
			$newItem->appendChild($newQty);

			$doc->getElementsByTagName('OrderLineItems')->item(0)->appendChild($newItem);
		}

		$resultXML = $doc->saveXML();

		return $resultXML;
	}
	
	
	
	
	
}

?>
