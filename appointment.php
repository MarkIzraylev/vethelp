<?php
    include_once './php/includes/dbh.inc.php';
    session_start();
    //unset($_SESSION['logged_user_id']);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заказ обратного звонка ветеринарной клиники "ВетХелп" в Ярославле</title>

    <link rel="stylesheet" href="./styles/style.css">
    <link rel="shortcut icon" href="./img/icons/paw_print.png" type="image/x-icon">
    
</head>
<body>
    
<script src="./js/libs/jquery-3.7.1.min.js"></script>

<?php
    if (!empty($_SESSION['appointment_result_title'])) {
        $title = $_SESSION['appointment_result_title'];

    } else {
        $title = "Пустое значение";
    }

    if (!empty($_SESSION['appointment_result_message'])) {
        $message = $_SESSION['appointment_result_message'];

    } else {
        $message = "Пустое значение";
    }
    
    $pages = array(
        "ВетХелп" => "/vethelp/",
        "Заказ обратного звонка" => ""
    );
    include './php/components/breadcrumbs.php';
    include './php/components/header.php';
?>



<div class="section-wrapper" style="margin-top: auto;">

        <div class="section" style="text-align: center">
            <div class="section__info">
                <h2 class="section__info__heading"><?php echo $title; ?></h2>
                <p class="section__info__paragraph"><?php echo $message; ?></p>
            </div>
            
        </div>
    </div>
    
<?php include './php/components/footer.php'; ?>

</body>