<h1>Hello World h1</h1>

<?php

define('SECOND_IN_DAY', 86400);
define('PROJECT_NAME', "SkillUp" );

$currentDate = time();
$yesterday = $currentDate - SECOND_IN_DAY*7;

echo $currentDate . "<br />";
echo date('d.m.Y H:i:s') . "<br />";
echo date('d.m.Y H:i:s', $yesterday);

require_once 'template.php'

?>

<p>Some text..  <?= $currentDate ?> </p>



<!DOCTYPE html>
<html>
<head>
    <?php require_once 'head.php'; ?>

</head>
<body>









<h4> Регистрация </h4>

<form action="template.php" method="POST">
    <label>Имя:</label>
    <div id="block_firstname" class="form-group">
        <input type="text" name="firtname">
    </div>
    <label>Фамилия:</label>

    <div class="form-group">
        <input type="text" name="lastname">
    </div>

    <label>Пароль:</label>
    <div class="form-group">
        <input type="text" name="password">
    </div>

    <label>Пол</label>
    <div>
        Муж<input type="checkbox" name="sex">
        Жен<input type="checkbox" name="sex">
    </div>

    <label>Курите</label>
    <div>
        да<input type="checkbox" name="smoke">
        нет<input type="checkbox" name="smoke">
    </div>

    <label>о себе:</label>
    <div>
        <textarea name="about" rows="3"> </textarea>
    </div>

    <label for="city">Город:</label>
    <div>
        <select name="city">
            <option>Москва</option>
            <option>СПб</option>
        </select>
    </div>

    <div>
        <button>Сохранить</button>
    </div>


</form>

</body>
</html>