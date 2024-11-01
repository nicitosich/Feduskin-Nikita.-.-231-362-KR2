<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$quantity = (int)$_POST['quantity'];

$stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $stmt = $conn->prepare("UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("iii", $quantity, $user_id, $product_id);
    $stmt->execute();
} else {
    $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $user_id, $product_id, $quantity);
    $stmt->execute();
}

header("Location: cart.php");
exit();
?>