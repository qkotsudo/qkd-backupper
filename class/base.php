<?php
class QKDBackUpperBase {
	private	$flgDebug= false;
	public function setDebug( $objVal ) {
		$this->flgDebug			= $objVal;
	}

	public function isDebug() {
		return $this->flgDebug;
	}


	public function drive() {
		return true;
	}

	public function cmd( $objVal ) {
		if ( $this->isDebug() ) {
			echo "{$objVal}\n";
			return true;
		} else {
			exec( $objVal, $arrResult, $flgResult );
			return ( $flgResult === 0 );
		}
	}
}
?>