<?php include 'header.php'; ?>

<main>
    <h2>Регистрация</h2>
    <form action="register_process.php" method="POST">
        <label for="username">Имя пользователя:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Зарегистрироваться</button>
    </form>
</main>

<?php include 'footer.php'; ?>