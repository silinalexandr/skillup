<?php

define('UPLOAD_DIR', 'upload/');

//  example of fopen and fwrite and for

//$h = fopen('text.txt', 'a+');
//for ($i=1; $i<=100; $i++) {
//    fwrite($h, "new string: {$i}" . PHP_EOL);
//}
//
//fclose($h);



// glob показывает все файлы в из папки нашего проекта по заданому шаблону  пояснения смотреть на php.net/glob

//$result = glob('*.php');
//var_dump($result);

// проходим по всем файлам из каталога с фильтром php создаем массив, потом из массива берем имена файлов и через функцию в var_dump выбираем filesize

//$arrResult = glob('*.php');
//foreach ($arrResult as $filename) {
//    var_dump(filesize($filename));
//}
//var_dump($arrResult);


//пробуем функцию копирование на примере текстового файла

//$arrResult = glob('*.txt');
//foreach ($arrResult as $filename) {
//    var_dump(filesize($filename));
//    copy($filename, $filename. '.bak');
//}
//var_dump($arrResult);



//$arrResult = glob('*.txt');
//foreach ($arrResult as $filename) {
//    var_dump(filesize($filename));
//    //copy($filename, $filename. '.bak');
//    unlink($filename);
//}
//var_dump($arrResult);
//
//
//die();


function getFullName($user) {
    return $user['firstname'] . ' ' . $user['lastname'];
}

function createPath($path) {
    $isSuccess = false;
    if (!file_exists($path)) {
        $isSuccess = mkdir($path, 0777, true);
    }
    return $isSuccess;
}



//var_dump($_POST);

// unset($_POST['is_agree']);
// var_dump($_POST);

$error_message = [];

$user = [
    'firstname' => null,
    'lastname' => null,
    'password' => null,
    'sex' => null,
    'age' => null,
    'growth' => null,
    'list_fruit' => 'яблоко', 'апельсин', 'груша',

];


if ( isset($_POST['is_agree']) ) {
    // создание юзера
    $user = [
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'password' => $_POST['password'],
        'sex' => $_POST['sex'],
        'age' => (int)$_POST['age'],
        'growth' => $_POST['growth'],
        'list_fruit' => 'яблоко', 'апельсин', 'груша',
        //'stack_learn' => $_POST['stack_learn'],
    ];
    if (isset($_POST['stack_learn'])) {
        $user['stack_learn'] = $_POST['stack_learn'];
    }

    $jsonUser = json_encode($user, JSON_UNESCAPED_UNICODE);
    $objUser = json_decode($jsonUser);
    $test = serialize(12);

    var_dump($jsonUser);
    var_dump($objUser->firstname);
    var_dump(json_decode($jsonUser));
    var_dump($objUser);
    var_dump(serialize($objUser));
    var_dump(unserialize($test));
    die();

    if (isset($_FILES['photo']) && empty($_FILES['photo']['error'] )) {
        $uploadPath = UPLOAD_DIR . 'photo/';
        createPath($uploadPath);
        move_uploaded_file($_FILES['photo']['tmp_name'], $uploadPath . uniqid(). '.png');
    }
   // var_dump($_FILES);
   // die();

//    var_dump(getFullName($user));

//    var_dump($user);
//    var_dump(array_keys($user));
//    die();

    if ($user['age'] > 18) {
        echo 'Этот пользователь достаточно взрослый';
    } elseif ($user['age'] == 18) {
        echo 'Этому пользователю 18 лет';
    } else {
        echo 'Этот пользователь НЕ достаточно хорош';
    }

    // Валидация
    If (strlen($user['firstname']) < 3 || strlen($user['lastname']) < 3 ) {
        $errorMessage[] = 'Имя и Фамилия не должны быть короче 3х символов';
    }

    If ( !(in_array( 'html', $user['stack_learn']) && in_array('php', $user['stack_learn'])) ) {
        $errorMessage[] = 'Требуется html и php' ;
    }
}


//    $string = 'Hello world';
//    $result = substr($string, 0, 5);
//    var_dump($result);
//    die();


?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SkillUP | Регистрация</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>


<?php if ($error_message) { ?>
    <?php foreach ($errorMessage as $message) { ?>
        <div class="alert alert-danger" role="alert">
            Ошибка
        </div>
    <?php } ?>
<?php } ?>


<?php if (isset($user['stack_learn'])) { ?>
    <h3>Мы изучаем</h3>

    <ul>
        <?php foreach ($user['stack_learn'] as $lang) { ?>

            <li><?= $lang ?></li>
        <?php } ?>

    </ul>
    <h3>Мы изучаем: <?= implode(',' , $user['stack_learn']) ?> </h3>

    <h3>Наши фрукты</h3>
    <ul>
        <?php foreach (explode(',', $user['list_fruit']) as $key => $fruit) { ?>

            <li><?= $fruit ?></li>
        <?php } ?>

    </ul>

<?php } ?>



<div class="container-fluid jumbotron col-md-offset-4 col-md-5">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="firstname">Имя</label>
            <input class="form-control" id="firstname" name="firstname" placeholder="Имя" required>
            // value=
        </div>
        <div class="form-group">
            <label for="lastname">Фамилия</label>
            <input class="form-control" id="lastname" name="lastname" placeholder="Фамилия" required>
        </div>
        <div class="form-group">
            <label for="password" class="control-label">Пароль</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Пароль">
        </div><div class="form-group">
            <label for="photo" class="control-label">Фото</label>
            <input type="file" class="form-control" name="photo" id="photo" placeholder="Фото">
        </div>
        <div class="form-group">
            <label for="password" class="control-label">Пол:</label>
            <label class="radio-inline">
                <input type="radio" name="sex" id="male" value="0" checked> Мужской
            </label>
            <label class="radio-inline">
                <input type="radio" name="sex" id="female" value="1"> Женский
            </label>
        </div>
        <div class="form-group">
            <label for="age" class="control-label">Возраст</label>
            <input class="form-control" id="age" name="age" value="18">
        </div>
        <div class="form-group">
            <label for="growth" class="control-label">Возраст</label>
            <input class="form-control" id="growth" name="growth" value="175.6">
        </div>
        <div class="form-group">
            <label for="stack-learn" class="control-label">Что вы изучаете?</label>

            <div class="checkbox">
                <label><input type="checkbox" name="stack_learn[]" value="html" checked> HTML</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="stack_learn[]" value="css" checked> CSS</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="stack_learn[]" value="php"> PHP</label>
            </div>
            <div class="checkbox disabled">
                <label><input type="checkbox" name="stack_learn[]" value="mysql" disabled> MySQL</label>
            </div>

        </div>
        <div class="checkbox">
            <label><input type="checkbox" name="is_agree" value="1" required> Условия соглашения</label>
        </div>
        <button class="btn btn-primary">Зарегистрироваться</button>
    </form>
</div>

</body>
</html>