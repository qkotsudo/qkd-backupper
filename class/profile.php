<?php
class QKDBackUpperProfile extends QKDBackUpperBase {
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
			$this->arrReportMail[ $objVal ]	= new QKDBackUpperReportMail();
			return $this->arrReportMail[ $objVal ];
		}
		return false;
	}

	public function addTargetDir( $objVal ) {
		if ( !isset( $this->arrTargetDir[ $objVal ] ) ) {
			$this->arrTargetDir[ $objVal ]	= new QKDBackUpperDriverDir();
			return $this->arrTargetDir[ $objVal ];
		}
		return false;
	}

	public function addTargetDB( $objVal ) {
		if ( !isset( $this->arrTargetDB[ $objVal ] ) ) {
			$this->arrTargetDB[ $objVal ]	= new QKDBackUpperDriverMySQL();
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
		$strReportSubject	= "qkd-backupper report : " . date( "Y-m-d" );
		$strReportBody		= "The Profile {$this->strName} has been processed.\n\n";
		$arrError				= array();

		foreach ( $this->arrTargetDir as $strTargetName => $objTargetDir ) {
			$objTargetDir->setDebug( $this->isDebug() );
			$objTargetDir->setBaseDir( $this->getBaseDir() );
			$strReportBody		.= "DIR : {$strTargetName} : ";
			if ( $objTargetDir->drive() ) {
				$strReportBody	.= "SUCCESS\n";
			} else {
				$strReportBody.=	"FAIL\n";
				$arrError[]		= $strTargetName;
			}
		}
		foreach ( $this->arrTargetDB as $strTargetName => $objTargetDB ) {
			$objTargetDB->setDebug( $this->isDebug() );
			$objTargetDB->setBaseDir( $this->getBaseDir() );
			$strReportBody		.= "DB : {$strTargetName} : ";
			if ( $objTargetDB->drive() ) {
				$strReportBody	.= "SUCCESS\n";
			} else {
				$strReportBody.=	"FAIL\n";
				$arrError[]		= $strTargetName;
			}
		}

		if ( $this->isDebug() ) {
			exit;
		}

		foreach ( $this->arrReportMail as $objReportMail ) {
			$objReportMail->setSubject( $strReportSubject )
									->setBody( $strReportBody )
									->drive();
		}
		return ( count( $arrError ) == 0 );
	}
}
?>