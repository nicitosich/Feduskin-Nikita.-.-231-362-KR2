<?php
$page_title = 'Каталог - NeDNS';
include 'header.php';
include 'db.php';
?>

<main>
    <h2>Каталог товаров</h2>
    <div class="product-list">
        <?php
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='product-item'>";
                echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "'>";
                echo "<h3>" . $row['name'] . "</h3>";
                echo "<p>Цена: " . $row['price'] . " руб.</p>";
                echo "<p><a href='product.php?id=" . $row['product_id'] . "'>Подробнее</a></p>";
                echo "</div>";
            }
        } else {
            echo "Нет доступных товаров.";
        }
        ?>
    </div>
</main>

<?php include 'footer.php'; ?>