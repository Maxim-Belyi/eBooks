<?php
global $conn;
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

            /** @var TYPE_NAME $user */
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

<div>
    <form action="login.php" method="POST">
        <div>
            <label for="username">Имя пользователя</label>
            <input type="text" name="username" id="username" placeholder="Только буквы"
                   required="required"
                   minlength="4" maxlength="20"
                   pattern="[A-Za-zА-Яа-яЁё]+"
                   title="Только буквы, минимум 4 символа"
            />
        </div>

        <div>
            <label for="password">Пароль </label>
            <input type="password" name="password" id="password" placeholder="от 6 символов"
                   required="required"
                   minlength="6" maxlength="20"
                   title="Минимум 6 символов"
            />
        </div>

        <?php if ($message): ?>
            <p><?= $message ?></p>
        <?php endif; ?>
        <?php if ($error): ?>
            <p><?= $error ?></p>
        <?php endif; ?>

        <button type="submit">Войти</button>
    </form>
</div>
