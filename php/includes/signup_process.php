<?php

include_once './dbh.inc.php';
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

$object = new Dbh;
$pdo = $object->connect();

// not done:
    // todo: validate phone

// done:
    // todo: check that email is not registered yet


if (isset($_POST['submit'])) {
    $_SESSION['account_verification_code'] = '';
    $_SESSION['registration_trials_count'] = '';

    $_SESSION['hashed_password'] = '';

    $_SESSION['surname'] = '';
    $_SESSION['first_name'] = '';
    $_SESSION['patronymic'] = '';
    $_SESSION['phone_number'] = '';
    $_SESSION['email'] = '';

    $surname = $_POST['surname'];
    $first_name = $_POST['first_name'];
    $patronymic = $_POST['patronymic'];
    // if all symbols are digits
    if (preg_match('/[^z0-9]/', $_POST['phone_number'])) {
        die("В номере телефона (без учёта префикса номера телефона) должны использоваться только десятичные цифры без пробелов или иных символов.");
    }
    $phone_number = $_POST['phone_number_prefix'] . $_POST['phone_number'];
    
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];
    
    // check if inputs are empty
    if (empty($first_name) || empty($phone_number) || empty($email) || empty($password) || empty($password_repeat)) {
        echo "Пожалуйста, заполните все необходимые поля.";
    } else if (!isset($_POST['agreement'])) {
        echo "Регистрация невозможна без согласия на обработку персональных данных, которое подтверждается проставлением соответствующей галочки в форме регистрации.";
    } else {
        if ($password != $password_repeat) {
            echo "Пароли не совпадают. Попробуйте еще раз.";
        } else {
            $sql = "select * from user where email = :email";
            $stmt = $pdo->prepare($sql);
            $params = array(
                ':email' => $email
            );

            $stmt->execute($params);
            
            // if there's no user with such email yet
            if ($stmt->rowCount() == 0) {
                // сгенерировать случайный четырехзначный код в переменную $code
                $length = 4;
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $code = '';
                for ($i = 0; $i < $length; $i++) {
                    $index = mt_rand(0, strlen($characters)-1);
                    $code .= $characters[$index];
                }
                
    
    
                $_SESSION['account_verification_code'] = $code;
    
                // hash password before inserting into database
                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                $_SESSION['registration_trials_count'] = 1;
    
                $_SESSION['hashed_password'] = $hashedPwd;
    
                $_SESSION['surname'] = $surname;
                $_SESSION['first_name'] = $first_name;
                $_SESSION['patronymic'] = $patronymic;
                $_SESSION['phone_number'] = $phone_number;
                $_SESSION['email'] = $email;
    
                $mail = new PHPMailer();
                $mail->IsSMTP(); // enable SMTP
    
                //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
                $mail->SMTPAuth = true; // authentication enabled
                $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 465; // or 587
                $mail->IsHTML(true);
                $mail->Username = "markizraylev00507@gmail.com";
                $mail->Password = "ulbl ycqd dkqt eqlv";
                $mail->SetFrom("markizraylev00507@gmail.com");
                $mail->Subject = "Код подтверждения регистрации на сайте ВетХелп";
                $mail->Body = "Для завершения регистрации на сайте ветеринарной клиники ВетХелп введите код $code, учитывая регистр, если в нём есть буквы. Если вы не начинали регистрацию на сайте ВетХелп, то просто пропустите это письмо.";
                $mail->AddAddress($email);
    
                if(!$mail->Send()) {
                    echo "Ошибка отправки сообщения: " . $mail->ErrorInfo;
                } else {
                    header('Location: signup_verification.php');
                }

            } else {
                echo 'Регистрация прервана. Пользователь с таким адресом эл. почты уже существует.';
            }

        }
    }

} else {
    echo "Данные не были переданы. <a href='../../'>На главную</a>.";
}

/*
$sql = "select * from service_type";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$c = 0;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $selectedClass = '';
    if ($c == 0) {
        $selectedClass = 'class="selected"';
    }
    echo "<button {$selectedClass}>{$row['name']}</button>";
    $c++;
}
*/