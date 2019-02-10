<?php
class QKDBackUpperDriverBase extends QKDBackUpperBase {
	private	$strSSHHost		= "";
	public function setSSHHost( $objVal ) {
		$this->strSSHHost		= $objVal;
		return $this;
	}

	public function getSSHHost() {
		return $this->strSSHHost;
	}


	private	$intSSHPort		= 22;
	public function setSSHPort( $objVal ) {
		$this->intSSHPort	= $objVal;
		return $this;
	}

	public function getSSHPort() {
		return $this->intSSHPort;
	}


	private	$strSSHKey		= "";
	public function setSSHKey( $objVal ) {
		$this->strSSHKey		= $objVal;
		return $this;
	}

	public function getSSHKey( $flgPath = false ) {
		return ( $flgPath )? "{$this->getBaseDir()}/key/{$this->strSSHKey}": $this->strSSHKey;
	}


	private	$strSSHUser	= "";
	public function setSSHUser( $objVal ) {
		$this->strSSHUser		= $objVal;
		return $this;
	}

	public function getSSHUser() {
		return $this->strSSHUser;
	}


	private	$strDst			= "";
	public function setDst( $objVal ) {
		$this->strDst			= rtrim( $objVal, "/" );
		return $this;
	}

	public function getDst() {
		return $this->strDst;
	}


	public function drive() {
		// 先ディレクトリ未指定
		if ( $this->getDst() == "" ) {
			echo "QKDBackUpperDriverDir::strDst : Undefined.\n";
			return false;

		// 先ディレクトリ不在
		} elseif ( !file_exists( $this->getDst() ) ) {
			echo "{$this->getDst()} : Not found.\n";
			return false;

		// 先ディレクトリ不在
		} elseif ( !file_exists( $this->getDst() ) ) {
			echo "{$this->getDst()} : Not found.\n";
			return false;

		// 先ディレクトリ書き込みエラー
		} elseif ( !is_writable( $this->getDst() ) ) {
			echo "{$this->getDst()} : Not writable.\n";
			return false;

		// 鍵未指定
		} elseif ( $this->getSSHKey() == "" ) {
			echo "QKDBackUpperDriverDir::strKey : Undefined.\n";
			return false;

		// 鍵不在
		} elseif ( !file_exists( $this->getSSHKey( true ) ) ) {
			echo "{$this->getSSHKey( true )} : Not found.\n";
			return false;

		}

		return true;
	}
}
?>