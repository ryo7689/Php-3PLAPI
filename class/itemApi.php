<?php
/*
 *		This class containing the operations of items 
 *
 */
?>

<?php

class threePlItem extends threePlApi{
	
	private $itemXMLPath = "Request/findOrders.xml";
	
	public function createItems($sku, $desc1){
		$doc = $this->getXMLDoc();
		$xmldata = file_get_contents($itemXMLPath);
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
}



?>