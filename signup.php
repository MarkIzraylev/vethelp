<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация аккаунта клиента ветеринарной клиники "ВетХелп" в Ярославле</title>

    <link rel="stylesheet" href="styles/style.css">
    <link rel="shortcut icon" href="img/icons/paw_print.png" type="image/x-icon">
    
</head>
<body>
    
<script src="js/libs/jquery-3.7.1.min.js"></script>

<!--
<form method="post" action="./php/includes/signup_process.php">
    <label for="surname">Фамилия</label>
    <input type="text" name="surname" id="surname">
    <label for="first_name">Имя</label>
    <input type="text" name="first_name" id="first_name" required>
    <label for="patronymic">Отчество</label>
    <input type="text" name="patronymic" id="patronymic">

    <label for="phone_number">Контактный номер телефона</label>
    <input type="text" name="phone_number" id="phone_number" required>
    <label for="email">Адрес эл. почты (на него придёт код для подтверждения аккаунта)</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Придумайте пароль</label>
    <input type="password" name="password" id="password" required>
    <label for="password_repeat">Повторите пароль</label>
    <input type="password" name="password_repeat" id="password_repeat" required>

    
    <label>
        <input type="checkbox" name="agreement" id="agreement" required>
        Я согласен(-на) с <a href="#">Условиями</a>.
    </label>
    
    <input type="submit" name="submit" value="Зарегистрироваться">

    <p>Уже есть аккаунт? <a href="./login.php">Войти</a>.</p>
</form>
-->
<?php
    $pages = array(
        "ВетХелп" => "./",
        "Регистрация" => ""
    );
    include 'php/components/breadcrumbs.php';
    include 'php/components/header.php';
?>

<div class="section-wrapper" style="margin-top: auto;">

        <div class="section">
            <div class="section__info">
                <h2 class="section__info__heading">Регистрация</h2>
                <p class="section__info__paragraph">Зарегистрированные пользователи могут заказывать обратные звонки для записи на приём, оставлять отзывы врачам и другое.</p>
                <p class="section__info__paragraph">В поле ввода номера телефона после выбора телефонного кода вводите только цифры без пробелов и иных символов.</p>
            </div>
            <div class="section__main-block">
                
                <div class="section__main-block__block">
                    <div class="section__main-block__block__wrapper">
                        <!--<h3 class="section__main-block__block__wrapper__heading">Обратный звонок</h3>
                        <p class="section__main-block__block__wrapper__paragraph">Расписание работы операторов:<br>Пн-Сб: 9:00-21:00<br>Вс: 9:00-18:00</p>
                        <p class="section__main-block__block__wrapper__paragraph">Время ожидания обратного звонка: до 15 минут.</p>-->
                        <form class="section__main-block__block__wrapper__form" method="post" action="./php/includes/signup_process.php">
                            <div class="section__main-block__block__wrapper__form__fields--3cols">
                                <input type="text" class="section__main-block__block__wrapper__form__fields__field" placeholder="Фамилия" name="surname">
                                <input type="text" class="section__main-block__block__wrapper__form__fields__field" placeholder="Имя" name="first_name" required>
                                <input type="text" class="section__main-block__block__wrapper__form__fields__field" placeholder="Отчество" name="patronymic">

                                <div style="display: flex;">
                                    <select name="phone_number_prefix" id="" class="section__main-block__block__wrapper__form__fields__field" style="width: 110px; border-top-right-radius:0; border-bottom-right-radius:0;">
                                        
                                        <?php
                                            $phone_prefixes = array(7, 77, 375, 374, 380, 995, 1, 44, 47, 354, 81);
                                            sort($phone_prefixes);
                                            foreach ($phone_prefixes as $i => $prefix) {
                                                echo '<option value="+' . $prefix . '">+' . $prefix . '</option>';
                                            }
                                        ?>
                                    </select>

                                    <input type="text" pattern="[0-9]+" class="section__main-block__block__wrapper__form__fields__field" style="flex: 1;  border-top-left-radius:0; border-bottom-left-radius:0; width: 100%;" placeholder="Контактный номер телефона" name="phone_number" required>

                                </div>
                                <input type="email" class="section__main-block__block__wrapper__form__fields__field" placeholder="Контактный адрес эл. почты" name="email" required>
                                <input type="password" class="section__main-block__block__wrapper__form__fields__field" placeholder="Придумайте пароль" name="password" required>
                                <input type="password" class="section__main-block__block__wrapper__form__fields__field" placeholder="Повторите пароль" name="password_repeat" required>

                                
                            </div>
    
                            <label class="section__main-block__block__wrapper__form__agreement">
                                <input type="checkbox" name="agreement" id="agree" required="">
                                Нажимая кнопку "Создать аккаунт", я
                                подтверждаю свою дееспособность, даю согласие на
                                обработку своих персональных данных в соответствии с
                                <a href="#">Условиями</a>
                            </label>
                            
                            <div class="section__main-block__block__wrapper__buttons-block">
                                <input class="section__main-block__block__wrapper__buttons-block__button btn" style="font-size: inherit;" value="Создать аккаунт" name="submit" type="submit"> 
    
                            </div>
    
                        </form>
                    
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>

    <div class="section" style="text-align:center;">
        <p class="section__info__paragraph">Есть аккаунт? <a href="./login.php" class="underlined_link">Войти</a>.</p>
    </div>
    
<?php include 'php/components/footer.php'; ?>

</body>
