<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Специалист</title>

    <link rel="stylesheet" href="styles/style.css">
    <link rel="shortcut icon" href="img/icons/paw_print.png" type="image/x-icon">
    
</head>
<body>
    <script src="js/libs/jquery-3.7.1.min.js"></script>


<?php
    $title = '';
    $message = '';
    if (count($_GET) > 0 && isset($_GET['id'])) {
        // select a speacialist by id from the database and display their name if they exist
        include_once './php/includes/dbh.inc.php';
        $object = new Dbh;
        $pdo = $object->connect();
        $sql = "select * from specialist where id = :id";
        $stmt = $pdo->prepare($sql);
        $params = array(
            ':id' => $_GET['id']
        );

        if ($stmt->execute($params)) {
            // if there is a specialist with such id
            if ($stmt->rowCount() > 0) {

                $sql1 = "select round(avg(rating), 2) as 'average_rating' from review where specialist_id = :id";
                $stmt1 = $pdo->prepare($sql1);
                $params1 = array(
                    ':id' => $_GET['id']
                );

                if ($stmt1->execute($params1)) {
                    $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
                    $rating = $row1['average_rating'];
                    if ($rating > 0) {
                    } else {
                        $rating = 'нет';
                    }
                }

                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $SFP = "{$row['surname']} {$row['first_name']} {$row['patronymic']}";
                $specialization = $row['specialization'];
                $education = $row['education'];
                $cover_filename = $row['cover_filename'];
                $small_cover_filename = explode('.', $cover_filename)[0]."_small.".explode('.', $cover_filename)[1];
            } else {
                $title = "Упс!";
                $message = "Неправильный URL. Кажется, специалиста с таким ID не существует в БД.";
            }
        } else {
            $title = "Упс!";
            $message = "Что-то пошло не так при поиске специалиста в БД.";
        }
        
        
    } else {
        $title = "Упс!";
        $message = "URL-адрес введён не полностью.";
    }
    $pages = array(
        "ВетХелп" => "./",
        "Специалист" => ""
    );
    include_once 'php/components/breadcrumbs.php';
    include_once 'php/components/header.php';
?>

    <div class="hero">
        <div class="hero__start">
            <div class="hero__start__wrapper">
                <?php if ($title == '' && $message == '') { ?>
                <h1 class="section__main-block__block__wrapper__heading"><?php echo $SFP; ?></h1>
                <p class="section__main-block__block__wrapper__paragraph"><b>Специализация:</b><br>
                    <?php echo $specialization; ?>
                </p>

                <p class="section__main-block__block__wrapper__paragraph"><b>Образование:</b><br>
                    <?php echo $education; ?>
                </p>

                <p class="section__main-block__block__wrapper__paragraph"><b>Рейтинг:</b> <?php echo $rating; ?>.</p>
                <?php } else { ?>
                    <h1 class="section__main-block__block__wrapper__heading"><?php echo $title; ?></h1>
                    <p class="section__main-block__block__wrapper__paragraph"><?php echo $message; ?></p>
                <?php } ?>
            </div>
            
        </div>
        <div class="hero__end">
            <?php if ($title == '' && $message == '') { ?>
            <div class="hero__end__image-wrapper blur-load" style="background-image: url('img/doctors/<?php echo $small_cover_filename; ?>');">
                <img src="img/doctors/<?php echo $cover_filename; ?>" alt="">
            </div>
            <?php } else { ?>
                <div class="hero__end__image-wrapper blur-load" style="background-image: url('img/404_small.jpg');">
                    <img src="img/404.jpeg" alt="">
                </div>
            <?php } ?>
        </div>
    </div>


<?php if ($title == '' && $message == '') { ?>
<div class="section-wrapper">
    <section class="section" id="reviews">
        <div class="section__info">
            <h2 class="section__info__heading">Отзывы</h2>
            <p class="section__info__paragraph">Отзывы публикуются автоматически, удаляются только в случае несоответствия законодательству или правилам пользования сайтом.</p>
        </div>
        
        <div class="section__changing-content">
            <div>
                <?php
                    $sql = "select *, REPLACE(review.review, char(10), '<br/>') as processed_review from review, user where review.specialist_id = :id and review.user_id = user.id";
                    $stmt = $pdo->prepare($sql);
                    $params = array(
                        ':id' => $_GET['id']
                    );
            
                    if ($stmt->execute($params)) {
                        if ($stmt->rowCount() > 0) {
                            
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $reviewer_SFP = $row['surname'] . ' ' . $row['first_name'] . ' ' . $row['patronymic'];
                                $review_rating = $row['rating'];
                                $review_date = explode('-', $row['review_date'])[2] . '.' . explode('-', $row['review_date'])[1] . '.' . explode('-', $row['review_date'])[0];
                                $review = $row['processed_review'];
                                $review_cover_filename = $row['cover_filename'];
                                $review_small_cover_filename = explode('.', $review_cover_filename)[0]."_small.".explode('.', $review_cover_filename)[1];
                                ?>
                                <div class="section__main-block--fr1-1">
                                    <div class="section__main-block__block">
                                        <div class="hero__end__image-wrapper blur-load" style="background-image: url('img/reviews/<?php echo $review_small_cover_filename; ?>');">
                                            <img src="img/reviews/<?php echo $review_cover_filename; ?>" alt="Доктор" loading="lazy">
                                        </div>
                                    </div>
                                    <div class="section__main-block__block--review">
                                        <div class="section__main-block__block__wrapper--justify-start" tabindex="1">
                                            <h3 class="section__main-block__block__wrapper__heading"><?php echo $reviewer_SFP; ?></h3>

                                            <p class="section__main-block__block__wrapper__paragraph"><b>Оценка:</b> <?php for ($i = 0; $i < $review_rating; $i++) { echo '★'; } for ($i = 0; $i < 5-$review_rating; $i++) { echo '✩'; } ?>.</p>

                                            <p class="section__main-block__block__wrapper__paragraph"><b>Дата:</b> <?php echo $review_date; ?>.</p>

                                            <p class="section__main-block__block__wrapper__paragraph"><b>Комментарий:</b></p>
                                            <p class="section__main-block__block__wrapper__paragraph">
                                                <?php echo str_replace('\r', '<br>', $review); ?>
                                            </p>
                                            
                                            
                                        </div>
                                        <div>
                                            <a tabindex="1"><b>Читать далее</b></a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo "<div class='notification'>Данному специалисту ещё не оставили отзывов.</div>";
                        }
                    }
                ?>
                



            </div>
            



            

            <!-- other blocks -->

        </div>
        
        
    </section>
</div>
<?php } else { ?>
<?php } ?>

    <footer class="footer">
        <div class="footer__start-block">
            © 2024 ВетХелп. Все права защищены.
        </div>
        <div class="footer__middle-block">
            <a href="#" class="header-link">Политика конфиденциальности</a>
            <a href="#" class="header-link">Правила пользования сайтом</a>
            <a href="#" class="header-link">Контакты</a>
        </div>
    </footer>

    <script src="js/general/lazy_load.js"></script>

    <script src="js/general/dark_theme.js"></script>
    <script src="js/components/button_slider.js"></script>
    <script src="js/components/reviews.js"></script>
</body>
</html>