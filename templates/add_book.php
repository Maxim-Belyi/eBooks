<?php
global $conn;
require_once __DIR__ . "/db.php";

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim(htmlspecialchars($_POST['title']));
    $author = trim(htmlspecialchars($_POST['author']));
    $price = trim(htmlspecialchars($_POST['price']));

    if (empty($title) || empty($author) || empty($price)) {
        $error = 'Заполни все поля';
    } elseif (!is_numeric($price) || $price <= 0) {
        $error = 'Цена должна быть больше 0';
    } else {
        $stmt = $conn->prepare("INSERT INTO books (title, author, price) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $title, $author, $price);

        if ($stmt->execute()) {
            $message = "Книга успешно добавлена!";
            setcookie("last_added_book", $title, time() + 120, '/');
        } else {
            $error = 'Что-то пошло не так';
        }
        $stmt->close();
    }
}
?>

<?php
require_once __DIR__ . "/head.php";
?>

<section class="register">
    <div class="register__wrapper">
        <h1>Добавь свою книгу!</h1>

        <form action="add_book.php" method="POST">
            <fieldset class="register__fieldset">
                <legend for="title">Название книги</legend>
                <input class="register__input input" type="text" id="title" name="title" placeholder="Минимум 1 символ"
                    required minlength="1" maxlength="100" pattern="[a-zA-Zа-яА-Я0-9\s.,!?-]+" title="Минимум 1 символ">
            </fieldset>

            <fieldset class="register__fieldset">
                <legend for="title">Автор</legend>
                <input class="register__input input" type="text" id="author" name="author" required minlength="3"
                    maxlength="40" pattern="[A-Za-zА-Яа-яЁё\s]+" title="Только буквы, минимум 4 символа">
            </fieldset>

            <fieldset class="register__fieldset">
                <legend for="title">Цена</legend>
                <input class="register__input input" type="number" id="price" name="price" placeholder="Например 150.20"
                    required min="0.01" step="0.01" title="Только положительные числа больше нуля">
            </fieldset>
            <div class="register__inner">
                <button class="register__button button" type="submit">Добавить книгу</button>
                <a class="register__link" href="/index.php">Вернуться на главную</a>
            </div>
        </form>

        <?php if ($message): ?>
            <p><?= $message ?></p>
        <?php endif; ?>

        <?php if ($error): ?>
            <p><?= $error ?></p>
        <?php endif; ?>
    </div>
</section>