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
class Opis_Formatter {
    
    public function brlToDB ( $moneyBrl ) {
        
        $moneyBrl = str_replace( "." , '' , $moneyBrl ) ;
        $moneyBrl = str_replace( "," , '.' , $moneyBrl ) ;
        $moneyBrl = preg_replace ( '/[^0-9.]/' , '' , $moneyBrl ) ;
        return (float) $moneyBrl ;
        
    }
    
}
