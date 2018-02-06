<pre>

<?php

//Строка
$string = '5.6';
var_dump((float)$string);

//число
$integer = 5;
var_dump((bool)$integer);

//число с плавающей точкой
$float = 16.5876584;
var_dump($float);

//Булевое значение
$bool = true;
var_dump((string)$bool);


// Значение NULL
$null = null;
var_dump($null);

// Массив
$array = [
    'red',
    'green',
    'blue',
    'yellow',
    'new color' => [
        'black',
        'orange',
    ]
];
$array['new color'] = [
    'black',
];
var_dump($array);




// Ассоциативный массив
$user = [
    'name' => 'Vasya',
    'age' => 18,
    'grow' => 175.16,
    'is smoking' => false,
    'rate'=> [
        [
            'rate' => 3,
            'teacher' => 'Sidorova',
        ],
    ],
];
$user['rate'][] = [
    'rate' => 5,
    'teacher' => 'Ivanova',
];

$user['rate'][] = [
    'rate' => 4,
    'teacher' => 'Petrova',
];

var_dump($user);

var_dump(count($user['rate']));
var_dump(count($user));


?>
</pre>
