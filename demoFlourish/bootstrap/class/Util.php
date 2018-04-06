<?php
class Util
{

    public static function formatMoney($number) 
	{ 
		$number = strstr($number, '.') ? $number : $number . '.00'; 
		$number = explode('.', $number);
		$decimals = $number[1];
		$number = $number[0];
					
		while (true) { 
			$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number); 
			if ($replaced != $number) { 
				$number = $replaced; 
			} else { 
				break; 
			} 
		} 
		return $number . '.' . $decimals; 
	}
	
	public static function myTruncate($string, $limit, $break='.', $pad='...')
	{
		// return with no change if string is shorter than $limit
		if (strlen($string) <= $limit) return $string;

		// is $break present between $limit and the end of the string?
		if (false !== ($breakpoint = strpos($string, $break, $limit))) {
			if ($breakpoint < strlen($string) - 1) {
				$string = substr($string, 0, $breakpoint) . $pad;
			}
		}
	  
		return $string;
	}
    
     public static function getMonthFormat($month, $format)
	{
		$months = array(
            '01' => array('shortName' => 'Ene', 'name' => 'Enero'),
            '02' => array('shortName' => 'Feb', 'name' => 'Febrero'),
            '03' => array('shortName' => 'Mar', 'name' => 'Marzo'),
            '04' => array('shortName' => 'Abr', 'name' => 'Abril'),
            '05' => array('shortName' => 'May', 'name' => 'Mayo'),
            '06' => array('shortName' => 'Jun', 'name' => 'Junio'),
            '07' => array('shortName' => 'Jul', 'name' => 'Julio'),
            '08' => array('shortName' => 'Ago', 'name' => 'Agosto'),
            '09' => array('shortName' => 'Sep', 'name' => 'Septiembre'),
            '10' => array('shortName' => 'Oct', 'name' => 'Octubre'),
            '11' => array('shortName' => 'Nov', 'name' => 'Noviembre'),
            '12' => array('shortName' => 'Dic', 'name' => 'Diciembre')
        );
	  
		return $months[$month][$format];
	}
    
    public static function strGetCsv($input, $delimiter = ',', $enclosure = '"', $escape = '\\', $eol = '\n') { 
        if (is_string($input) && !empty($input)) { 
            $output = array(); 
            $tmp    = preg_split("/".$eol."/",$input); 
            if (is_array($tmp) && !empty($tmp)) { 
                while (list($line_num, $line) = each($tmp)) { 
                    if (preg_match("/".$escape.$enclosure."/",$line)) { 
                        while ($strlen = strlen($line)) { 
                            $pos_delimiter       = strpos($line,$delimiter); 
                            $pos_enclosure_start = strpos($line,$enclosure); 
                            if ( 
                                is_int($pos_delimiter) && is_int($pos_enclosure_start) 
                                && ($pos_enclosure_start < $pos_delimiter) 
                                ) { 
                                $enclosed_str = substr($line,1); 
                                $pos_enclosure_end = strpos($enclosed_str,$enclosure); 
                                $enclosed_str = substr($enclosed_str,0,$pos_enclosure_end); 
                                $output[$line_num][] = $enclosed_str; 
                                $offset = $pos_enclosure_end+3; 
                            } else { 
                                if (empty($pos_delimiter) && empty($pos_enclosure_start)) { 
                                    $output[$line_num][] = substr($line,0); 
                                    $offset = strlen($line); 
                                } else { 
                                    $output[$line_num][] = substr($line,0,$pos_delimiter); 
                                    $offset = ( 
                                                !empty($pos_enclosure_start) 
                                                && ($pos_enclosure_start < $pos_delimiter) 
                                                ) 
                                                ?$pos_enclosure_start 
                                                :$pos_delimiter+1; 
                                } 
                            } 
                            $line = substr($line,$offset); 
                        } 
                    } else { 
                        $line = preg_split("/".$delimiter."/",$line); 

                        /* 
                         * Validating against pesky extra line breaks creating false rows. 
                         */ 
                        if (is_array($line) && !empty($line[0])) { 
                            $output[$line_num] = $line; 
                        }  
                    } 
                } 
                return $output; 
            } else { 
                return false; 
            } 
        } else { 
            return false; 
        } 
    }
	
	public static function stringInsert($str, $insertstr, $pos=0)
	{
		$str = mb_substr($str, 0, $pos, 'utf-8') . $insertstr . mb_substr($str, $pos, strlen($str), 'utf-8');
		return $str;
	}	
	
	public static function stringInsertBack($str, $insertstr, $pos=0)
	{
		$str = substr($str, 0, $pos) . $insertstr . substr($str, $pos);
		return $str;
	}
	
}
?>