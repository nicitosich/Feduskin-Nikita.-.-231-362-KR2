<?php
$page_title = 'Продукт - NeDNS';
include 'header.php';
include 'db.php';

$product_id = $_GET['id'];
$sql = "SELECT * FROM products WHERE product_id = $product_id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();
?>

<main>
    <div class="product-container">
        <div class="product-main-info">
            <div class="product-image">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
            </div>
            <div class="product-details">
                <h2><?php echo $product['name']; ?></h2>
                <p class="product-price">Цена: <?php echo $product['price']; ?> руб.</p>
                <div class="add-to-cart">
                    <form action="add_to_cart.php" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                        <label for="quantity">Количество:</label>
                        <input type="number" name="quantity" min="1" max="<?php echo $product['stock']; ?>" value="1" required>
                        <button type="submit">Добавить в корзину</button>
                    </form>
                </div>
                <p class="product-stock">Количество на складе: <?php echo $product['stock']; ?></p>
            </div>
        </div>
        <div class="product-description">
            <h3>Описание</h3>
            <p><?php echo $product['description']; ?></p>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>