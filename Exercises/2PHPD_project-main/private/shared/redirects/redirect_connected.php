<?php
if (isset($_SESSION['account_id'])) {
    header("location: account.php");
    exit;
}