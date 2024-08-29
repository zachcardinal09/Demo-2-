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

$_2024 = 2024;
// 1- On construit le titre de la page et le h1
$pageTitle = 'Gestion des \'nouvelles\' commandes $_2024';


// 2- On s'assure que la données est un entier
// "id" => 3245635.68
if ( ! is_int( $order["id"]) ) {
    $order["id"] = (int) $order["id"];
}


// 3- On inclus le numéro de commande dans le titre de la commande
$orderID = "Commande : {$order["id"]}-2024";


// 4- Si c'est une compagnie on l'indique clairement
// "client" => "abc 2001 inc."
$clientName = $order["client"];

if (strpos($order["client"], "inc.")) { 
    $clientName .= " (INC)";
} 


// 5- On prépare un objet Date pour utilisation future
// "date" => "06-04-2024:20:02:34"
$orderDate = DateTime::createFromFormat("d-m-Y:H:i:s", $order["date"]);


// 6- On valide que la valeur ne dépasse pas la limite du système
// "sequence" => "4"
$sequence = 0;
if ( $order["sequence"] < PHP_INT_MAX ){
    $sequence = $order["sequence"];
}


// 6.1- On facilite l'utilisation des variables contenant les données des items de la commande
$items = $order["items"];

$item1 = $items["item1"];
$item2 = $items["item2"];
$item3 = $items["item3"];

// 7- Si le sku n'est pas dans les données on utilise un remplacement générique
//    Certaines données on force le type

// La clé n'existe pas
$item1SKU = $item1["sku"] ?? "xxxxxxxx";
if (!is_int($item1SKU)) {
    $item1SKU = (int) $item1SKU;
}

// "sku" => "5634564578-aaa"
$item2SKU = $item2["sku"] ?? "xxxxxxxx";
if (!is_int($item2SKU)) {
    $item2SKU = (int) $item2SKU;
}

// "available" => "false"
$item1Av = (bool) $item1["available"];

// "available" => true
$item2Av = (bool) $item2["available"];

// "available" => 1
$item3Av = (bool) $item3["available"];


// 8- On créé une chaîne heredoc pour plus facilement la lire
$lastItem = <<<HTML
    <div class="item">
        <p>SKU : {$item3["sku"]}</p>
        <p>Nom : {$item3["name"]}</p>
        <p>Quantité : {$item3["quantity"]}</p>
        <p>Prix : {$item3["price"]}</p>
        <p>Disponible : {$item3Av}</p>
    </div>
HTML;
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
            <div class="item">
                <p>SKU : <?= $item1SKU ?></p>
                <p>Nom : <?= $item1["name"] ?></p>
                <p>Quantité : <?= $item1["quantity"] ?></p>
                <p>Prix : <?= $item1["price"] ?></p>
                <p>Disponible : <?= $item1Av ?></p>
            </div>
            <div class="item">
                <p>SKU : <?= $item2SKU ?></p>
                <p>Nom : <?= $item2["name"] ?></p>
                <p>Quantité : <?= $item2["quantity"] ?></p>
                <p>Prix : <?= $item2["price"] ?></p>
                <p>Disponible : <?= $item2Av ?></p>
            </div>
            <?= $lastItem ?>
        </div>

    </div>

</body>
</html>






















