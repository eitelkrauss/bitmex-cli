<?php

require_once '/home/eitel/code/quant/bitmex-cli/vendor/autoload.php';

use App\Http\BitMex;

$bitmex = new BitMex("lB5ewP83kqQEQPVKOaaJC3QZ", "JnJQC_z_m0veHYg1kS1K2hSPSnJR1UQ3_smVcDI-HzXPFth9");
$array_orders = array();
$no_orders = 5;
for($i = 0; $i < $no_orders; $i++)
{
    $order = array(
        "type" => "Limit",
        "side" => "Buy",
        "price" => 6000 + $i,
        "quantity" => 1,
        "stopPx" => NULL,
        "execInst" => NULL
    );
    $array_orders[] = $order;
}

$bulk_orders = $bitmex->createOrders($array_orders);
print_r($bulk_orders);
