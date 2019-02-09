<?php
class QSBackUpperDriverDir extends QSBackUpperDriverBase {
	private	$strSrc			= "";
	private	$arrIgnore		= array();

	public function setSrc( $objVal ) {
		$this->strSrc		= rtrim( $objVal, "/" );
		return $this;
	}

	public function addIgnore( $objVal ) {
		$this->arrIgnore[]	= rtrim( $objVal, "/" );
		return $this;
	}

	public function drive() {
		if ( !parent::drive() ) {
			return false;
		}

		// 元ディレクトリ未指定
		if ( $this->strSrc == "" ) {
			echo "QSBackUpperDriverDir::strSrc : Undefined.\n";
			return false;

		}
		$strCmd	= "rsync -avz -e 'ssh -p {$this->getSSHPort()} -i {$this->getSSHUser()}@{$this->getSSHHost()} -i {$this->getSSHKey(true)}' {$this->strSrc}/ {$this->getDst()}/";
		return $this->cmd( $strCmd );
	}
}
?>