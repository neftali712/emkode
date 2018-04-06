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

$file = new fFile('incremento_precios.csv');
$i = 0;

foreach ($file as $line) {
	$i++;
	$fields = str_getcsv($line);
    $barcode = $fields[0];
    $name = $fields[1];
    $cost = $fields[2];
    $price1 = $fields[3];
    $price2 = $fields[4];
    $price3 = $fields[5];
    $price4 = $fields[6];
    
    echo '#: ' . $i . '<br />';
    echo 'Codigo: ' . $barcode . '<br />';
    echo 'Nombre: ' . $name . '<br />';
    echo 'Costo: ' . $cost . '<br />';
    echo 'Precio local: ' . $price1 . '<br />';
    echo 'Precio foraneo: ' . $price2 . '<br />';
    echo 'Precio 3: ' . $price3 . '<br />';
    echo 'Precio 4: ' . $price4 . '<br />';
    
    try {
        $product = new Product(array('barcode' => $barcode));
        $product->setCost($cost);
        echo "<b>TRY</b><br>";
        $idProduct = $product->getIdProduct();
        
        $productPrices = ProductPrice::getAll(array('id_product=' => $idProduct, 'id_price=' => array(5,6,7,8)), array('id_price' => 'ASC'));
        //echo "foreach->". print_r($productPrices, true) ."<br>";
        foreach ($productPrices as $productPrice) {
            $idPrice = $productPrice->getIdPrice();

            echo "SWITCH: $idPrice <br><br>";
            switch ($idPrice) {
                case 5:
                    $profit = new fNumber($price1, 2);
                    $profit = $profit->sub($product->getCost());
                    $profit = $profit->mul(100);
                    $profit = $profit->div($product->getCost());
                    
                    $productPrice->setPrice($price1);
                    $productPrice->setProfit($profit);
                    echo "SAVING...  <br>";
                    $productPrice->store();
                    echo $idPrice . ',';
                break;
                case 6:
                    $profit = new fNumber($price2, 2);
                    $profit = $profit->sub($product->getCost());
                    $profit = $profit->mul(100);
                    $profit = $profit->div($product->getCost());
                    
                    $productPrice->setPrice($price2);
                    $productPrice->setProfit($profit);
                    $productPrice->store();
                    echo $idPrice . ',';
                break;
                case 7:
                    $profit = new fNumber($price3, 2);
                    $profit = $profit->sub($product->getCost());
                    $profit = $profit->mul(100);
                    $profit = $profit->div($product->getCost());
                    
                    $productPrice->setPrice($price3);
                    $productPrice->setProfit($profit);
                    $productPrice->store();
                    echo $idPrice . ',';
                break;
                case 8:
                    $profit = new fNumber($price4, 2);
                    $profit = $profit->sub($product->getCost());
                    $profit = $profit->mul(100);
                    $profit = $profit->div($product->getCost());
                    
                    $productPrice->setPrice($price4);
                    $productPrice->setProfit($profit);
                    $productPrice->store();
                    echo $idPrice . ',';
                break;
            }
        }
        
        echo '<br />Exito...<br />';
    } catch(Exception $e) { echo '<br />FAIL<br>'; echo $e->getMessage() . '<br /><hr><br />'; break; }
    
    echo '<br />';
}
?>