<?php
/**
 * toda a funcionalidade comun de um DTO
*/
abstract class Opis_Dto_Abstract {
	

	/**
	 * caso tenha passado um array de chave => valor com chaves identicas aos atributos declarados no objeto filho
	 * vamos setar usando o metodo set se ele existir
	 * 
	*/
	public function __construct ( $arrayData = null ) {
		
		if ( $arrayData === null ) return ;
		
		if ( is_array ( $arrayData ) ) {
			foreach ( $arrayData as $key => $val ) {
				$method = "set" . ucwords ( $key ) ;
				if ( method_exists ( $this , $method ) ) {
					$this->{$method}( $val ) ;
				} 
			}	
		}
			
	}
	
	
	/**
	 * retorna true se todos os atributos deste objeto estiverem vazios
	 * retorna false se ao menos um atributo contiver algum valor
	*/
	public function isEmpty ( ) {
		$atributos = get_object_vars ( $this ) ;
		foreach ( $atributos as $key => $val ) {
			if ( !empty ( $val ) ) {
				return false ;
			} 
		}
		return true ;
	}
	
	
	/**
	 * retorna true se todos os atributos deste objeto estiverem preenchidos
	 * retorna false se algum n�o tiver valor algum atribuido
	*/
	public function isFull ( ) {
		$atributos = get_object_vars ( $this ) ;
		foreach ( $atributos as $key => $val ) {
			if ( empty ( $val ) ) {
				return false ;
			} 
		}
		return true ;
	}
	
	
	/**
	 * retorna o pr�prio objeto convertido em array
	*/
	public function toArray ( ) {
		return get_object_vars ( $this );
	}
        
        
    /**
     * precisa ser sobrescrito na classe filha
     */
    public function isValid ( ) {


    }

}
