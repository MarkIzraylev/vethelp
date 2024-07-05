<?php
    include_once './php/includes/dbh.inc.php';
    session_start();
    //unset($_SESSION['logged_user_id']);
    $object = new Dbh;
    $pdo = $object->connect();

$title = 'Авторизация';
$message = ''; // contains the message to be displayed to user
$showVerificationForm = false; // defines whether verification form should be shown

if (isset($_POST['save_SFP'])) {
    if (!empty($_POST['first_name'])) {
        $sql = "update user set surname = :surname, first_name = :first_name, patronymic = :patronymic where id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam('surname', $_POST['surname']);
        $stmt->bindParam('first_name', $_POST['first_name']);
        $stmt->bindParam('patronymic', $_POST['patronymic']);
        $stmt->bindParam('id', $_SESSION['logged_user_id']);

        if ($stmt->execute()) {
            $_SESSION['surname'] = $_POST['surname'];
            $_SESSION['first_name'] = $_POST['first_name'];
            $_SESSION['patronymic'] = $_POST['patronymic'];
            $message = "Данные успешно изменены.";
        } else {
            $message = "Что-то пошло не так. Проверьте корректность введённых данных.";
        }
    } else {
        $message = "Для изменения данных необходимо заполнить все поля, обязательные для заполнения.";
    }
}

if (!isset($_SESSION['logged_user_id']) || $_SESSION['logged_user_id']=='') {
    $showVerificationForm = true;
    if (isset($_POST['submit'])) {
        $sql = "select * from user where email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam('email', $_POST['email']);

        $stmt->execute();
        $correctCredentials = true;

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (password_verify($_POST['password'], $row['password_hash'])) {
                $_SESSION['logged_user_id'] = $row['id'];
                $_SESSION['surname'] = $row['surname'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['patronymic'] = $row['patronymic'];
                $_SESSION['phone_number'] = $row['phone_number'];
                $_SESSION['email'] = $row['email'];
            } else {
                $correctCredentials = false;
            }
        } else {
            $correctCredentials = false;
        }

        if (! $correctCredentials) {
            $message = "Данные введены неверно или аккаунт не зарегистрирован.";
        } else {
            header("Refresh:0");
        }
    }
} else {
    $showLogoutForm = true;
    $title = 'Личный кабинет';
}

if (isset($_POST['logout'])) {
    unset($_SESSION['logged_user_id']);
    unset($_SESSION['surname']);
    unset($_SESSION['first_name']);
    unset($_SESSION['patronymic']);
    unset($_SESSION['phone_number']);
    unset($_SESSION['email']);
    header("Refresh:0");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в аккаунт клиента ветеринарной клиники "ВетХелп" в Ярославле</title>

    <link rel="stylesheet" href="./styles/style.css">
    <link rel="shortcut icon" href="./img/icons/paw_print.png" type="image/x-icon">
    
</head>
<body>
    
<script src="./js/libs/jquery-3.7.1.min.js"></script>

<?php

    $pages = array(
        "ВетХелп" => "/vethelp/",
        "Авторизация" => ""
    );
    include './php/components/breadcrumbs.php';
    include './php/components/header.php';
?>



<div class="section-wrapper" style="margin-top: auto;">

        <div class="section" style="text-align: center;">
            <div class="section__info">
                <h2 class="section__info__heading"><?php echo $title; ?></h2>
                <p class="section__info__paragraph"><?php echo $message; ?></p>
            </div>
            <div class="section__main-block">
                
                <div class="section__main-block__block">
                    <div class="section__main-block__block__wrapper">
                        
                        <?php if ($showVerificationForm) { ?>
                        <form class="section__main-block__block__wrapper__form" method="post">
                            <div class="section__main-block__block__wrapper__form__fields--3rows" style="margin-bottom: 0;">
                                <input type="email" class="section__main-block__block__wrapper__form__fields__field" placeholder="Эл. почта" name="email" required>
                                <input type="password" class="section__main-block__block__wrapper__form__fields__field" placeholder="Пароль" name="password" required>
                                <input class="section__main-block__block__wrapper__buttons-block__button btn" style="font-size: inherit;" value="Войти" name="submit" type="submit"> 
                            </div>
                        </form>
               
                        <?php } ?>

                        <?php if (isset($showLogoutForm) && $showLogoutForm != "") { ?>
                            <form class="section__main-block__block__wrapper__form" method="post">
                                <div class="section__main-block__block__wrapper__form__fields">
                                    <input type="text" class="section__main-block__block__wrapper__form__fields__field" placeholder="Фамилия" name="surname" value="<?php echo $_SESSION['surname']; ?>">
                                    <input type="text" class="section__main-block__block__wrapper__form__fields__field" placeholder="Имя" name="first_name" required value="<?php echo $_SESSION['first_name']; ?>">
                                    <input type="text" class="section__main-block__block__wrapper__form__fields__field" placeholder="Отчество" name="patronymic" value="<?php echo $_SESSION['patronymic']; ?>">
                                    <input class="section__main-block__block__wrapper__buttons-block__button btn" style="font-size: inherit;" value="Сохранить" name="save_SFP" type="submit"> 
                                </div>
                            </form>
                            <form class="section__main-block__block__wrapper__form" method="post">
                                <div class="section__main-block__block__wrapper__form__fields--3cols" style="display: block; margin-bottom: 0;">
                                    <!--<input class="section__main-block__block__wrapper__buttons-block__button btn" style="font-size: inherit;" value="Сменить пароль" name="" type="submit">
                                    <input class="section__main-block__block__wrapper__buttons-block__button btn" style="font-size: inherit;" value="Сменить эл. почту" name="" type="submit">-->
                                    <input class="section__main-block__block__wrapper__buttons-block__button btn" style="font-size: inherit;" value="Выйти из акканута" name="logout" type="submit"> 
                                </div>
                            </form>
                        <?php } ?>
                    
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
    <?php if (!(isset($showLogoutForm) && $showLogoutForm != "")) { ?>
        <div class="section" style="text-align:center;">
            <p class="section__info__paragraph">Нет аккаунта? <a href="./signup.php" class="underlined_link">Зарегистрироваться</a>.</p>
        </div>
    <?php } ?>
<?php include './php/components/footer.php'; ?>

</body>