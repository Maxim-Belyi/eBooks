<?php
require_once __DIR__ . "/db.php";

$error = '';
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim(htmlspecialchars($_POST['password']));

    if (empty($username) || empty($password)) {
        $error = "Заполни все поля";
    } elseif (!preg_match('/^[a-zA-Zа-яА-ЯёЁ]+$/u', $username)) {
        $error = "Имя пользователя может содержать только буквы";
    } else {
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            /** @var array<string, mixed> $user */
            if (password_verify($password, $user["password"])) {
                $_SESSION['user_id'] = $user["id"];
                $_SESSION['username'] = $user["username"];

                header("Location: /index.php");
                exit();
            } else {
                $error = "Неверное имя пользователя или пароль";
            }
        } else {
            $error = "Нет такого пользователя";
        }
        $stmt->close();
    }
}
?>

<?php require_once __DIR__ . "/head.php"; ?>

<section class="register">
    <div class="register__wrapper">

        <h1>Вход</h1>
        <form action="login.php" method="POST">
            <fieldset class="register__fieldset">
                <legend for="username">Имя пользователя</legend>
                <input class="register__input input" type="text" name="username" id="username" placeholder="Только буквы" required="required"
                    minlength="4" maxlength="20" pattern="[A-Za-zА-Яа-яЁё]+" title="Только буквы, минимум 4 символа" />
            </fieldset>

            <fieldset class="register__fieldset">
                <legend for="password">Пароль </legend>
                <input class="register__input input" type="password" name="password" id="password" placeholder="от 6 символов" required="required"
                    minlength="6" maxlength="20" title="Минимум 6 символов" />
            </fieldset>

            <?php if ($message): ?>
                <p><?= $message ?></p>
            <?php endif; ?>
            <?php if ($error): ?>
                <p><?= $error ?></p>
            <?php endif; ?>

            <div class="register__inner">
                <button class="register__button button" type="submit">Войти</button>
                <a class="register__link" href="/index.php">На главную</a>
            </div>
        </form>
    </div>
</section>
