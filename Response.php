<?php

class Opis_Response {

	protected $response ;
	protected $outputType = 'json';
	protected $outputCmd = "";

	public function __construct ( ) {

		$this->response = array (
			'STATUS' => 'OK' ,
			'MESSAGE' => '' 
			//'CMD' => ''
		) ;

	}

	public function setError ( $message ) {

    	if ( is_object($message) && get_class($message) === "Exception" ) {
			$message = $message->getMessage();
    	}

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

		try {

	        if ( isset($_SERVER['HTTP_ACCEPT_ENCODING']) && substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') && ob_get_length() == 0 ) {
	            ini_set('zlib.output_compression', 'on');
	            header('Content-Encoding:gzip');
	        }

	        header("Content-Type:application/json; charset=utf-8");
	        // header("Content-Type:application/json");

			switch ($this->outputType) {
				case 'json':
					return Opis_Json::encode( $this->response );
				break;
				default:
			}
			
		} catch (Exception $e) {
			die($e->getMessage());
		}
		
	}

}

