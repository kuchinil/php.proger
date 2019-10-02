<?php
require 'includes/db.php';
$mysqli = $connect;
$result_set = $mysqli->query("SELECT * FROM `comments` ORDER BY `comments`.`date` DESC ");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $config['sitename']; ?></title>
    <link href="<?php echo $config['favicon']; ?>" rel="icon" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div class="wrap">
        <div class="image-block">
            <h1 class="page__title">Mercedes C-Class W204</h1>
            <img src="images/mercedes.jpg" alt="">
        </div>
        <h1 class="page__title">Комментарии</h1>
        <form id="form_comment" class="block-comments__form" action="javascript:void(null);" method="POST" onsubmit="call()">
            <input class='block-comments__form-input' id="name" name="name" type="text" placeholder="Введите ваше имя"><br>
            <textarea class='block-comments__form-comment' id="text" name="text" id="" cols="20" rows="5" placeholder="Введите комментарий" required></textarea><br>
            <div class="g-recaptcha" data-sitekey="6LeFKrsUAAAAAE5wo81CCtvIrGiQtLhW2VJeSebt"></div>
            <?php
            ?>
            <input id="btn" class='block-comments__form-button' type="submit" value="Добавить комментарий">
        </form>
        <?php
             while ($row = $result_set->fetch_assoc()) {
                $_monthsList = array(".01." => "января", ".02." => "февраля", 
                                     ".03." => "марта", ".04." => "апреля", ".05." => "мая", ".06." => "июня", 
                                     ".07." => "июля", ".08." => "августа", ".09." => "сентября",
                                     ".10." => "октября", ".11." => "ноября", ".12." => "декабря");
                $row['date'] = date('j.m.Y в H:i', strtotime($row['date']));
                $_mD = date(".m.");
                $row['date'] = str_replace($_mD, " ".$_monthsList[$_mD]." ", $row['date']);
                echo '<div class="block-comments">' . '<a href="#" class="block-comments__delete" title="Удалить комментарий"><i class="far fa-trash-alt"></i></a>' .
                '<div class="wrap-nm">' . '<div class="block-comments__name">' . '<p>' . $row['name'] . '</p>' . '</div>' . '<div class="block-comments__date">' . 
                '<p>' . $row['date'] . '</p>' . '</div>' . '</div>' . '<div class="block-comments__text">' . $row['text'] . '</div>' . '</div>';
              }  
        ?>
    </div>

    <script type="text/javascript" language="javascript">
 	function call() {
 	  var msg   = $('#form_comment').serialize();
        $.ajax({
          type: 'POST',
          url: 'includes/comment.php',
          data: msg
        });
 
    }
</script>
</body>
</html>