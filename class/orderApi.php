<?php
/*
 *		This class containing the operations of orders 
 *
 */
?>

<?php

class threePlOrder extends threePlApi{	
	
	private $orderXMLPath = "Request/findOrders.xml";
	private $createOrderXMLPath = "Request/createOrders.xml";
	
	
	/**
	 * Find Order from Online Distribution System 
	 *
	 * @param date $beginDate  Date from
	 * @param date $endDate Date to
	 * 
	 * @return resultXML to be sent
	 */ 
	public function findOrder($beginDate, $endDate){
		$doc = $this->getXMLDoc();
		$xmldata = file_get_contents($this->orderXMLPath);
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
	
	/**
	 * Find Order from Online Distribution System 
	 *
	 * @param array $data  Order data from Omins system
	 * 
	 * @return resultXML to be sent to create order
	 */ 	
	public function createOrders($data){ //Return 1 on successful
		$doc = $this->getXMLDoc();
		$doc->preserveWhiteSpace = false;
		$doc->formatOutput = true;
		$xmldata = file_get_contents($createOrderXMLPath);
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
		
		
		foreach ($data['items'] as $item){
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