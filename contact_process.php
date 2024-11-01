<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "INSERT INTO contact_messages (user_id, name, email, message) VALUES ('$user_id', '$name', '$email', '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "Сообщение успешно отправлено!";
    } else {
        echo "Ошибка: " . $conn->error;
    }
} else {
    echo "Неверный метод запроса.";
}

$conn->close();
?>