<?php
$page_title = 'Корзина - NeDNS';
session_start();
include 'header.php';
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("
    SELECT cart.cart_id, products.name, products.price, cart.quantity, (products.price * cart.quantity) AS total
    FROM cart
    JOIN products ON cart.product_id = products.product_id
    WHERE cart.user_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<main>
    <h2>Ваша корзина</h2>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Товар</th>
                    <th>Цена за единицу</th>
                    <th>Количество</th>
                    <th>Общая стоимость</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['price']; ?> руб.</td>
                        <td>
                            <form action="update_cart.php" method="post">
                                <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                                <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" min="1">
                                <button type="submit">Обновить</button>
                            </form>
                        </td>
                        <td><?php echo $row['total']; ?> руб.</td>
                        <td>
                            <form action="remove_from_cart.php" method="post">
                                <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                                <button type="submit">Удалить</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Ваша корзина пуста.</p>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>