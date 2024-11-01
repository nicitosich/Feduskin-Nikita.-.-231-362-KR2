<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit();
}

$cart_id = $_POST['cart_id'];

$stmt = $conn->prepare("DELETE FROM cart WHERE cart_id = ?");
$stmt->bind_param("i", $cart_id);
$stmt->execute();

header("Location: cart.php");
exit();
?>