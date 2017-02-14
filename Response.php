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
				// para evitar problemas de encoding, pode-se fazer um utf8_encode ma mensagem ou dados da saida
				header("Content-Type:application/json; charset=utf-8");

				if ( isset($_SERVER['HTTP_ACCEPT_ENCODING']) && substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') ) {
				    ini_set('zlib.output_compression', 'on');
				    header('Content-Encoding:gzip');
				}
				
				return json_encode( $this->response );
			break;
			default:
		}
	}

}
