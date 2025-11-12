<section class="hero">
    <h1>ёBook - твоё шикарное хранилище книг!</h1>
    <ul>
        <?php if (isset($_SESSION['user_id'])) : ?>
            <p> Добро пожаловать, <?= htmlspecialchars($_SESSION['username']) ?> </p>
            <a href="templates/add_book.php">Добавить книгу</a>
            <a href="/templates/logout.php">Выйти из профиля</a>

        <?php else: ?>
            <p>Вы вошли как гость</p>
            <p>Чтобы добавить книгу необходимо <a href="/templates/register.php">зарегистрироваться</a> либо <a
                        href="/templates/login.php">войти</a></p>

        <?php endif; ?>
    </ul>
</section>