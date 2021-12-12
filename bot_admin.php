<?php

// ОСНОВА ТЕЛЕГА

#Рандом смайлов лайков
$smiles3 = array("❤", "💙", "💜", "🖤");
$rand3 = rand(0,count($smiles3) - 1);  
$str3 = $smiles3[$rand3];   

function makeHTTPRequest($method,$datas=[]){
  $botToken="token_telega";

  $website="https://api.telegram.org/bot".$botToken;
  $chatId= 1174258342;  //** ===>>>NOTE: this chatId MUST be the chat_id of a person, NOT another bot chatId !!!**

  $ch = curl_init($website.'/'.$method);
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, ($datas));
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($ch);
  curl_close($ch);
}
// ОСНОВА ТЕЛЕГА КОНЕЦ



// основа начало
//  подключаем нашу базу
define("DB_HOST", "localhost");
define("DB_USER", "db_user");
define("DB_PASS", "pass_ot_bd");
define("DB_NAME", "name_bd");
//Коннектимся к базе
$db = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die ("<p align=center><b>Не могу подключиться</b></p>");
mysqli_query($db, 'SET NAMES utf8') or die("Query failed model: " . mysqli_error($db));
// основа конец




// АВТОПОСТИНГ ДЛЯ ОСНОВНОЙ


// Выполняем запрос. Если произойдет ошибка - вывести ее. 
$res = mysqli_query($db, "SELECT * FROM `psifull`") or die(mysql_error());
// Узнаем количество записей в базе данных 
$row = mysqli_num_rows($res);


$num = 0; // начало для 1 поста
while ($row = mysqli_fetch_array($res)) {


$url = $row['url']; // url психо для обновления
$checkurl = $row['checkurl']; // для проверки на паблиш
$title = $row['title']; // название статьи
$annotation = $row['annotation']; // описание статьи
$post_img = $row['post_img']; // картинка
$telegraph = $row['telegraph']; // телеграф ссылка


if (empty($annotation)) {
// ПОСТИМ ТЕКСТОМ ЕСЛИ НЕТ АНАТАЦИИ 

if ($checkurl != 1) { //  1 проверка был ли опубликован пост
if($num < 1)   { // проверка для поста

makeHTTPRequest('sendMessage',[
        'chat_id'=> '@psihozium',
'text'=> '<b>'.$title.'</b>

Полная статья по ссылке:
'.$telegraph.'
',
        'parse_mode'=>'HTML',
            'reply_markup' => json_encode([
                'inline_keyboard'=>[
                    [
                      ['callback_data' => 'like', 'text' => $str3],
                      ['url' => 'tg://resolve?domain=psihozium_chat', 'text' => '💬'],
                    ]
                ]]),
    ]);  


// обновляем значение  в базе  ставим значение checkurl для того чтобы пост заново не отправился 
mysqli_query($db, "UPDATE `psifull` SET `checkurl`='1' WHERE url='".$url."'") or die("Query failed model: " . mysqli_error());   
$num = $num + 1;  

} 
}

} else {
    
    
// ИЗОБРАЖЕНИЕ ЕСЛИ НЕТ В БАЗЕ , ТО БЕРЕМ КАРТИНКУ ИЗ ИНТЕРНЕТА 
if (empty($post_img)) {
$rndomg = rand(1, 14);
$img = $rndomg.".jpg";
} else {
$img = $post_img;    
}    





if ($checkurl != 1) { //  1 проверка был ли опубликован пост
if($num < 1)   { // проверка для поста
// Публикуем 1 пост и помечаем его пройденым


 makeHTTPRequest('sendPhoto',[
        'chat_id'=> '@psihozium',
'caption'=> '<b>'.$title.'</b>

<i>«'.$annotation.'»</i>

Полная статья по ссылке:
'.$telegraph.'
',
        'photo'=> $img,
        'parse_mode'=>'HTML',
            'reply_markup' => json_encode([
                'inline_keyboard'=>[
                    [
                      ['callback_data' => 'like', 'text' => $str3],
                      ['url' => 'tg://resolve?domain=psihozium_chat', 'text' => '💬'],
                    ]
                ]]),
    ]); 
        





// обновляем значение  в базе  ставим значение checkurl для того чтобы пост заново не отправился 

mysqli_query($db, "UPDATE `psifull` SET `checkurl`='1' WHERE url='".$url."'") or die("Query failed model: " . mysqli_error()); 
$num = $num + 1;  

} 
}

} // АНАТАЦИИ НЕТ КОНЕЦ

}


?>