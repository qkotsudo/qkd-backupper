<?php
class QKDBackUpperDriverMySQL extends QKDBackUpperDriverBase {
	private	$strDBHost		= "localhost";
	private	$intDBPort		= 3306;
	private	$strDBUser		= "";
	private	$strDBPass		= "";
	private	$strDBName		= "";
	private	$intDepth			= 7;
	private	$flgMonthly		= false;

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

	public function setMonthly( $objVal ) {
		$this->flgMonthly		= $objVal;
		return $this;
	}


	public function drive() {
		// 汎用判定
		if ( !parent::drive() ) {
			return false;
		}

		// DBホスト未指定
		if ( $this->strDBHost == "" ) {
			echo "QKDBackUpperDriverMySQL::strDBHost : Undefined.\n";
			return false;

		// DBユーザ未指定
		} elseif ( $this->strDBUser == "" ) {
			echo "QKDBackUpperDriverMySQL::strDBUser : Undefined.\n";
			return false;

		// DBパスワード未指定
		} elseif ( $this->strDBPass == "" ) {
			echo "QKDBackUpperDriverMySQL::strDBPass : Undefined.\n";
			return false;

		// DB名未指定
		} elseif ( $this->strDBName == "" ) {
			echo "QKDBackUpperDriverMySQL::strDBName : Undefined.\n";
			return false;

		}
		$strFileSave		= date( "Ymd" ) . ".gz";
		$strFileDelete	= ( $this->intDepth > 0 )? date( "Ymd", mktime( 0,0,0, date( "m" ), date( "d" ) - $this->intDepth, date( "Y" ) ) ) . ".gz": "";
		$strFileKeep		= ( $this->flgMonthly )? date( "Ymt" ) . ".gz": "";
		$strCmd			= "ssh -p {$this->getSSHPort()} -i {$this->getSSHKey(true)} {$this->getSSHUser()}@{$this->getSSHHost()} \"mysqldump -u{$this->strDBUser} -p'{$this->strDBPass}' -h{$this->strDBHost} -P{$this->intDBPort} {$this->strDBName} | gzip -c\" > {$this->getDst()}/{$strFileSave}" ;

		if ( $this->cmd( $strCmd ) 	) {
			if ( $this->isDebug() ) {
				return true;
			}
			if (
				file_exists( "{$this->getDst()}/{$strFileSave}" ) &&
				filesize( "{$this->getDst()}/{$strFileSave}" ) > 0 &&
				$this->intDepth > 0 &&
				file_exists( "{$this->getDst()}/{$strFileDelete}" ) &&
				$strFileDelete != $strFileKeep
			) {
				$this->cmd( "rm -Rf {$this->getDst()}/{$strFileDelete}" );
			}
			return true;
		}

		return false;
	}
}
?>