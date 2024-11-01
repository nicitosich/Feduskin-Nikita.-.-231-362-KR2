<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit();
}

$cart_id = $_POST['cart_id'];
$quantity = (int)$_POST['quantity'];

$stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE cart_id = ?");
$stmt->bind_param("ii", $quantity, $cart_id);
$stmt->execute();

header("Location: cart.php");
exit();
?>