<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Gis_Formatter
 *
 * @author hugo
 */
class Opis_Money {

    public static function toBRL ( $value , $prefix = "R$ " ) {

    	return $prefix . number_format( $value , 2 , ',' , '.' ) ;

    }

}
