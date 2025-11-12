<?php
require_once __DIR__ . "/db.php";
global $conn;


$error = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim(htmlspecialchars($_POST['password']));

    if (empty($username) || empty($password)) {
        $error = "Заполни все поля";
    } elseif (strlen($password) < 6) {
        $error = "Пароль не менее 6 символов.";
    } elseif (!preg_match('/^[a-zA-Zа-яА-ЯёЁ]+$/u', $username)) {
        $error = "Имя пользователя может содержать только буквы";
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Пользователь с таким именем уже существует!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt_insert = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt_insert->bind_param("ss", $username, $hashed_password);

            if ($stmt_insert->execute()) {
                $message = "Регистрация прошла успешно! Теперь вы можете <a href='login.php'>войти</a>";
            } else {
                $error = "Ошибка, попробуйте позже";
            }
            $stmt_insert->close();
        }
        $stmt->close();
    }
}
?>

<?php require_once __DIR__ . "/head.php";
?>

<section class="register">
    <div class="register__wrapper">
        <h1>Регистрация</h1>
        <form action="register.php" method="POST">
            <fieldset class="register__fieldset">
                <legend for="username">Имя пользователя:</legend>
                <input class="register__input input" type="text" name="username" id="username"
                    placeholder="Только буквы" required minlength="4" maxlength="20" pattern="[A-Za-zА-Яа-яЁё]+"
                    title="Только буквы, минимум 4 символа" />
            </fieldset>

            <fieldset class="register__fieldset">
                <legend for="password">Пароль:</legend>
                <input class="register__input input" type="password" name="password" id="password"
                    placeholder="от 6 символов" required minlength="6" maxlength="20" title="Минимум 6 символов">
            </fieldset>

            <button class="register__button button" type="submit">Зарегистрироваться</button>
        </form>

        <?php if ($message): ?>
            <p><?= $message ?></p>
        <?php endif; ?>
        <?php if ($error): ?>
            <p><?= $error ?></p>
        <?php endif; ?>

        <div class="register__inner">
            <p class="register__message">Уже есть аккаунт?</p>
            <a class="register__link" href="login.php">Войти</a>
        </div>
    </div>
</section>