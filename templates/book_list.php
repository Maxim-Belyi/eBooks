<?php
$lastAddedBook = null;
if (isset($_COOKIE["last_added_book"])) {
    $lastAddedBook = $_COOKIE["last_added_book"];
}

$result = $conn->query("SELECT title, author, price FROM books ORDER BY id DESC");
?>

<section class="book-list">
    <div class="book-list__wrapper">
        <?php if ($lastAddedBook): ?>
            <div>
                <p class="register__link"> Последняя добавленная книга: </p> <?= htmlspecialchars($lastAddedBook) ?>
            </div>
        <?php endif; ?>

        <h2 class="section-title">Список книг</h2>
        <h3>Здесь отображены все доступные книги из этой шикарной библиотеки</h3>
    </div>

    <div class="book-list__inner">
        <?php if ($result && $result->num_rows > 0): ?>
            <ul>
                <?php while ($row = $result->fetch_assoc()): ?>

                    <li class="book-list__item">
                        <h4 class="book-list__item--title"> <?= htmlspecialchars($row['title']) ?></h4>
                        <p class="book-list__item--author"> Автор: <span class=""><?= htmlspecialchars($row['author']) ?></span> </p>
                        <p class="book-list__item--price"> Цена: <?= htmlspecialchars($row['price']) ?> р.</p>
                    </li>
                <?php endwhile; ?>
            </ul>

        <?php else: ?>
            <span>В каталоге нет книг. Вы можете <a href="/add_book.php">добавить первую</a>!</span>;
        <?php endif; ?>
    </div>
</section>
