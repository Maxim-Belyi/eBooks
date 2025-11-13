# <a href='https://ebooks-production-bf0c.up.railway.app/index.php'>Веб-приложение "Книжный каталог ёBook"</a>

Простое веб-приложение на PHP и MySQL для учета книг, работающее в среде Docker. Адаптивно под мобильные устройства
![Титульное изображение](assets/images/title_img.avif)
### Технологии

**Бэкенд:**

![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Apache](https://img.shields.io/badge/Apache-D22128?style=for-the-badge&logo=apache&logoColor=white)

**Фронтенд:**

![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![Sass](https://img.shields.io/badge/Sass-CC6699?style=for-the-badge&logo=sass&logoColor=white)


**Инфраструктура и Деплой:**

![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)
![Railway](https://img.shields.io/badge/Railway-0B0B0B?style=for-the-badge&logo=railway&logoColor=white)

### Функционал

*   **Аутентификация:** Регистрация и вход пользователей.
*   **Сессии:** Данные пользователя хранятся в сессии (`$_SESSION`) после входа.
*   **Публичный каталог:** Главная страница с полным списком книг доступна всем пользователям.
*   **Добавление контента:** Авторизованные пользователи могут добавлять новые книги через специальную форму.
*   **Использование Cookies:** После добавления книги ее название записывается в куки, и на главной странице выводится уведомление о последнем добавлении.
*   **Динамический интерфейс:** Набор ссылок на главной странице меняется в зависимости от статуса авторизации пользователя.

### Запуск проекта

Для запуска проекта необходимы **Docker** и **Docker Compose**.

1.  **Клонируйте репозиторий:**
    ```bash
    git clone https://github.com/Maxim-Belyi/eBooks.git
    cd eBook_php
    ```

2.  **Запустите контейнеры:**
    Выполните команду в корневой папке проекта:
    ```bash
    docker-compose up -d
    ```
    Эта команда в фоновом режиме соберет и запустит два контейнера: веб-сервер `php-apache` и сервер баз данных `mysql`.

3.  **Откройте приложение в браузере:**
    Приложение будет доступно по адресу: [http://localhost:8080](http://localhost:8080)

4.  **Первоначальное наполнение базы данных:**
    При первом запуске Docker автоматически создает пустую базу данных `book_app`. Для создания таблиц и добавления тестовых данных:
    *   Подключитесь к базе данных с помощью любого SQL-клиента.
    *   **Параметры подключения:**
        *   **Хост:** `localhost`
        *   **Порт:** `33066`
        *   **Пользователь:** `user`
        *   **Пароль:** `password`
        *   **База данных:** `book_app`

### Структура базы данных

```sql
-- Таблица пользователей
CREATE TABLE `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
);

-- Таблица книг
CREATE TABLE `books` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `author` VARCHAR(100) NOT NULL,
  `price` DECIMAL(10, 2) NOT NULL,
  PRIMARY KEY (`id`)
);
```