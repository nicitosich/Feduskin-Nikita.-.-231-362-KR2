<?php
session_start();
include 'header.php';
include 'db.php';

$error = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($user['username'] === $username) {
            $error = "Логин уже занят. Пожалуйста, выберите другой логин.";
        } elseif ($user['email'] === $email) {
            $error = "Электронная почта уже используется. Пожалуйста, выберите другую почту.";
        }
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        if ($stmt->execute()) {
            header("Location: auth.php"); 
            exit();
        } else {
            $error = "Ошибка при регистрации. Пожалуйста, попробуйте снова.";
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<main>
    <h2>Регистрация</h2>
    <form action="register.php" method="post">
        <?php if ($error): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <label>Логин: <input type="text" name="username" required></label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <label>Пароль: <input type="password" name="password" required></label><br>
        <button type="submit">Зарегистрироваться</button>
    </form>
</main>

<?php include 'footer.php'; ?>