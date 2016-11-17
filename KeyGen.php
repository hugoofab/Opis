<?php

class Opis_KeyGen {

	/**
	 * Gera um hash de 64 caracteres combinando numeros, letras minúsculas e maiúsculas
	 * @param  mixed $data pode ser string, numero, array, objeto, qualquer coisa que seja usado como base do hash
	 * @return string       hash de 64 bytes
	 */
    public static function hash ( $data ) {

		$data      = serialize ( $data );
		$subKey    = sha1 ( $data . APPLICATION_SALT . $data ) ;
		$base64Key = base64_encode ( $subKey . sha1 ( APPLICATION_SALT . $data . APPLICATION_SALT ) ) ;
		$number    = substr ( preg_replace ( '/[^\d]+/' , "" , $subKey ) , 1 , 2 ) ;
		return substr ( $base64Key , ($number % 35) , 64 );

    }

}