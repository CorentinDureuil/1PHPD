<?php

include('../../initialize.php');

try {

    $make_call = callAPI('GET', 'http://localhost:3000/products/search', false);
    $response = json_decode($make_call, true);
    $data = $response;

    $q = $_REQUEST["q"];

    $hint = array();

    if ($q !== "") {
        $q = strtolower($q);
        $len = strlen($q);
        foreach($data as $line) {
            if (stristr($q, substr($line['name'], 0, $len))) {
                array_push($hint, $line['id']);
            }
        }
    }

    if (empty($hint)) {
        echo "<div id='error_products'><h1>Pas de produits trouvés</h1></div>";
    }

    foreach ($hint as $product) {
        $make_call = callAPI('GET', 'http://localhost:3000/products/getProduct?id=' . $product, false);
        $response = json_decode($make_call, true);
        $data = $response;

        echo '<div class="articleContainer">' .
            '<a href="../public/product_details.php?id='. $data[0]['id'] . '&amp;name=' . $data[0]['name'] . '">' .
            '<h1 id="articleContainer_title">' . $data[0]['name'] . '</h1>' .
            '<h3 id="articleContainer_price">' . $data[0]['price'] . ' &euro;</h3>' .
            '<img id="articleContainer_image" src="' . $data[0]['image'] . '">' .
            '<br/>' .
            '</a>' .
            '</div>';
    }

} catch (PDOException $e) {
    print "Erreur TOTO: " . $e->getMessage() . "<br/>";
    die();
}