<?php
session_start();
include 'header.php';

if (!isset($_SESSION['user_id'])) {
    echo "<p>Вы должны быть авторизованы для доступа к этой странице.</p>";
    exit();
}
?>

<main>
    <h2>Связаться с нами</h2>
    <form id="contact-form" action="contact_process.php" method="post">
        <label for="name">Имя:</label>
        <input type="text" name="name" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="message">Сообщение:</label>
        <textarea name="message" required></textarea>

        <button type="submit">Отправить</button>
    </form>
    <div id="response-message" style="display:none;"></div>
</main>

<script src="contact.js"></script>
<?php include 'footer.php'; ?>