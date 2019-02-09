<?php
class QSBackUpperDriverMySQL extends QSBackUpperDriverBase {
	private	$strDBHost		= "localhost";
	private	$intDBPort		= 3306;
	private	$strDBUser		= "";
	private	$strDBPass		= "";
	private	$strDBName		= "";
	private	$intDepth			= 7;

	public function setDBHost( $objVal ) {
		$this->strDBHost		= $objVal;
		return $this;
	}

	public function setDBPort( $objVal ) {
		$this->intDBPort		= $objVal;
		return $this;
	}

	public function setDBUser( $objVal ) {
		$this->strDBUser		= $objVal;
		return $this;
	}

	public function setDBPass( $objVal ) {
		$this->strDBPass		= $objVal;
		return $this;
	}

	public function setDBName( $objVal ) {
		$this->strDBName		= $objVal;
		return $this;
	}

	public function setDepth( $objVal ) {
		$this->intDepth			= $objVal;
		return $this;
	}

	public function drive() {
		return true;
	}
}
?>