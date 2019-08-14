<?php

class Tealium_Extend_Helper_Data extends Tealium_Tags_Helper_Data {

	protected $tealium;
	protected $store;
	protected $page;

	//@Override
	public function addCustomDataFromSetup(&$store, $pageType){
		$data = array (
				"store" => $this->store,
				"page" => $this->page
		);
		if (Mage::getStoreConfig ( 'tealium_tags/general/udo_enable', $store )) {
			include_once (__DIR__.'/TealiumCustomData.php');
	
			if ( function_exists("getCustomUdo") ){
				$customUdoElements = getCustomUdo();
				if ( is_array($customUdoElements) && parent::isAssocArray($customUdoElements) ){
					$udoElements = $customUdoElements;
				}
			}
			elseif (!isset($udoElements) || ( isset($udoElements) && !parent::isAssocArray($udoElements) )){
				$udoElements = array();
			}
				
			if ( isset($udoElements[$pageType]) ){
				$this->tealium->setCustomUdo($udoElements[$pageType]);
			}
				
		}
	
		return $this;
	}
}