<?php

if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0 || !isset($_SESSION['account'])) {
    header('location: cart.php');
}