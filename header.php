<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'NeDNS'; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header>
    <nav>
    <a href="index.php" class="logo">
            <img src="logo.png" alt="Логотип магазина">
        </a>
        <ul>
            <li><a href="index.php">Главная</a></li>
            <li><a href="shop.php">Каталог</a></li>

            <?php if (isset($_SESSION['user_id']) && isset($_SESSION['username'])): ?>
                <li><a href="contact.php">Связаться с нами</a></li>
                <li style="margin-left: auto;">
                    Здравствуйте, <?php echo htmlspecialchars($_SESSION['username']); ?> |
                    <a href="cart.php">Корзина</a>
                    <a href="logout.php">Выйти</a>
                </li>
            <?php else: ?>
                <li style="margin-left: auto;"><a href="auth.php">Войти</a></li>
                <li><a href="register.php">Регистрация</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <link rel="stylesheet" href="style.css">
</header>