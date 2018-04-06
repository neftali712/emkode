<?php
require_once '../bootstrap/init.php';
fAuthorization::requireAuthLevel('super');

fORMJSON::extend();
$product_list = fRequest::get('lista', 'string');
$id_store = fRequest::get('id_store', 'int');
$store = new Store($id_store);

$array_products = str_getcsv($product_list, "\n");
?>
<table>
<thead>
    <th>Nombre</th>
    <th>id</th>
    <th>quantity unit</th>
</thead>
<tbody>
<?php
foreach ($array_products as $pname) {
    $product = Product::getObject(['name=' => $pname]);
    echo "<tr>";
    if ($product) {
        echo "<td>{$product->getName()}</td>";
        echo "<td>{$product->getIdProduct()}</td>";
        echo "<td>{$product->getQuantityUnitMeasure()}</td>";

    } else {
        echo "<td>{$pname}</td><td>----</td><td>----</td>\n";
    }
    echo "</tr>\n";
}
?>
</tbody>
</table>
