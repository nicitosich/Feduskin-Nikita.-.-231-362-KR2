<?php
$page_title = 'Главная - NeDNS';
include 'header.php';
include 'db.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
$products = $result->fetch_all(MYSQLI_ASSOC);
shuffle($products);
$random_products = array_slice($products, 0, 5);
?>

<main>
<section class="about-site">
        <h3>О сайте</h3>
        <p>
            Добро пожаловать в NeDNS! Здесь вы найдете широкий ассортимент видеокарт по отличным ценам. 
            Наша цель - предложить качественные продукты и отличный сервис для наших клиентов. 
            Мы постоянно обновляем наш ассортимент, чтобы предоставить вам самые последние и лучшие предложения.
        </p>
    </section>
    <h2>Товары дня</h2>
    <div class="slideshow-container">
        <?php foreach ($random_products as $product): ?>
            <div class="mySlides fade">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                <div class="text">
                    <h3><?php echo $product['name']; ?></h3>
                    <p>Цена: <?php echo $product['price']; ?> руб.</p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


    <br>
    <div style="text-align:center">
        <?php foreach ($random_products as $index => $product): ?>
            <span class="dot" onclick="currentSlide(<?php echo $index + 1; ?>)"></span> 
        <?php endforeach; ?>
    </div>
</main>

<script src="slideshow.js"></script>

<?php include 'footer.php'; ?>