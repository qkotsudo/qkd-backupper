<?php
class QKDBackUpperDriverDir extends QKDBackUpperDriverBase {
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
		// 汎用判定
		if ( !parent::drive() ) {
			return false;
		}

		// 元ディレクトリ未指定
		if ( $this->strSrc == "" ) {
			echo "QKDBackUpperDriverDir::strSrc : Undefined.\n";
			return false;

		}

		$strCmd	= "rsync -avz -e 'ssh -p {$this->getSSHPort()} -i {$this->getSSHKey(true)}' {$this->getSSHUser()}@{$this->getSSHHost()}:{$this->strSrc}/ {$this->getDst()}/";
		return $this->cmd( $strCmd );
	}
}
?>