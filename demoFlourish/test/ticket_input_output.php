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
$file = new fFile('ticket_input_output.csv');
$i = 0;

foreach ($file as $line) {
	$i++;
	$fields = str_getcsv($line);
    // $fields = $fields[0];
    $quantity = str_replace(',', '', trim($fields[0]));
    $name = trim($fields[2]);
    
    echo 'Index ' . $i . ' ------ <br />';
    echo 'Quantity ' . $quantity . ' ------ <br />';
    echo 'Name ' . $name . ' ------ <br />';
    
    try {
        try {	
            $input = Input::getObject(array('status=' => 1, 'name=' => $name));
            if ($input) {
                $idInput = $input->getIdInput();
            }
        } catch(Exception $e) { $idInput = 0; }
        try {	
            $ticketInputOutputDescription = new TicketInputOutputDescription();
            $ticketInputOutputDescription->setIdTicketInputOutput(173);
            $ticketInputOutputDescription->setIdInput($idInput);
            $ticketInputOutputDescription->setQuantity($quantity);
            $ticketInputOutputDescription->setDescription($name);
            $ticketInputOutputDescription->store();
        } catch(Exception $e) {}
        try {
            try {
                $ticketInputDescription = TicketInputDescription::getObject(array('id_ticket_input=' => 140, 'id_input=' => $idInput));
                if ($ticketInputDescription) {
                    $currentQuantity = $ticketInputDescription->getQuantity();
                } else {
                    $ticketInputDescription = new TicketInputDescription();	
                    $currentQuantity = 0;
                }
            } catch(Exception $e) {
                $ticketInputDescription = new TicketInputDescription();
                $currentQuantity = 0;
            }
            $ticketInputDescription->setIdTicketInput(140);
            $ticketInputDescription->setIdInput($idInput);
            $ticketInputDescription->setQuantity($currentQuantity + $quantity);
            $ticketInputDescription->setDescription($name);
            $ticketInputDescription->store();				
        } catch(Exception $e) {}
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}

?>