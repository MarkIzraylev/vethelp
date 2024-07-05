<?php

session_start();
$message = ''; // contains the message to be displayed to user
$showVerificationForm = false; // defines whether verification form should be shown

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Подтверждение регистрации на сайте ветеринарной клиники "ВетХелп" в Ярославле</title>

    <link rel="stylesheet" href="./../../styles/style.css">
    <link rel="shortcut icon" href="./../../img/icons/paw_print.png" type="image/x-icon">
    
</head>
<body>
    
<script src="./../../js/libs/jquery-3.7.1.min.js"></script>

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
    include_once './dbh.inc.php';

    if (isset($_SESSION['account_verification_code']) && $_SESSION['account_verification_code'] != '') {
        $message = "Код подтверждения был выслан на указанную эл. почту (проверьте также папку спама). Для завершения регистрации введите его в поле ниже в течении 24 минут с момента отправки письма с кодом подтверждения.";
        $showVerificationForm = true;
    } else {
        $message = "Код подтверждения не был отправлен или вы уже были зарегистрированы. Если аккаунт все-таки не создался, можно попробовать заполнить форму регистрации и отправить её ещё раз.";
        $showVerificationForm = false;
    }

    if (isset($_POST['submit_verify'])) {
        if (isset($_SESSION['account_verification_code'])) {
            if ($_POST['entered_code'] == $_SESSION['account_verification_code']) {
                $object = new Dbh;
                $pdo = $object->connect();
                $sql = "insert into user (surname, first_name, patronymic, phone_number, email, password_hash) values (:surname, :first_name, :patronymic, :phone_number, :email, :password_hash)";
                $stmt = $pdo->prepare($sql);
                $params = array(
                    ':surname' => $_SESSION['surname'],
                    ':first_name' => $_SESSION['first_name'],
                    ':patronymic' => $_SESSION['patronymic'],
                    ':phone_number' => $_SESSION['phone_number'],
                    ':email' => $_SESSION['email'],
                    ':password_hash' => $_SESSION['hashed_password']
                );

                try {
                    $stmt->execute($params);
                    $message = "Аккаунт зарегистрирован! Теперь вы можете войти в него и заказать обратный звонок.";
                    $showVerificationForm = false;
                    unset($_SESSION['hashed_password']);
                    unset($_SESSION['account_verification_code']);
                    unset($_SESSION['surname']);
                    unset($_SESSION['first_name']);
                    unset($_SESSION['patronymic']);
                    unset($_SESSION['phone_number']);
                    unset($_SESSION['email']);
                } catch (PDOException $e) {
                    if ($e->getCode() == 23000) {
                        $message = "Аккаунт с таким адресом эл. почты уже зарегистрирован.";
                        $showVerificationForm = false;
                    } else {
                        $message = $e->getCode() . '<br>' . $e -> getMessage();
                        $showVerificationForm = false;
                    }
                } catch (Exception $e) {
                    $message = "Общая ошибка: аккаунт не был создан.";
                    $showVerificationForm = false;
                    }
            } else {
                $message = "Код подтверждения введён неверно. Пожалуйста, попробуйте ещё раз.";
                $showVerificationForm = true;
            }
        }
    }
?>







<?php
    $pages = array(
        "ВетХелп" => "/vethelp/",
        "Регистрация" => "/vethelp/signup.php",
        "Подтверждение" => ""
    );
    include '../components/breadcrumbs.php';
    include '../components/header.php';
?>
<script src="./../../js/general/hamburger.js"></script>


<div class="section-wrapper" style="margin-top: auto;">

        <div class="section">
            <div class="section__info">
                <h2 class="section__info__heading">Подтверждение регистрации</h2>
                <p class="section__info__paragraph"><?php echo $message; ?></p>
            </div>
            <div class="section__main-block">
                
                <div class="section__main-block__block">
                    <div class="section__main-block__block__wrapper">
                        <!--<h3 class="section__main-block__block__wrapper__heading">Обратный звонок</h3>
                        <p class="section__main-block__block__wrapper__paragraph">Расписание работы операторов:<br>Пн-Сб: 9:00-21:00<br>Вс: 9:00-18:00</p>
                        <p class="section__main-block__block__wrapper__paragraph">Время ожидания обратного звонка: до 15 минут.</p>-->
                        <?php if ($showVerificationForm) { ?>
                        <form class="section__main-block__block__wrapper__form" method="post">
                            <div class="section__main-block__block__wrapper__form__fields">
                                <input type="text" class="section__main-block__block__wrapper__form__fields__field" placeholder="Код подтверждения" name="entered_code" required>
                                <input class="section__main-block__block__wrapper__buttons-block__button btn" style="font-size: inherit;" value="Подтвердить" name="submit_verify" type="submit"> 
                                
                            </div>
                            
    
                        </form>
                        <?php } ?>
                    
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>

<?php include '../components/footer.php'; ?>

</body>