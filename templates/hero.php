<section class="hero">
    <div class="hero__wrapper">
        <h1 class="hero__title">ёBook </h1>
        <p class="hero__description">твоё шикарное хранилище книг!</p>
    </div>
    <ul>
        <?php if (isset($_SESSION['user_id'])): ?>
            <p class="hero__welcome"> Добро пожаловать, <span
                    class="hero__user"><?= htmlspecialchars($_SESSION['username']) ?> </span></p>
            <div class="hero__link-wrapper">
                <a class="hero__link" href="templates/add_book.php">Добавить книгу</a>
                <a class="hero__link" href="/templates/logout.php">Выйти из профиля</a>
            </div>

        <?php else: ?>
            <p class="hero__welcome">Вы вошли как гость <br> чтобы добавить книгу необходимо <br> <a class="hero__link" href="/templates/register.php">зарегистрироваться</a>  <a class="hero__link"
                    href="/templates/login.php">войти</a></p>

        <?php endif; ?>
    </ul>
</section>