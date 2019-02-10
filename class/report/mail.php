<?php
class QSBackUpperReportMail extends QSBackUpperReportBase {
	private	$strFromName		= "";
	private	$strFromAddress	= "";
	private	$arrTo					= array();
	private	$strMode				= "local";
	private	$strSubject			= "";
	private	$strBody				= "";

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

	public function setSubject( $objVal ) {
		$this->strSubject	= $objVal;
		return $this;
	}

	public function setBody( $objVal ) {
		$this->strBody	= $objVal;
		return $this;
	}

	public function drive() {
		switch ( $this->strMode ) {
			case "local":
				mb_language( "Japanese" );
				mb_internal_encoding( "UTF-8" );
				mb_send_mail(
					implode( ", ", $this->arrTo ),
					$this->strSubject,
					$this->strBody,
					"From: {$this->strFromName}<{$this->strFromAddress}>"
				);
				break;
		}
		return true;
	}
}
?>