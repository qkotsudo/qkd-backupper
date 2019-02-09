<?php
class QSBackUpperProfile extends QSBackUpperBase {
	private	$strName			= "";
	private	$arrTargetDir	= array();
	private	$arrTargetDB	= array();
	private	$arrReportMail	= array();

	public function __construct( $strName ) {
		global $arrProfile;
		if ( isset( $arrProfile[ $strName ] ) ) {
			return $arrProfile[ $strName ];
		} else {
			$this->strName				= $strName;
			$arrProfile[ $strName ]	= $this;
			return $this;
		}
	}

	public function setName( $objVal ) {
		$this->strName		= $objVal;
		return $this;
	}

	public function getName() {
		return $this->strName;
	}

	public function addReportMail( $objVal ) {
		if ( !isset( $this->arrReportMail[ $objVal ] ) ) {
			$this->arrReportMail[ $objVal ]	= new QSBackUpperReportMail();
			return $this->arrReportMail[ $objVal ];
		}
		return false;
	}

	public function addTargetDir( $objVal ) {
		if ( !isset( $this->arrTargetDir[ $objVal ] ) ) {
			$this->arrTargetDir[ $objVal ]	= new QSBackUpperDriverDir();
			return $this->arrTargetDir[ $objVal ];
		}
		return false;
	}

	public function addTargetDB( $objVal ) {
		if ( !isset( $this->arrTargetDB[ $objVal ] ) ) {
			$this->arrTargetDB[ $objVal ]	= new QSBackUpperDriverMySQL();
			return $this->arrTargetDB[ $objVal ];
		}
		return false;
	}

	public function load() {
		global $arrProfile;
		if ( !isset( $arrProfile[ $this->strName ] ) ) {
			$arrProfile[ $this->strName ]	= $this;
		}
	}

	public function drive() {
		$flgOK	= true;
		foreach ( $this->arrTargetDir as $objTargetDir ) {
			$objTargetDir->setDebug( $this->isDebug() );
			if ( $flgOK ) {
				$flgOK	= $objTargetDir->drive();
			}
		}
		foreach ( $this->arrTargetDB as $objTargetDB ) {
			$objTargetDB->setDebug( $this->isDebug() );
			if ( $flgOK ) {
				$flgOK	= $objTargetDB->drive();
			}
		}
		if ( $flgOK ) {
			foreach ( $this->arrReportMail as $objReportMail ) {
				$flgOK	= $objReportMail->drive();
			}
		}
		return $flgOK;
	}
}
?>