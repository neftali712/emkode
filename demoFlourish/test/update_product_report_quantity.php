<?php
require_once '../bootstrap/init.php';
fAuthorization::requireAuthLevel('super');

$id_store = fRequest::get('id_store', 'int');
fORMJSON::extend();
try {
    fORMDatabase::retrieve()->execute('BEGIN');
    $init_week = new fDate('2018-03-04');
    // $init_week = new fDate('2018-02-27');
    $store = new Store($id_store);
    $read_file = new fFile($_FILES['list']['tmp_name']);
    $response = [];
    $response['products'] = [];
    $response['invalid'] = [];
    foreach ($read_file as $line) {
        $fields = str_getcsv($line);
        if ($fields[0] !== '----') {
            $product = new Product($fields[0]);
            $inventory_date = StoreInventoryDate::getAll([
                'id_store=' => $store->getIdStore(),
                'id_product=' => $product->getIdProduct(),
                'inventory_date=' => $init_week
            ]);
            $last_week_inventory = $inventory_date[0];
            $quantityBefore = $last_week_inventory->getQuantity();
            $last_week_inventory->setQuantity($fields[4]);
            $last_week_inventory->store();
            $response['products'][] = [
                'id' => $product->getIdProduct(),
                'name' => $product->getName(),
                'size' => $inventory_date->count(),
                'before' => $quantityBefore,
                'after' => $last_week_inventory->getQuantity()
            ];
        } else {
            $response['invalid'][] = $line;
        }
    }
    // Rollback para no hacer ningun cambio en la BD
    fORMDatabase::retrieve()->execute('ROLLBACK');
    // fORMDatabase::retrieve()->execute('COMMIT');
    fJSON::output($response);
} catch(Exception $ex) {
    fORMDatabase::retrieve()->execute('ROLLBACK');
    var_dump($ex);
}
