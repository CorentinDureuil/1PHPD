<?php

use Dompdf\Dompdf;

if (!isset($_SESSION)) {
    ini_set('session.gc_maxlifetime', 86400);
    session_set_cookie_params(86400);
    session_start();
}

include('initialize.php');

function createUser ($first_name, $last_name, $mail, $password, $verify_password, $billing_address, $billing_city,
                     $delivery_address, $delivery_city) {

    $_SESSION['error'] = '';
    $_SESSION['created'] = '';

    switch ($password == $verify_password) {
        case (true) :
            $data_array = array(
                "mail" => $mail
            );

            $make_call = callAPI('POST', 'http://localhost:3000/users/verifyMail', json_encode($data_array));
            $response = json_decode($make_call, true);
            $data = $response;

            if ($data[0]['count_mail'] != 0) {
                $_SESSION['error'] = 'used_mail';
                header("location: ../public/inscription.php");
            } else {
                $data_array =  array(
                    "first_name" => $first_name,
                    "last_name" => $last_name,
                    "mail" => $mail,
                    "password" => hash("sha256", $password),
                    "billing_address" => $billing_address,
                    "billing_city" => $billing_city,
                    "delivery_address" => $delivery_address,
                    "delivery_city" => $delivery_city
                );

                callAPI('POST', 'http://localhost:3000/users/createUser', json_encode($data_array));

                $_SESSION['created'] = 'yes';
                header("location: ../public/account.php");
            }
            break;

        case (false) :
            $_SESSION['error'] = 'incorrect_password';
            header("location: ../public/inscription.php");
    }
}


function connectUser($mail, $password) {
    $_SESSION['error'] = '';

    $data_array = array(
        "mail" => $mail,
        "password" => hash("sha256", $password)
    );
    $make_call = callAPI('POST', 'http://localhost:3000/users/connectUser', json_encode($data_array));
    $response = json_decode($make_call, true);
    $data = $response;

    if(empty($data)) {
        $_SESSION['error'] = 'login_error';
        header("location: ../public/connection.php");
    } else {
        $_SESSION['account_id'] = $data[0]['id'];
        $_SESSION['account'] = $data[0]['first_name'] . ' ' . $data[0]['last_name'];
        $_SESSION['admin'] = $data[0]['admin'];

        header("location: ../public/account.php");
    }
}


function getCategories() {
    $make_call = callAPI('GET', 'http://localhost:3000/categories/get', false);
    $response = json_decode($make_call, true);
    $data = $response;

    foreach ($data as $line) {
        echo '<div class="categoryContainer">' .
            '<a href="../public/products.php?category=' . $line['name'] . '">' .
            '<h1 id="categoryContainer_title">' . $line['name'] . '</h1>' .
            '<img id="categoryContainer_image" alt="Image de la marque ' . $line['name'] . '" src="' . $line['image'] . '">' .
            '</a>' .
            '</div>';
    }
}

function getCategoryProducts($categoryName) {
    $categoryName = str_replace(' ', '%20', $categoryName);
    date_default_timezone_set('Europe/Paris');
    $date = date("Y-m-d");

    $make_call = callAPI('GET', 'http://localhost:3000/categories/categoryId?name=' . $categoryName, false);
    $response = json_decode($make_call, true);
    $data = $response;

    $make_call = callAPI('GET', 'http://localhost:3000/products/category?id=' . $data[0]['id'] . '&date=' . $date, false);
    $response = json_decode($make_call, true);
    $data = $response;

    if(empty($data)) {
        echo '<h2 id="page_title">Pas de produits trouvés pour cette catégorie</h2>';
    }

    foreach ($data as $product) {
        echo '<div class="articleContainer">' .
            '<a href="../public/product_details.php?id='. $product['id'] . '&amp;name=' . $product['name'] . '">' .
            '<h1 id="articleContainer_title">' . $product['name'] . '</h1>' .
            '<h3 id="articleContainer_price">' . $product['price'] . ' &euro;</h3>' .
            '<img id="articleContainer_image" alt="Image de l\'article' . $product['name'] . '" src="' . $product['image'] . '">' .
            '<br/>' .
            '</a>' .
            '<form method="get" action="../private/functions.php" >' .
            '<button name="add_to_cart" value="' . $product['id'] . '">Ajouter au panier</button>' .
            '</form>' .
            '</div>';
    }
}

function getProduct($product_id) {
    $make_call = callAPI('GET', 'http://localhost:3000/products/getProduct?id=' . $product_id, false);
    $response = json_decode($make_call, true);
    $data = $response[0];

    date_default_timezone_set('Europe/Paris');
    $phpdate = strtotime($data['release_date']);
    $release_date = date( 'd-m-Y', $phpdate );

    echo '<div id="productImage">
            <img alt="Image de l\'article" src="' . $data['image'] . '">
         </div>
        <div id="descriptionContent">
            <h1 id="productTitle">' . $data['name'] . '</h1>
            <h2>Sortie: ' . $release_date . '</h2>
            <p>' . $data['description'] . '</p>
            <h1>' . $data['price'] . '&euro;</h1>
            <form method="get" action="../private/functions.php" >
                <button name="add_to_cart" value="' . $data['id'] . '">Ajouter au panier</button>
            </form>
         </div>';
}

function getAllProducts() {
    date_default_timezone_set('Europe/Paris');
    $date = date("Y-m-d");

    $make_call = callAPI('GET', 'http://localhost:3000/products/getAllProducts?date=' . $date, false);
    $response = json_decode($make_call, true);
    $data = $response;

    foreach ($data as $product) {
        echo '<div class="articleContainer">' .
            '<a href="../public/product_details.php?id='. $product['id'] . '&amp;name=' . $product['name'] . '">' .
            '<h1 id="articleContainer_title">' . $product['name'] . '</h1>' .
            '<h3 id="articleContainer_price">' . $product['price'] . ' &euro;</h3>' .
            '<img alt="Image de l\'article ' . $product['name'] . '" id="articleContainer_image" src="' . $product['image'] . '">' .
            '<br/>' .
            '</a>' .
            '<form method="get" action="../private/functions.php" >' .
            '<button name="add_to_cart" value="' . $product['id'] . '">Ajouter au panier</button>' .
            '</form>' .
            '</div>';
    }
}

function addProductInCart($id_product) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if(isset($_SESSION['cart'][$id_product])) {
        $_SESSION['cart'][$id_product]['quantity']++;
    } else {
        $_SESSION['cart'][$id_product]['quantity'] = 1;
    }
}

function displayCart() {
    $_SESSION['total_price'] = 0;
    echo '<table>
                <tr id="border">
                    <th id="border">Image du produit</th>
                    <th id="border">Nom du produit</th>
                    <th id="border">Quantité</th>
                    <th id="border">Prix</th>
                    <th id="border">Actions</th>          
                </tr>';

    foreach ($_SESSION['cart'] as $key => $product) {
        $make_call = callAPI('GET', 'http://localhost:3000/products/getProduct?id=' . $key, false);
        $response = json_decode($make_call, true);
        $data = $response;

        $_SESSION['total_price'] += $data[0]['price'] * $product['quantity'];

        echo '<tr>
                <td id="border"><img alt="Image de l\'article" id="image_cart" src="' . $data[0]['image'] . '"/></td>
                <td id="border">'. $data[0]['name'] .'</td>
                <td id="border">' . $product['quantity'] .'</td>
                <td id="border">' . $data[0]['price'] * $product['quantity'] . ' &euro;</td>
                <td id="border">' .
                    '<form method="get" action="../private/functions.php" >' .
                        '<button name="remove_from_cart" value="' . $key . '">Retirer un produit</button>'.
                    '</form>' .
                '</td>' .
              '</tr>';
    }
    echo '<tr>
            <th colspan="3"></th>
            <th id="total_price">Somme totale: ' . $_SESSION['total_price'] . ' &euro;</th>
          </tr>';

    echo '</table><br/><br/>';

}

function deleteOneQuantity($product_id) {
    if ($_SESSION['cart'][$product_id]['quantity'] != 1) {
        $_SESSION['cart'][$product_id]['quantity']--;
    } else {
        unset($_SESSION['cart'][$product_id]);
    }
}


function getAddresses() {
    $make_call = callAPI('GET', 'http://localhost:3000/users/getAddresses?id=' . $_SESSION['account_id'], false);
    $response = json_decode($make_call, true);
    $data = $response[0];

    echo '<h2>Adresse de facturation :</h2>';
    echo '<p>' . $data['billing_address'] . ' - ' . $data['billing_city'] .  '</p>';
    echo '<h2>Adresse de facturation :</h2>';
    echo '<p>' . $data['delivery_address'] . ' - ' . $data['delivery_city'] .  '</p>';
}

function doPayment($date) {
    $data_array = array(
        "user_id" => $_SESSION['account_id'],
        "total_price" => $_SESSION['total_price'],
        "date" => $date
    );

    callAPI('POST', 'http://localhost:3000/orders/createOrder', json_encode($data_array));

    $make_call = callAPI('POST', 'http://localhost:3000/orders/getOrderId', json_encode($data_array));
    $response = json_decode($make_call, true);
    $data = $response;

    foreach ($_SESSION['cart'] as $key => $product) {
        $data_array = array(
            "order_id" => $data[0]['id'],
            "product_id" => $key,
            "quantity" => $product['quantity']
        );

        callAPI('POST', 'http://localhost:3000/orders/addProductToOrder', json_encode($data_array));
    }

    unset($_SESSION['cart']);
    sleep(3);
    header("location: ../public/success.php");
}

function getUnfinishedOrders() {
    $make_call = callAPI('GET', 'http://localhost:3000/orders/getUnfinishedOrders', false);
    $response = json_decode($make_call, true);
    $data = $response;

    echo '<table id="border">
                <tr id="border">
                    <th id="border">Commande n°</th>
                    <th id="border">Nom - Adresse de livraison</th>
                    <th id="border">Prix de la commande</th>
                    <th>Actions</th>          
                </tr>';

    foreach ($data as $order) {
        $make_call = callAPI('GET', 'http://localhost:3000/users/getInfos?id=' . $order['user_id'], false);
        $response = json_decode($make_call, true);
        $data = $response[0];

        echo '<tr id="border">
                <td id="border">'. $order['id'] .'</td>
                <td id="border">' . $data['first_name'] . ' ' . $data['last_name'] . '<br/>' . $data['delivery_address'] . ' - ' . $data['delivery_city'] . '</td>
                <td id="border">' . $order['total_price'] . ' &euro;</td>
                <td>' .
                    '<div id="action_buttons">
                        <form method="get" action="../private/functions.php" >' .
                            '<button name="modify-order" value="' . $order['id'] . '">Modifier la commande</button>'.
                        '</form>' .
                        '<form method="get" action="../private/functions.php" >' .
                            '<button name="finish_order" value="' . $order['id'] . '">Terminer la commande</button>'.
                        '</form>' .
                        '<form method="post" action="../private/functions.php" >' .
                            '<button name="get_pdf" value="' . $order['id'] . '">Obtenir le PDF</button>'.
                        '</form>' .
                    '</div></td>' .

            '</tr>';
    }

    echo '</table><br/><br/>';
}

function finishOrder($order_id) {
    callAPI('GET', 'http://localhost:3000/orders/finishOrder?id=' . $order_id, false);
    header('location: ../public/unfinished_orders.php');
}

function getUserOrders($user_id) {
    echo '<table id="border">
            <tr id="border">
                <th id="border">Commande n°</th>
                <th id="border">Date de la commande</th>
                <th id="border">Prix de la commande</th>
                <th id="border">Commande terminée</th>
                <th id="border" colspan="3">Actions</th>           
            </tr>';

    $make_call = callAPI('GET', 'http://localhost:3000/orders/getUserOrders?id=' . $user_id, false);
    $response = json_decode($make_call, true);
    $data = $response;

    foreach ($data as $order) {
        if ($order['finished'] == 0) {
            $order['finished'] = "Non";
        } else {
            $order['finished'] = "Oui";
        }
        $phpdate = strtotime($order['date']);
        date_default_timezone_set('Europe/Paris');
        $mysqldate = date('d-m-Y H:i:s', $phpdate);

        echo '<tr id="border">
                <td id="border">'. $order['id'] .'</td>
                <td id="border">' . $mysqldate . '</td>
                <td id="border">' . $order['total_price'] . ' &euro;</td>
                <td id="border">' . $order['finished'] . '</td>
                <td>' .
                    '<form method="post" action="order_details.php" >' .
                        '<button name="order_id" value="' . $order['id'] . '">Plus de détails</button>'.
                    '</form>' .
                '</td>';
        if ($order['finished'] == "Non" && $_SESSION['admin'] == 1) {
            echo '<td>
                    <form method="post" action="../private/functions.php" >
                        <button name="finish_order" value="' . $order['id'] . '">Terminer la commande</button>
                    </form>
                  </td>';
        } else {
            echo '<td></td>';
        }
        echo '<td>' .
                '<form method="post" action="../private/functions.php" >' .
                    '<button name="get_pdf" value="' . $order['id'] . '">Obtenir le PDF</button>'.
                '</form>' .
             '</td>
        </tr>';
    }

    echo '</table><br/><br/>';
}

function getOrder($order_id) {
    $_SESSION['total_price'] = 0;

    $make_call = callAPI('GET', 'http://localhost:3000/orders/getOrderDetails?id=' . $order_id, false);
    $response = json_decode($make_call, true);
    $data = $response;

    echo '<table>
                <tr id="border">
                    <th id="border">Image de l\'article</th>
                    <th id="border">Nom du produit</th>
                    <th id="border">Quantité</th>
                    <th id="border">Prix</th>   
                </tr>';

    foreach ($data as $product) {
        $make_call = callAPI('GET', 'http://localhost:3000/products/getProduct?id=' . $product['product_id'], false);
        $response = json_decode($make_call, true);
        $data_product = $response[0];

        $_SESSION['total_price'] += $data_product['price'] * $product['quantity'];

        echo '<tr id="border">
                <td id="border"><img alt="Image de l\'article" id="image_cart" src="' . $data_product['image'] . '"/></td>
                <td id="border">'. $data_product['name'] .'</td>
                <td id="border">' . $product['quantity'] .'</td>
                <td id="border">' . $data_product['price'] * $product['quantity'] . ' &euro;</td>
             </tr>';
    }
    echo '<tr>
            <td id="blank_column" colspan="3"></td>           
            <td id="total_price">Somme totale: ' . $_SESSION['total_price'] . ' &euro;</td>
          </tr>';
    echo '</table>';

}

function addPagination() {
    @$page = $_GET['page'];
    if(empty($page)) {
        $page = 1;
    }

    echo '<div id="page_title"><h1>Page n° ' . $page . ' des utilisateurs</h1></div>';

    $make_call = callAPI('GET', 'http://localhost:3000/users/getAllUsersCount', false);
    $response = json_decode($make_call, true);
    $nbr_users = $response[0]['nbr_users'];

    $users_in_page = 5;
    $nbr_pages = ceil($nbr_users / $users_in_page);
    $start_index = ($page-1)*$users_in_page;

    echo '<div id="pagination"><p>Choisir la page : </p>';

    for($i=1; $i<=$nbr_pages; $i++) {
        echo '<a id="pagination_number" href="?page=' . $i . '">' . $i . '</a>&nbsp';
    }

    echo '</div>';

    $make_call = callAPI('GET', 'http://localhost:3000/users/getUsersPage?start=' . $start_index . "&nbr=" . $users_in_page, false);
    $response = json_decode($make_call, true);
    $data = $response;

    if(empty($data)) {
        header('location: ?page=1');
    }

    echo '<table id="border">
                <tr id="border">
                    <th id="border">ID de l\'utilisateur</th>
                    <th id="border">Nom - Prénom</th>
                    <th id="border">Adresse mail</th>
                    <th>Actions</th>          
                </tr>';

    foreach ($data as $user) {
        if($user['admin'] == 1) {
            $data_id = $user['id'] . " (admin)";
        } else {
            $data_id = $user['id'];
        }

        echo '<tr id="border">
                <td id="border">'. $data_id .'</td>
                <td id="border">' . $user['last_name'] . ' ' . $user['first_name'] . '</td>
                <td id="border">' . $user['mail'] . '</td>
                <td id="border">' .
                    '<form method="get" action="orders_history.php" >' .
                        '<button name="user_id" value="' . $user['id'] . '">Voir les commandes</button>'.
                    '</form>' .
            '</td>';

        echo '</tr>';

    }

    echo '</table>';


}

function getUserInfos($order_id) {
    $make_call = callAPI('GET', 'http://localhost:3000/orders/getUserId?order="' . $order_id . '"', false);
    $response = json_decode($make_call, true);
    $user = $response[0]['user_id'];

    $make_call = callAPI('GET', 'http://localhost:3000/users/getInfos?id=' . $user , false);
    $response = json_decode($make_call, true);
    $data = $response[0];

    echo '<div id="name">' . $data['last_name'] . ' ' . $data['first_name'] . '</div>';
    echo '<div id="address">' . $data['delivery_address'] . '</div>';
    echo '<div id="city">' . $data['delivery_city'] . '</div>';
}

function getOrderDate($order_id) {
    $make_call = callAPI('GET', 'http://localhost:3000/orders/getOrderDate?order="' . $order_id . '"', false);
    $response = json_decode($make_call, true);
    $date = $response[0]['date'];

    $phpdate = strtotime($date);
    date_default_timezone_set('Europe/Paris');
    $mysqldate = date('d-m-Y H:i:s', $phpdate);

    echo $mysqldate;
}

function getNewProducts() {
    date_default_timezone_set('Europe/Paris');
    $date = date("Y-m-d");

    $make_call = callAPI('GET', 'http://localhost:3000/products/getNewProducts?date="' . $date . '"', false);
    $response = json_decode($make_call, true);
    $data = $response;

    foreach ($data as $product) {
        echo '<div class="articleContainer">' .
            '<a href="../public/product_details.php?id='. $product['id'] . '&amp;name=' . $product['name'] . '">' .
            '<h1 id="articleContainer_title">' . $product['name'] . '</h1>' .
            '<h3 id="articleContainer_price">' . $product['price'] . ' &euro;</h3>' .
            '<img alt="Image de l\'article" id="articleContainer_image" src="' . $product['image'] . '">' .
            '<br/>' .
            '</a>' .
            '<form method="get" action="../private/functions.php" >' .
            '<button name="add_to_cart" value="' . $product['id'] . '">Ajouter au panier</button>' .
            '</form>' .
            '</div>';
    }
}

function modifyOrder($order_id) {
    $_SESSION['modify_order'] = array();
    $_SESSION['total_price'] = 0;
    $_SESSION['quantity_products'] = 0;

    $make_call = callAPI('GET', 'http://localhost:3000/orders/getOrderDetails?id=' . $order_id, false);
    $response = json_decode($make_call, true);
    $data = $response;

    if(empty($data)) {
        echo '<div id="display_state_cart">
                 <h1>Une erreur est survenue.</h1>
              </div>';
    }

    echo '<div id="display_state_cart">
            <h1>Modification de la commande n° ' . $order_id . '</h1>
          </div>';

    foreach ($data as $line) {
        $_SESSION['modify_order'][$line['id']]['product_id'] = $line['product_id'];
        $_SESSION['modify_order'][$line['id']]['quantity'] = $line['quantity'];

        $_SESSION['quantity_products'] += $line['quantity'];
    }

    echo '<table>
                <tr id="border">
                    <th id="border">Image du produit</th>
                    <th id="border">Nom du produit</th>
                    <th id="border">Quantité</th>
                    <th id="border">Prix</th>
                    <th id="border">Actions</th>          
                </tr>';

    foreach ($_SESSION['modify_order'] as $key => $product) {
        $make_call = callAPI('GET', 'http://localhost:3000/products/getProduct?id=' . $product['product_id'], false);
        $response = json_decode($make_call, true);
        $data = $response;

        $_SESSION['total_price'] += $data[0]['price'] * $product['quantity'];

        echo '<tr>
                <td id="border"><img alt="Image de l\'article" id="image_cart" src="' . $data[0]['image'] . '"/></td>
                <td id="border">'. $data[0]['name'] .'</td>
                <td id="border">' . $product['quantity'] .'</td>
                <td id="border">' . $data[0]['price'] * $product['quantity'] . ' &euro;</td>';
            if($_SESSION['quantity_products'] != 1) {
                echo '<td id="border">' .
                    '<form method="get" action="../private/functions.php" >' .
                    '<button name="remove_from_command" value="' . $key . '">Supprimer</button>'.
                    '</form>' .
                    '</td>';
            } else {
                echo '<td id="border">Pas d\'actions disponibles</td>';
            }

        echo '</tr>';
    }

    echo '<tr>
            <th colspan="3"></th>
            <th id="total_price">Somme totale: ' . $_SESSION['total_price'] . ' &euro;</th>
          </tr>';

    echo '</table><br/><br/>';

    callAPI('GET', 'http://localhost:3000/orders/updatePrice?id=' . $order_id . '&price=' . $_SESSION['total_price'], false);
}

function removeFromReceipt($id) {
    $make_call = callAPI('GET', 'http://localhost:3000/orders/getProductQuantity?id=' . $id, false);
    $response = json_decode($make_call, true);
    $qty = $response[0]['quantity'];

    if ($qty != 1) {
        $qty --;
        callAPI('GET', 'http://localhost:3000/orders/removeOneQuantityProduct?id=' . $id . '&quantity=' . $qty, false);
    } else {
        callAPI('GET', 'http://localhost:3000/orders/removeProductQuantity?id=' . $id, false);
    }
}

if (isset($_POST['createUser'])) {
    createUser($_POST['first_name'], $_POST['last_name'], $_POST['mail'], $_POST['password'], $_POST['verify-password']
        , $_POST['billing_address'], $_POST['billing_city'], $_POST['delivery_address'], $_POST['delivery_city']);
}

if (isset($_POST['connectUser'])) {
    connectUser($_POST['mail'], $_POST['password']);
}

if (isset($_POST['logoutUser'])) {
    unset($_SESSION['account'], $_SESSION['admin'], $_SESSION['error'], $_SESSION['created'], $_SESSION['account_id']);
    header("location: ../public/account.php");
}

if (isset($_GET['add_to_cart'])) {
    addProductInCart($_GET['add_to_cart']);
    header('location: ../public/cart.php');
}

if (isset($_GET['remove_from_cart'])) {
    deleteOneQuantity($_GET['remove_from_cart']);
    header('location: ../public/cart.php');
}

if (isset($_POST['confirmPayment'])) {
    date_default_timezone_set('Europe/Paris');
    $date_confirmation = date("Y-m-d H:i:s");
    doPayment($date_confirmation);
}

if (isset($_GET['finish_order'])) {
    finishOrder($_GET['finish_order']);
}

if(isset($_POST['get_pdf']))  {
    require_once('modules/dompdf/autoload.inc.php');

    $file = "http://localhost/2PHPD_project/private/shared/pdf.php?order_id=" . $_POST['get_pdf'];
    $file_name = "order-" . $_POST['get_pdf'] . ".pdf";
    $html=file_get_contents($file);
    $dompdf = new DOMPDF();
    $dompdf->loadHtml($html);
    $dompdf->render();
    $dompdf->stream($file_name);
}

if (isset($_GET['modify-order'])) {
    $url = '../public/modify_order.php?order_id=' . $_GET['modify-order'];
    header('location: ' . $url);
}

if (isset($_GET['remove_from_command'])) {
    removeFromReceipt($_GET['remove_from_command']);
    header('location: ' .$_SERVER['HTTP_REFERER']);
}