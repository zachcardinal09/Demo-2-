<?php

// 0- On récupère nos données
$order = [
    "id" => 3245635.68,
    "client" => "abc 2001 inc.",
    "date" => "06-04-2024:20:02:34",
    "sequence" => "4", 
    "items" => [
        "item1" =>[
            
            "name" => "Item 1",
            "quantity" => 6,
            "price" => 22.50,
            "available" => "false",
        ],
        "item2" =>[
            "sku" => "5634564578-aaa",
            "name" => "Item 2",
            "quantity" => 45,
            "price" => 2.35,
            "available" => true,
        ],
        "item3" =>[
            "sku" => "142567543",
            "name" => "Item 3",
            "quantity" => 16,
            "price" => 9.99,
            "available" => 1,
        ],
    ],
];


$pageTitle = 'Gestion des \'nouvelles\' commandes $_2024';


if ( ! is_int( $order["id"]) ) {
    $order["id"] = (int) $order["id"];
}


$orderID = "Commande : {$order["id"]}-2024";


$clientName = $order["client"];

if (strpos($order["client"], "inc.")) { 
    $clientName .= " (INC)";
} 


$orderDate = DateTime::createFromFormat("d-m-Y:H:i:s", $order["date"]);


$sequence = 0;
if ( $order["sequence"] < PHP_INT_MAX ){
    $sequence = $order["sequence"];
}


// 9- Début
$items = "";
foreach($order["items"] as $item) {
    $itemSKU = $item["sku"] ?? "xxxxxxxx";
    if (! is_int($itemSKU)) {
        $itemSKU = (int) $itemSKU;
    }
    
    $itemAvailable = (bool) $item["available"];

    $items .= <<<HTML
        <div class="item">
            <p>SKU : {$itemSKU}</p>
            <p>Nom : {$item["name"]}</p>
            <p>Quantité : {$item["quantity"]}</p>
            <p>Prix : {$item["price"]}</p>
            <p>Disponible : $itemAvailable</p>
        </div>
    HTML;
}
// 9- Fin

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <style>
        body{
            font-size: 1.2em;
        }

        #order{
            border:solid 1px darkgray;
            padding : 10px;
            width:50%;
        }

        .item{
            margin-left: 20px;
            border-top: solid 1px darkgray;
            padding:5px;
        }

        .item:nth-child(odd){
            background: #ccc;
        }
    </style>
</head>
<body>
    <h1><?= $pageTitle ?></h1>

    <div id="order">
        <h2><?= $orderID ?></h2>
        <p>Nom client : <?= $clientName ?></p>
        <p>Date : <?= $orderDate->format("d/m/Y") ?></p>
        <p>Séquence : <?= $sequence ?></p>

        <div class="items">
            <?= $items ?>
        </div>

    </div>

</body>
</html>






















