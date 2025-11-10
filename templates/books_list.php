<?php
global $conn;
require_once __DIR__ . "/db.php";
$result = $conn->query("SELECT * FROM books");
?>

<section>
    <div>
        <?php if (isset($_SESSION['user_id'])) : ?>
        <p> Добро пожаловать, <?= htmlspecialchars($_SESSION['username']) ?> </p>
        <a href="templates/add_book.php">Добавить книгу</a>
        <a href="/index.php">На главную</a>
        <?php else: ?>
        <p>Вы вошли как гость</p>
        <p>Чтобы добавить книгу необходимо <a href="templates/register.php">зарегистрироваться</a> либо <a href="templates/login">войти</a></p>
        <?php endif; ?>
        <h2 class="section-title">Список книг</h2>
        <h3>Здесь отображены все доступные книги из этой шикарной библиотеки</h3>
        <?php if ($result && $result -> num_rows > 0) {
            echo '<ul>';
            while ($row = $result -> fetch_assoc()) {

                echo '<li>';
                echo '<h4 class="book-title">' . htmlspecialchars($row['title']) . '</h4>';
                echo '<p class="book-author">' . htmlspecialchars($row['author']) . '</p>';
                echo '<p class="book-price">' . htmlspecialchars($row['price']) . ' р.</p>';
                echo '</li>';

            }
            echo '</ul>';
        } else {
            echo '<span class="error-message"> В каталоге нет книг, говнокодер накосячил </span>';
        }
        ?>

    </div>
</section>
