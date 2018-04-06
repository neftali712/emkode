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

// fORMDatabase::retrieve()->execute("UPDATE line_business SET status = -1 WHERE id_line_business <= 58");

// $lines_business = array(
    // 'Aceite',
    // 'Aceite de canola y ricafrit',
    // 'Agua potable',
    // 'Ajonjoli',
    // 'Bolsas',
    // 'Colores artificiales',
    // 'Empaques',
    // 'Energia electrica',
    // 'Envolturas y empaques',
    // 'Etiquetas',
    // 'Gas lp',
    // 'Harina reserva',
    // 'Harina de arroz',
    // 'Harina de maiz',
    // 'Harina de trigo',
    // 'Papas',
    // 'Pasta de harina de trigo',
    // 'Sal',
    // 'Salsa',
    // 'Sazonadores',
    // 'Texpan',
    // 'Semola',
    // 'Otros insumos'
// );

// $i = 0;
// foreach ($lines_business as $line_business) {
    // $i++;
    // $lineBusiness = new LineBusiness();
    // $lineBusiness->setName("line_business_$i");
    // $lineBusiness->setDescription($line_business);
    // $lineBusiness->setStatus(1);
    // $lineBusiness->store();
// }

// fORMDatabase::retrieve()->execute("UPDATE creditor_line_business SET status = -1 WHERE id_creditor_line_business <= 58");

// $creditor_lines_business = array(
    // 'Accesorios y herramientas',
    // 'Agua',
    // 'Aguinaldo',
    // 'Arrendamiento',
    // 'Asistencia tecnica',
    // 'Capacitacion al personal',
    // 'Casetas',
    // 'Combustible y lubricantes',
    // 'Comidas',
    // 'Comisiones por ventas',
    // 'Cuotas y suscripciones',
    // 'Donativos y ayudas',
    // 'Otros activos fijos',
    // 'Equipo de transporte',
    // 'Equipo industrial',
    // 'Estacionamientos',
    // 'Fletes y acarreos',
    // 'Gastos de importacion y/o exportacion',
    // 'Gastos personales',
    // 'Gastos no deducibles',
    // 'Honorarios', 
    // 'Limpieza',
    // 'Mantenimiento de equipo de computo',
    // 'Mantenimiento de maquinaria',
    // 'Mantenimiento de transporte',
    // 'Mantenimiento y conservacion instalaciones',
    // 'Maniobra y/o descarga',
    // 'Maquinaria',
    // 'Mobiliario y equipo de oficina',
    // 'Nomina',
    // 'Otros gastos',
    // 'Otros impuestos y derechos',
    // 'Papeleria y utiles de oficina',
    // 'Patentes y marcas',
    // 'Prestaciones',
    // 'Primas de seguros',
    // 'Propaganda y publicidad',
    // 'Prueba de laboratorio',
    // 'Ptu',
    // 'Seguros y fianzas',
    // 'Sueldos y salarios',
    // 'Telefono e internet',
    // 'Uniformes',
    // 'Viaticos y gastos de viaje',
    // 'Vigilancia y seguridad',
    // 'Vacasiones',
    // 'Prima Vacacional',
    // 'Prima de Antigüedad',
    // 'Gratificaciones',
    // 'Indemnizacion',
    // 'Despensa',
    // 'Instituto mexicano del seguro social',
    // 'Secretaria de hacienda y credito publico',
    // 'Gobierno del estado de michoacan'
// );

// $i = 0;
// foreach ($creditor_lines_business as $creditor_line_business) {
    // $i++;
    // $creditorLineBusiness = new CreditorLineBusiness();
    // $creditorLineBusiness->setName("line_business_$i");
    // $creditorLineBusiness->setDescription($creditor_line_business);
    // $creditorLineBusiness->setStatus(1);
    // $creditorLineBusiness->store();
// }

// $file = new fFile('proveedores.csv');
// $i = 0;

// $deletedSuppliers = array(
    // 94,
    // 138,
    // 10,
    // 61,
    // 70,
    // 92,
    // 95
// );

// foreach ($file as $line) {
	// $i++;
	// $fields = str_getcsv($line);
    // $idSupplier = $fields[1];
    // $supplierLineBusiness = $fields[2];
    // $supplierName = $fields[4];
    // $supplierCorporateName = $fields[5];
    // $supplierRFC = $fields[6];
    // $supplierBankAccount = $fields[7];
    // $supplierClabe = $fields[8];
    // $supplierReference = $fields[9];
    // $supplierCreditDay = $fields[10];
    // $supplierPhone = $fields[11];
    // $supplierComment = $fields[12];
    // $supplierStatus = 1;
    // $supplierIdLineBusiness = 0;
	
    // echo 'Proveedor: ' . $i . '<br />';
    // echo 'Id: ' . $idSupplier . '<br />';
    // echo 'Giro: ' . $supplierLineBusiness . '<br />';
    // echo 'Nombre: ' . $supplierName . '<br />';
    // echo 'Razon Social: ' . $supplierCorporateName . '<br />';
    // echo 'RFC: ' . $supplierRFC . '<br />';
    
    // try {
        // $lineBusiness = LineBusiness::getObject(array('description=' => $supplierLineBusiness, 'status=' => 1));
        // if ($lineBusiness) $supplierIdLineBusiness = $lineBusiness->getIdLineBusiness();
    // } catch(Exception $e) {}
    
    // try {
        // $supplier = new Supplier($idSupplier);
        
        // if (in_array($idSupplier, $deletedSuppliers)) {
            // $supplier->setStatus(-1);
        // } else {
            // $supplier->setIdLineBusiness($supplierIdLineBusiness);
            // $supplier->setName($supplierName);
            // $supplier->setCorporateName($supplierCorporateName);
            // $supplier->setRfc($supplierRFC);
            // $supplier->setBankAccount($supplierBankAccount);
            // $supplier->setClabe($supplierClabe);
            // $supplier->setReference($supplierReference);
            // $supplier->setCreditDay($supplierCreditDay);
            // $supplier->setPhone($supplierPhone);
            // $supplier->setComment($supplierComment);
            // $supplier->setStatus($supplierStatus);
        // }
        // $supplier->store();
        
        // echo 'Exito...<br />';
    // } catch(Exception $e) { echo '-------------<br />';echo $e->getMessage() . '<br />-------------<br />'; }
    
    // echo '<br />';
// }

// $file = new fFile('acreedores.csv');
// $i = 0;

// $deletedCreditors = array(
    // 11,
    // 12,
    // 13,
    // 14,
    // 15,
    // 16,
    // 17,
    // 18,
    // 19,
    // 21,
    // 22,
    // 23,
    // 24,
    // 10,
    // 30,
    // 43,
    // 44,
    // 61,
    // 62,
    // 72,
    // 77,
    // 86
// );

// foreach ($file as $line) {
	// $i++;
	// $fields = str_getcsv($line);
    // $idCreditor = $fields[1];
    // $creditorLineBusiness = $fields[2];
    // $creditorName = $fields[4];
    // $creditorCorporateName = $fields[5];
    // $creditorRFC = $fields[6];
    // $creditorBankAccount = $fields[7];
    // $creditorClabe = $fields[8];
    // $creditorReference = $fields[9];
    // $creditorCreditDay = $fields[10];
    // $creditorPhone = $fields[11];
    // $creditorComment = $fields[12];
    // $creditorStatus = 1;
    // $creditorIdLineBusiness = 0;
	
    // echo 'Acreedor: ' . $i . '<br />';
    // echo 'Id: ' . $idCreditor . '<br />';
    // echo 'Giro: ' . $creditorLineBusiness . '<br />';
    // echo 'Nombre: ' . $creditorName . '<br />';
    // echo 'Razon Social: ' . $creditorCorporateName . '<br />';
    // echo 'RFC: ' . $creditorRFC . '<br />';
    
    // try {
        // $lineBusiness = CreditorLineBusiness::getObject(array('description=' => $creditorLineBusiness, 'status=' => 1));
        // if ($lineBusiness) $creditorIdLineBusiness = $lineBusiness->getIdCreditorLineBusiness();
    // } catch(Exception $e) {}
    
    // try {
        // $creditor = new Creditor($idCreditor);
        
        // if (in_array($idCreditor, $deletedCreditors)) {
            // $creditor->setStatus(-1);
        // } else {
            // $creditor->setIdCreditorLineBusiness($creditorIdLineBusiness);
            // $creditor->setName($creditorName);
            // $creditor->setCorporateName($creditorCorporateName);
            // $creditor->setRfc($creditorRFC);
            // $creditor->setBankAccount($creditorBankAccount);
            // $creditor->setClabe($creditorClabe);
            // $creditor->setReference($creditorReference);
            // $creditor->setCreditDay($creditorCreditDay);
            // $creditor->setPhone($creditorPhone);
            // $creditor->setComment($creditorComment);
            // $creditor->setStatus($creditorStatus);
        // }
        // $creditor->store();
        
        // echo 'Exito...<br />';
    // } catch(Exception $e) { echo '-------------<br />';echo $e->getMessage() . '<br />-------------<br />'; }
    
    // echo '<br />';
// }

$file = new fFile('acreedores_new.csv');
$i = 0;

$deletedCreditors = array(
    11,
    12,
    13,
    14,
    15,
    16,
    17,
    18,
    19,
    21,
    22,
    23,
    24,
    10,
    30,
    43,
    44,
    61,
    62,
    72,
    77,
    86
);

foreach ($file as $line) {
	$i++;
	$fields = str_getcsv($line);
    $idCreditor = $fields[1];
    $creditorLineBusiness = $fields[2];
    $creditorName = $fields[4];
    $creditorCorporateName = $fields[5];
    $creditorRFC = $fields[6];
    $creditorBankAccount = $fields[7];
    $creditorClabe = $fields[8];
    $creditorReference = $fields[9];
    $creditorCreditDay = $fields[10];
    $creditorPhone = $fields[11];
    $creditorComment = $fields[12];
    $creditorStatus = 1;
    $creditorIdLineBusiness = 0;
	
    echo 'Acreedor: ' . $i . '<br />';
    echo 'Id: ' . $idCreditor . '<br />';
    echo 'Giro: ' . $creditorLineBusiness . '<br />';
    echo 'Nombre: ' . $creditorName . '<br />';
    echo 'Razon Social: ' . $creditorCorporateName . '<br />';
    echo 'RFC: ' . $creditorRFC . '<br />';
    
    try {
        $lineBusiness = CreditorLineBusiness::getObject(array('description=' => $creditorLineBusiness, 'status=' => 1));
        if ($lineBusiness) $creditorIdLineBusiness = $lineBusiness->getIdCreditorLineBusiness();
    } catch(Exception $e) {}
    
    try {
        $creditor = new Creditor();
        $creditor->setIdCreditorLineBusiness($creditorIdLineBusiness);
        $creditor->setName($creditorName);
        $creditor->setCorporateName($creditorCorporateName);
        $creditor->setRfc($creditorRFC);
        $creditor->setBankAccount($creditorBankAccount);
        $creditor->setClabe($creditorClabe);
        $creditor->setReference($creditorReference);
        $creditor->setCreditDay($creditorCreditDay);
        $creditor->setPhone($creditorPhone);
        $creditor->setComment($creditorComment);
        $creditor->setStatus($creditorStatus);
        $creditor->store();
        
        echo 'Exito...<br />';
    } catch(Exception $e) { echo '-------------<br />';echo $e->getMessage() . '<br />-------------<br />'; }
    
    echo '<br />';
}

// $creditors = Creditor::getAll(array(), array('id_creditor' => 'ASC'));
// $i = 0;
// foreach ($creditors as $creditor) {
    // $i++;
    // $creditor->setIdCreditor($i);
    // $creditor->store();
// }
?>