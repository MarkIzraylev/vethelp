<header class="header">
    <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    ?>
    <div class="logo-block"><img src="/vethelp/img/icons/paw_print.png" alt="Логотип" class="logo-block__icon">
    <?php if (!isset($breadcrumbsHTML) || $breadcrumbsHTML == "") { ?>
        ВетХелп
    <?php
    } else {
        echo $breadcrumbsHTML;
    } ?>
    </div>
    <nav class="middle-block">
        <a href="./#services" class="header-link">Услуги</a>
        <a href="./#specialists" class="header-link">Специалисты</a>
        <a href="./#appointment_form" class="header-link">Запись на приём и контакты</a>
        <a href="./#about_us" class="header-link">О нас</a>
        <?php
        if (isset($_SESSION['logged_user_id']) && $_SESSION['logged_user_id']!='') {
        ?>
        <!--<a href="./visits.php" class="header-link">История обращений</a>-->
        <?php
        }
        ?>
    </nav>
    <div class="account-block">
        <?php
        if (!isset($_SESSION['logged_user_id']) || $_SESSION['logged_user_id']=='') {
        ?>
        <a href="./login.php" class="header-link">Войти</a>
        <?php
        } else {
        ?>
        <a href="./login.php" class="header-link">Личный кабинет</a>
        <?php
        } ?>
    </div>
    <div class="hamburger-block">
        <button id="hamburger">☰</button>
    </div>
</header>

<script src="./js/general/hamburger.js"></script>
