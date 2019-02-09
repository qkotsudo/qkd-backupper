<?php
class QSBackUpperReportMail extends QSBackUpperReportBase {
	private	$strFromName		= "";
	private	$strFromAddress	= "";
	private	$arrTo					= array();

	public function addTo( $objVal ) {
		if ( !isset( $this->arrTo[ $objVal ] ) ) {
			$this->arrTo[ $objVal ]	= $objVal;
		}
		return $this;
	}

	public function setFrom( $strAddress, $strName = "" ) {
		$this->strFromAddress	= $strAddress;
		$this->strFromName		= $strName;
		return $this;
	}

	public function drive() {
		return true;
	}
}
?>