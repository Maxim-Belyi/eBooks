<?php
global $conn;
require_once __DIR__ . "/db.php";

$lastAddedBook = null;
if (isset($_COOKIE["last_added_book"])) {
    $lastAddedBook = $_COOKIE["last_added_book"];
}

$result = $conn->query("SELECT title, author, price FROM books ORDER BY id DESC");
?>

<section class="book_list">
    <div>
        <?php if ($lastAddedBook) : ?>
        <div>
            <p> Последняя добавленная книга: <?= htmlspecialchars($lastAddedBook) ?></p>
        </div>
        <?php endif; ?>

        <h2 class="section-title">Список книг</h2>
        <h3>Здесь отображены все доступные книги из этой шикарной библиотеки</h3>

        <?php if ($result && $result->num_rows > 0) : ?>
            <ul>
                <?php while ($row = $result->fetch_assoc()) : ?>

                    <li>
                        <h4 class="book-title"> <?= htmlspecialchars($row['title']) ?></h4>
                        <p class="book-author"> Автор: <?= htmlspecialchars($row['author']) ?> </p>
                        <p class="book-price"> Цена: <?= htmlspecialchars($row['price']) ?> р.</p>

                    </li>
                <?php endwhile; ?>
            </ul>

        <?php else: ?>
            <span>В каталоге нет книг. Вы можете <a href="/add_book.php">добавить первую</a>!</span>;
        <?php endif; ?>

    </div>
</section>
