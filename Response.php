<?php

class Opis_Response {

	protected $response ;
	protected $outputType = 'json';

	public function __construct ( ) {

		$this->response = array (
			'STATUS' => 'OK' ,
			'MESSAGE' => ''
		) ;

	}

	public function setError ( $message ) {
		$this->response['STATUS'] = 'ERROR';
		if ( gettype ( $message ) === 'string' ) {
			$this->response['MESSAGE'] = $message ;
		} else {
			$this->response['MESSAGE'] = $message->getMessage ( ) ;
		}
	}

	public function setData ( $data ) {
		$this->response['DATA'] = $data ;
	}

	public function __toString ( ) {
		switch ($this->outputType) {
			case 'json':
				return json_encode( $this->response );
			break;
			default:
		}
	}

}