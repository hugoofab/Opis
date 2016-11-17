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
class Opis_Human {

	public static function humanToBytes ( $human ) {
		$human = strtoupper( $human );
		$human = str_replace( "K" , "000" , $human );
		$human = str_replace( "M" , "000000" , $human );
		$human = str_replace( "G" , "000000000" , $human );

		return preg_replace( '/[^\d]+/', "" , $human );
	}

    // public static function bytesToHuman ( $bytes , $decimals = 2 , $decimalsSeparator = ',' , $thousandsSeparator = '.' ) {

    // 	$sufyx = "B" ;
    // 	if ( $bytes < 1000 ) {
    // 		$output = $bytes ;
    // 	} else if ( $bytes < 1000000 ) {
    // 		$output = ( $bytes / 1000 ) ;
    // 		$sufyx = "KB" ;
    // 	} else if ( $bytes < 1000000000 ) {
    // 		$output = ( $bytes / 1000000 ) ;
    // 		$sufyx = "MB" ;
    // 	} else if ( $bytes < 1000000000000 ) {
    // 		$output = ( $bytes / 1000000000 ) ;
    // 		$sufyx = "GB" ;
    // 	} else if ( $bytes < 1000000000000000 ) {
    // 		$output = ( $bytes / 1000000000000 ) ;
    // 		$sufyx = "TB" ;
    // 	} else {
    // 		$output = ( $bytes / 1000000000000 ) ;
    // 		$sufyx = "TB" ;
    // 	}

    // 	$output = number_format( $output , $decimals , $decimalsSeparator , $thousandsSeparator ) ;
    // 	$output = preg_replace ( '/\D00$/', '' , $output );

    // 	return $output . $sufyx ;

    // }

	public static function bytesToHuman ( $size ) {

		$Kb = 1 * 1024;
		$Mb = $Kb * 1024;
		$Gb = $Mb * 1024;
		$Tb = $Gb * 1024;
		$Pb = $Tb * 1024;
		$Eb = $Pb * 1024;

		$ouput = 0 ;

		if ($size < $Kb)                  return number_format ( $size , 2 , ',' , '.' ) . " byte";
		if ($size >= $Kb && $size < $Mb)  return number_format ( ( $size / $Kb ) , 2 , ',' , '.' ) . " KB";
		if ($size >= $Mb && $size < $Gb)  return number_format ( ( $size / $Mb ) , 2 , ',' , '.' ) . " MB";
		if ($size >= $Gb && $size < $Tb)  return number_format ( ( $size / $Gb ) , 2 , ',' , '.' ) . " GB";
		if ($size >= $Tb && $size < $Pb)  return number_format ( ( $size / $Tb ) , 2 , ',' , '.' ) . " TB";
		if ($size >= $Pb && $size < $Eb)  return number_format ( ( $size / $Pb ) , 2 , ',' , '.' ) . " PB";
		if ($size >= $Eb)              	  return number_format ( ( $size / $Eb ) , 2 , ',' , '.' ) . " EB";

		return "???";

	}

    public static function seccondsToHuman ( $secconds , $maximo = "mes" , $minimo = "segundo" ) {

        $defaultUnits = array(
			"mes"     => 30*7*24*3600,
			"semana"  => 7*24*3600,
			"dia"     =>   24*3600,
			"hora"    =>      3600,
			"minuto"  =>        60,
			"segundo" =>         1
        );

        $units = array ();

        foreach ( $defaultUnits as $key => $value ) {
        	if ( !empty ( $units ) || $key === $maximo ) {
        		$units[$key] = $value ;
        		if ( $key === $minimo ) break ;
        	}
        }

	// specifically handle zero
        if ( $secconds == 0 ) return "0 segundos";

        $s = "";

        foreach ( $units as $name => $divisor ) {
            if ( $quot = intval($secconds / $divisor) ) {
                $s .= "$quot $name";
                $s .= (abs($quot) > 1 ? "s" : "") . ", ";
                $secconds -= $quot * $divisor;
            }
        }

        $output = substr($s, 0, -2);
        $output = preg_replace( '/(,\s)([^,]+)$/', " e $2" , $output );
        $output = preg_replace( '/mess/' , 'meses' , $output );
        return $output ;

    }

}
