<?php
set_time_limit(600);
if (!function_exists('str_getcsv')) { 
    function str_getcsv($input, $delimiter = ',', $enclosure = '"', $escape = '\\', $eol = '\n') { 
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
} 

include_once '../bootstrap/init.php';
$file = new fFile('clientes.csv');
$i = 0;

foreach ($file as $k => $line) {
	$i++;
	$fields = str_getcsv($line);
    // $fields = $fields[0];
    
    $name = trim($fields[0]);
    $rfc = trim($fields[1]);
    $postalCode = trim($fields[2]);
    $country = trim($fields[3]);
    $state = trim($fields[4]);
    $municipality = trim($fields[5]);
    $suburb = trim($fields[6]);
    $street = trim($fields[7]);
    $numExt = trim($fields[8]);
    $numInt = trim($fields[9]);
    $email = trim($fields[10]);
    $phone = trim($fields[11]);
    $creditLimit = trim($fields[12]);
    $companyName = trim($fields[13]);
    $companyPhone = trim($fields[14]);
    $companyLatitude = trim($fields[15]);
    $companyLongitude = trim($fields[16]);
    $companyContact = trim($fields[17]);
	
	if ($k > 2) {
		echo 'Iteracion: ' . $k . '<br />';
		echo 'Nombre: ' . $name . '<br />';
		echo 'RFC: ' . $rfc . '<br />';
		echo 'CP: ' . $postalCode . '<br />';
		echo 'Pais: ' . $country . '<br />';
		echo 'Estado: ' . $state . '<br />';
		echo 'Municipio: ' . $municipality . '<br />';
		echo 'Colonia: ' . $suburb . '<br />';
		echo 'Calle: ' . $street . '<br />';
		echo 'Num. Ext: ' . $numExt . '<br />';
		echo 'Num. Int: ' . $numInt . '<br />';
		echo 'Email: ' . $email . '<br />';
		echo 'Telefono: ' . $phone . '<br />';
		echo 'Limite credito: ' . $creditLimit . '<br />';
		echo 'Compañia nombre: ' . $companyName . '<br />';
		echo 'Compañia telefono: ' . $companyPhone . '<br />';
		echo 'Compañia latitud: ' . $companyLatitude . '<br />';
		echo 'Compañia longitud: ' . $companyLongitude . '<br />';
		echo 'Compañia contacto: ' . $companyContact . '<br />';
		echo '<br />---------------<br /><br />';
		
		try {
			$client = new Client();
			$client->setName($name);
			$client->setRfc($rfc);
			$client->setCountry($country);
			$client->setState($state);
			$client->setMunicipality($municipality);
			// $client->setLocality($locality);
			$client->setSuburb($suburb);
			$client->setStreet($street);
			$client->setNumExt($numExt);
			$client->setNumInt($numInt);
			$client->setPostalCode($postalCode);
			$client->setEmail($email);
			$client->setPhone($phone);
			$client->setCompanyName($companyName);
			$client->setCompanyPhone($companyPhone);
			$client->setCompanyLatitude($companyLatitude);
			$client->setCompanyLongitude($companyLongitude);
			$client->setCompanyContact($companyContact);
			$client->setStatus(1);
			$client->store();
		} catch(Exception $e) {
			echo $e->getMessage();
		}
	}
}

?>