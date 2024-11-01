<?php
session_start();
include 'header.php';
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $identifier = mysqli_real_escape_string($conn, $_POST['identifier']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $identifier, $identifier);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['hashed_password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit();
        } else {
            echo "Неверный пароль";
        }
    } else {
        echo "Пользователь не найден";
    }
}
?>

<main>
    <h2>Вход в аккаунт</h2>
    <form action="auth.php" method="post">
        <label>Логин или Email: <input type="text" name="identifier" required></label>
        <label>Пароль: <input type="password" name="password" required></label>
        <button type="submit">Войти</button>
    </form>
</main>

<?php include 'footer.php'; ?>