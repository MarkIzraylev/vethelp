<?php
    include_once 'php/includes/dbh.inc.php';
    $object = new Dbh;
    $pdo = $object->connect();
    

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ветеринарная клиника "ВетХелп" в Ярославле</title>
    <meta name="description" content="Ветеринарная помощь для ваших питомцев в Ярославле. Современное оборудование и опытные специалисты.">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="shortcut icon" href="img/icons/paw_print.png" type="image/x-icon">
    
</head>
<body>
    <script src="js/libs/jquery-3.7.1.min.js"></script>

    <!--<div class="header">
        <div class="logo-block"><img src="img/icons/paw_print.png" alt="Логотип" class="logo-block__icon">ВетХелп</div>
        <div class="middle-block">
            <a href="./#services" class="header-link">Услуги</a>
            <a href="./#specialists" class="header-link">Специалисты</a>
            <a href="./#appointment_form" class="header-link">Запись на приём и контакты</a>
            <a href="./#about_us" class="header-link">О нас</a>
        </div>
        <div class="account-block">
            <a href="#" class="header-link">Войти</a>
        </div>
        <div class="hamburger-block">
            <button id="hamburger">☰</button>
        </div>
    </div>-->
    <?php
        include 'php/components/header.php';
    ?>
    <div class="hero">
        <div class="hero__start">
            <div class="hero__start__wrapper">
                <?php
                    $sql1 = "select *, REPLACE(description, char(10), '<br>') as processed_description from section";
                    $stmt1 = $pdo->prepare($sql1);
                    $sections = array(
                        'sectionName' => array(
                            'heading' => 'Section Heading',
                            'description' => 'Section Description'
                        ),
                    );
                    
                    if ($stmt1->execute()) {
                        while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                            $heading = $row1['heading'];
                            $description = $row1['processed_description'];
                            $name = $row1['name'];
                            $sections[$name] = array(
                                'heading' => $heading,
                                'description' => $description
                            );
                        }
                    }
                ?>
                <h1 class="hero__start__wrapper__heading"><?php echo $sections['hero']['heading']; ?></h1>
                <p class="hero__start__wrapper--paragraph"><?php echo $sections['hero']['description']; ?></p>
                <div class="hero__start__wrapper__buttons-block">
                    <a href="./#appointment_form" class="hero__start__wrapper__buttons-block__button">Запись на приём</a>
                </div>
            </div>
            
        </div>
        <div class="hero__end">
            <div class="hero__end__image-wrapper blur-load" style="background-image: url('img/cats_and_dogs_small.jpg');">
                <img src="img/pets2.png" alt="Домашние животные">

            </div>
        </div>
    </div>

    <div class="section-wrapper" id="about_us">
        <section class="hero" style="height: auto; min-height: auto;">
        
            <div class="hero__end">
                <div class="hero__end__image-wrapper blur-load" style="background-image: url('img/cat_and_dog_small.jpg');">
                    <img src="img/cat_and_dog.jpg" alt="Доктор" loading="lazy">
    
                </div>
            </div>
            <div class="hero__start">
                <div class="hero__start__wrapper">
                    <h2 class="hero__start__wrapper__heading"><?php echo $sections['about_us']['heading']; ?></h2>
                    <div class="hero__start__wrapper--paragraph"><?php echo $sections['about_us']['description']; ?></div>
                </div>
            </div>
        </section>
    </div>

    
    <span id="services"></span>

    <section class="section">
        <div class="section__info">
            <h2 class="section__info__heading"><?php echo $sections['services']['heading']; ?></h2>
            <p class="section__info__paragraph"><?php echo $sections['services']['description']; ?></p>
        </div>
        <div class="section__buttons">
            <div class="section__buttons__switcher">
                <button data-for-moving-block-id="services" data-move-direction="right">&lt;</button>
            </div>
            <div class="section__buttons__buttons">
                <div class="section__buttons__buttons__moving-block" data-moving-block-id="services">
                    
                    <?php
                        

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
                    ?>
                </div>
            </div>
            <div class="section__buttons__switcher">
                <button data-for-moving-block-id="services" data-move-direction="left">&gt;</button>
            </div>
        </div>
        <div class="section__changing-content">

            <?php
                $sql = "select * from service_type";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($results as $row) {
                    $service_type_id = $row['id'];
                    $filename = $row['cover_filename'];
                    $smallfilename = explode('.', $filename)[0]."_small.".explode('.', $filename)[1];
                    
                    $sql = "select * from service where service_type_id = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$service_type_id]);
                    $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $servicesHTML = "";
                    foreach ($services as $service) {
                        $servicesHTML .= "
                            <tr>
                                <td>{$service['name']}</td>
                                <td>{$service['price']}</td>
                            </tr>
                        ";
                    }

                    echo <<<END
                    <div class="section__main-block--fr1-2">
                    <div class="section__main-block__block">
                        <div class="hero__end__image-wrapper blur-load" style="background-image: url('img/services/$smallfilename');">
                            <img src="img/services/$filename" alt="Обложка вида услуг" loading="lazy">
                        </div>
                    </div>
                    <div class="section__main-block__block">
                        <div class="section__main-block__block__wrapper">
                            <table>
                                <tr>
                                    <th>Услуга</th>
                                    <th>Стоимость</th>
                                </tr>
                                {$servicesHTML}
                            </table>
                        </div>
                    </div>
                </div>
                END;
                }
            ?>

        </div>
    </section>


    <section class="section" id="specialists">
        <div class="section__info">
            <h2 class="section__info__heading"><?php echo $sections['specialists']['heading']; ?></h2>
            <p class="section__info__paragraph"><?php echo $sections['specialists']['description']; ?></p>
        </div>
        <div class="section__buttons">
            <div class="section__buttons__switcher">
                <button data-for-moving-block-id="specialists" data-move-direction="right">&lt;</button>
            </div>
            <div class="section__buttons__buttons">
                <div class="section__buttons__buttons__moving-block" data-moving-block-id="specialists">
                    <?php
                        $sql = "select * from specialist_type";
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
                    ?>
                </div>
            </div>
            <div class="section__buttons__switcher">
                <button data-for-moving-block-id="specialists" data-move-direction="left">&gt;</button>
            </div>
        </div>
        <div class="section__changing-content">
            <?php
                //div for every specialist_type
                //    all specialists of this type
                
                $sql = "select * from specialist_type";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($results as $row) {
                    echo "<div>";
                    $specialist_type_id = $row['id'];
                    
                    
                    $sql = "select * from specialist where specialist_type_id = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$specialist_type_id]);
                    $specialists = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    
                    foreach ($specialists as $specialist) {
                        $filename = $specialist['cover_filename'];
                        $smallfilename = explode('.', $filename)[0]."_small.".explode('.', $filename)[1];

                        $sql1 = "select round(avg(rating), 2) as 'average_rating', count(rating) as 'num_of_reviews' from review where specialist_id = :id";
                        $stmt1 = $pdo->prepare($sql1);
                        $params1 = array(
                            ':id' => $specialist['id']
                        );

                        if ($stmt1->execute($params1)) {
                            $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
                            $rating = $row1['average_rating'] . ' на основании ' . $row1['num_of_reviews'] . ' отзыва(-ов)';
                            
                            if ($rating > 0) {
                            } else {
                                $rating = 'нет';
                            }
                        }
                        echo <<<END
                            <div class="section__main-block--fr1-2">
                                <div class="section__main-block__block">
                                    <div class="hero__end__image-wrapper blur-load" style="background-image: url('img/doctors/$smallfilename');">
                                        <img src="img/doctors/$filename" alt="Изображение доктора" loading="lazy">
                                    </div>
                                </div>
                                <div class="section__main-block__block">
                                    <div class="section__main-block__block__wrapper">
                                        <h3 class="section__main-block__block__wrapper__heading">{$specialist['surname']} {$specialist['first_name']} {$specialist['patronymic']}</h3>
                                        <p class="section__main-block__block__wrapper__paragraph"><b>Специализация:</b><br>
                                            {$specialist['specialization']}
                                        </p>

                                        <p class="section__main-block__block__wrapper__paragraph"><b>Образование:</b><br>
                                            {$specialist['education']}
                                        </p>

                                        <p class="section__main-block__block__wrapper__paragraph"><b>Рейтинг:</b> {$rating}.</p>

                                        <p class="section__main-block__block__wrapper__paragraph">
                                            <a href="./specialist.php?id={$specialist['id']}#reviews" class="section__main-block__block__link">Отзывы о специалисте</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        END;
                    }


                    echo "</div>";
                }
            

            ?>
            

        </div>
        


        




        
        
    </section>


    <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['logged_user_id']) && $_SESSION['logged_user_id']!='') {
            $appointmentFormEnabled = true;
        } else {
            $appointmentFormEnabled = false;
        }
    ?>


    <?php
        
    $title = 'Оповещение';
    $message = 'По какой-то причине у оповещения нет текста.'; // contains the message to be displayed to user

    global $title;
    global $message;

    
    
    if (isset($_POST['appointment_submit'])) {
        if (!isset($_SESSION['logged_user_id']) || $_SESSION['logged_user_id']=='') {
            $title = "Необходим вход в аккаунт";
            $message = 'Для отправки заявки на обратный звонок, пожалуйста, создайте (если его нет) и войдите в аккаунт.';
            
        } else {
            
                if (isset($_POST['agreement'])) {
                    $object = new Dbh;
                    $pdo = $object->connect();
    
                    // check that pet_type id exists in pet_type table
                    $sql1 = "SELECT * FROM pet_type WHERE id=:pet_type_id";
                    $stmt1 = $pdo->prepare($sql1);
                    $stmt1->bindParam(':pet_type_id', $_POST['pet_type']);
                    
                    $stmt1->execute();
                    
                    if ($stmt1->rowCount() == 1) {
                        $user_id = $_SESSION['logged_user_id'];
                        date_default_timezone_set("Europe/Moscow");
                        
                        $sql = "insert into appointments (sending_timestamp, pet_type_id, user_id) values (:datetime, :pet_type_id, :user_id)";
                        $stmt = $pdo->prepare($sql);
                        $datetime = date("Y-m-d H:i:s");
                        $params = array(
                            ':datetime' => $datetime,
                            ':pet_type_id' => $_POST['pet_type'],
                            ':user_id' => $_SESSION['logged_user_id']
                        );
    
                        if ($stmt->execute($params)) {
                            $title = "Ожидайте обратного звонка";
                            $message = "Заявка на обратный звонок отправлена. Пожалуйста, ожидайте звонка оператора в течение ближайших 15 минут, если этот промежуток времени подпадает под рабочие часы операторов: Пн-Сб: 9:00-21:00; Вс: 9:00-18:00. В ином случае оператор свяжется с Вами по указанному номеру телефона в своё рабочее время.";
                        } else {
                            $title = "Ошибка";
                            $message = "Что-то пошло не так. Пожалуйста, попробуйте позже.";
                        }
                    } else {
                        $title = "Ошибка";
                        $message = "Кажется, код элемента был изменен или типа питомца с таким id не существует в БД.";
                    }
                } else {
                    $title = "Необходимо согласие";
                    $message = "Необходимо выразить согласие, поставив галочку на форме, чтобы отправить заявку на обратный звонок.";
                }
                
        }
        unset($_SESSION['appointment_result_title']);
        unset($_SESSION['appointment_result_title']);

        $_SESSION['appointment_result_title'] = $title;
        $_SESSION['appointment_result_message'] = $message;
        echo '<script>location.replace("appointment.php");</script>';
    }
    
    ?>

    <span id="appointment_form"></span>
    <div class="section-wrapper">

        <section class="section">
            <div class="section__info">
                <h2 class="section__info__heading"><?php echo $sections['appointment_form']['heading']; ?></h2>
                <p class="section__info__paragraph"><?php echo $sections['appointment_form']['description']; ?></p>
            </div>
            <div class="section__main-block--fr1-3">
                <div class="section__main-block__block">
                    <div class="section__main-block__block__wrapper" style="justify-content: flex-start;">
                        <h3 class="section__main-block__block__wrapper__heading"><?php echo $sections['appointment_form_contacts']['heading']; ?></h3>
                        <p class="section__main-block__block__wrapper__paragraph">
                            <?php echo $sections['appointment_form_contacts']['description']; ?>
                        </p>
                        <div class="section__main-block__block__wrapper__buttons-block">
                            <?php echo $sections['appointment_form_contacts_buttons']['description']; ?>
                            
                        </div>
                    </div>
                    
                </div>
                <div class="section__main-block__block">
                    <div class="section__main-block__block__wrapper">
                        <h3 class="section__main-block__block__wrapper__heading"><?php echo $sections['appointment_form_timetable']['heading']; ?></h3>
                        <p class="section__main-block__block__wrapper__paragraph"><?php echo $sections['appointment_form_timetable']['description']; ?></p>
                        <form class="section__main-block__block__wrapper__form" method="post">
                            
                            <?php
                                if ($appointmentFormEnabled) {
                            ?>
                            
                            <p class="section__main-block__block__wrapper__paragraph">Информация о питомце:</p>
                            <div class="section__main-block__block__wrapper__form__fields" style="grid-template-columns: 1fr;">
                                <select name="pet_type" class="section__main-block__block__wrapper__form__fields__field">
                                    
                                    <?php
                                        $c = "select * from pet_type";
                                        $s = $pdo->prepare($c);
                                        $s->execute();
                                        $rs = $s->fetchAll(PDO::FETCH_ASSOC);
                        
                                        foreach ($rs as $r) {
                                            ?>
                                            <option value="<?php echo $r['id']; ?>"><?php echo $r['name']; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <p class="section__main-block__block__wrapper__paragraph">Информация о хозяине (при необходимости можно изменить данные в личном кабинете):</p>
                            <p class="section__main-block__block__wrapper__paragraph">
                                <img src="img/icons/mobile_phone.png" alt="Иконка телефона" class="section__main-block__block__wrapper__paragraph__icon"> <?php echo $_SESSION['phone_number']; ?><br>
                                <img src="img/icons/person.png" alt="Иконка пользователя" class="section__main-block__block__wrapper__paragraph__icon"> <?php echo $_SESSION['surname'] . " " . $_SESSION['first_name'] . " " . $_SESSION['patronymic']; ?>
                            </p>
    
                            <label class="section__main-block__block__wrapper__form__agreement">
                                <input type="checkbox" name="agreement" id="agree" required>
                                Нажимая кнопку "Заказать обратный звонок", я
                                подтверждаю свою дееспособность, даю согласие на
                                обработку своих персональных данных в соответствии с
                                <a href="#">Условиями</a>
                            </label>
                            
                            <div class="section__main-block__block__wrapper__buttons-block">
                                <input class="section__main-block__block__wrapper__buttons-block__button btn" style="font-size: inherit;" type="submit" name="appointment_submit" value="Заказать обратный звонок">
    
                            </div>

                            <?php
                                } else {
                                    
                            ?>
                            <div class="section__main-block__block__wrapper__form__fields" style="grid-template-columns: 1fr;">
                                <div class="notification">Чтобы воспользоваться формой, пожалуйста, создайте (если нет) и войдите в аккаунт.</div>
                            </div>
                            <?php
                                }
                            ?>
    
                        </form>
                    
                    </div>
                    
                </div>
            </div>
            
        </section>
    </div>

    
    
    <?php
        include 'php/components/footer.php';
    ?>
    <!--<footer class="footer">
        <div class="footer__start-block">
            © 2024 ВетХелп. Все права защищены.
        </div>
        <div class="footer__middle-block">
            <a class="header-link">Политика конфиденциальности</a>
            <a class="header-link">Правила пользования сайтом</a>
            <a href="./#appointment_form" class="header-link">Контакты</a>
        </div>
    </footer>-->

    <script src="js/general/lazy_load.js"></script>

    <script src="js/components/button_slider.js"></script>
</body>
</html>