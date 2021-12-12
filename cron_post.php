<?php
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


#Рандом смайлов лайков
$smiles3 = array("❤", "💙", "💜", "🖤");
$rand3 = rand(0,count($smiles3) - 1);  
$str3 = $smiles3[$rand3];   



function makeHTTPRequest($method,$datas=[]) {
  $botToken="token_telega";

  $website="https://api.telegram.org/bot".$botToken;
  $chatId= 1366890829;  //** ===>>>NOTE: this chatId MUST be the chat_id of a person, NOT another bot chatId !!!**

  $ch = curl_init($website.'/'.$method);
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, ($datas));
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($ch);
  curl_close($ch);
}


 $data = file_get_contents('php://input');
 $update = json_decode($data, true);


// УДАЛЕНИЕ ИЗ БАЗЫ СТАТЬИ
$massagedel = $update['message']['text'];
// Постинг
if(substr($massagedel, 0, 19) == "https://telegra.ph/" && $update['message']['from']['id'] == "1366890829"){
    
$query1 = mysqli_query($db, "DELETE FROM psifull WHERE telegraph = '$massagedel'");    
$query2 = mysqli_query($db, "DELETE FROM psiotnosh WHERE telegraph = '$massagedel'");      
$query3 = mysqli_query($db, "DELETE FROM psistory WHERE telegraph = '$massagedel'"); 
$query3 = mysqli_query($db, "DELETE FROM psisam WHERE telegraph = '$massagedel'"); 

    makeHTTPRequest('sendMessage',[
        'chat_id'=>$update['message']['from']['id'],
        'text'=> 'Удаление статьи из баз произошло успешно',
        'parse_mode'=>'HTML',
    ]);
}

if($update['message']['text'] == "/start" && $update['message']['from']['id'] == "1366890829"){
    $chat_id = $update['message']['from']['id']; // ид пользователя кто написал



    makeHTTPRequest('sendMessage',[
        'chat_id'=>$update['message']['from']['id'],
        'text'=> 'Клавиатура появилась',
        'parse_mode'=>'HTML',
'reply_markup'=>json_encode([
          'keyboard'=>[
            [
                ['text'=>'Основная'],['text'=>'Стори']
            ],
            [
                ['text'=>'Саморазвитие'],['text'=>'Отношения']
            ],
          ]
      ])
    ]);





/*
    makeHTTPRequest('sendPhoto',[
        'chat_id'=>$update['message']['from']['id'],
        'caption'=> '<b>1223</b>',
        'photo'=> 'https://www.wikihow.com/images/thumb/f/fc/Get-the-URL-for-Pictures-Step-1-Version-6.jpg/v4-728px-Get-the-URL-for-Pictures-Step-1-Version-6.jpg.webp',
        'parse_mode'=>'HTML',
            'reply_markup' => json_encode([
                'inline_keyboard'=>[
                    [
                      ['callback_data' => 'like', 'text' => $str3],
                      ['url' => 'tg://resolve?domain=psihozium_chat', 'text' => '💬'],
                    ]
                ]]),
    ]); 
        
*/   


}






// Для добавления статей ОСНОВНАЯ
if($update['message']['text'] == "Основная" && $update['message']['from']['id'] == "1366890829") {


// Выполняем запрос. Если произойдет ошибка - вывести ее. 
$res = mysqli_query($db, "SELECT * FROM `psifull`") or die(mysql_error());
// Узнаем количество записей в базе данных 
$row = mysqli_num_rows($res);


$num = 0; // начало для 1 поста
while ($row = mysqli_fetch_array($res)) {

$idbaz = $row['id']; // url психо для обновления
$url = $row['url']; // url психо для обновления
$checkurl = $row['checkurl']; // для проверки на паблиш
$title = $row['title']; // название статьи
$annotation = $row['annotation']; // описание статьи
$post_img = $row['post_img']; // картинка
$telegraph = $row['telegraph']; // телеграф ссылка



if ($checkurl != 1) { //  1 проверка был ли опубликован пост
if($num < 3)   { // проверка для поста

makeHTTPRequest('sendMessage',[
'chat_id'=>$update['message']['from']['id'],
'text'=> '<b>'.$title.'</b>

<i>«'.$annotation.'»</i>

'.$telegraph.'
',
        'parse_mode'=>'HTML',
            'reply_markup' => json_encode([
                'inline_keyboard'=>[
                    [
                      ['callback_data' => 'pone_'.$idbaz, 'text' => '✅'],
					  ['callback_data' => 'hide1_'.$idbaz, 'text' => '⚠'],
					  ['callback_data' => 'dell1_'.$idbaz, 'text' => '❌'],

                    ]
                ]]),
]);  
$num = $num + 1; 
}

}

}




}










// АВТОПОСТИНГ ДЛЯ ОТНОШЕНИЙ


// Для добавления статей Отношения
if($update['message']['text'] == "Отношения" && $update['message']['from']['id'] == "1366890829"){

// Выполняем запрос. Если произойдет ошибка - вывести ее. 
$res = mysqli_query($db, "SELECT * FROM `psiotnosh`") or die(mysql_error());
// Узнаем количество записей в базе данных 
$row = mysqli_num_rows($res);


$num = 0; // начало для 1 поста
while ($row = mysqli_fetch_array($res)) {

$idbaz = $row['id']; // url психо для обновления
$url = $row['url']; // url психо для обновления
$checkurl = $row['checkurl']; // для проверки на паблиш
$title = $row['title']; // название статьи
$annotation = $row['annotation']; // описание статьи
$post_img = $row['post_img']; // картинка
$telegraph = $row['telegraph']; // телеграф ссылка



if ($checkurl != 1) { //  1 проверка был ли опубликован пост
if($num < 3)   { // проверка для поста

makeHTTPRequest('sendMessage',[
'chat_id'=>$update['message']['from']['id'],
'text'=> '<b>'.$title.'</b>

<i>«'.$annotation.'»</i>

'.$telegraph.'
',
        'parse_mode'=>'HTML',
            'reply_markup' => json_encode([
                'inline_keyboard'=>[
                    [
                      ['callback_data' => 'ptwo_'.$idbaz, 'text' => '✅'],
					  ['callback_data' => 'hide2_'.$idbaz, 'text' => '⚠'],
					  ['callback_data' => 'dell2_'.$idbaz, 'text' => '❌'],

                    ]
                ]]),
]);  
$num = $num + 1; 
}

}

}



    
}








// Для добавления статей Стори

if($update['message']['text'] == "Стори" && $update['message']['from']['id'] == "1366890829"){


// Выполняем запрос. Если произойдет ошибка - вывести ее. 
$res = mysqli_query($db, "SELECT * FROM `psistory`") or die(mysql_error());
// Узнаем количество записей в базе данных 
$row = mysqli_num_rows($res);


$num = 0; // начало для 1 поста
while ($row = mysqli_fetch_array($res)) {

$idbaz = $row['id']; // url психо для обновления
$url = $row['url']; // url психо для обновления
$checkurl = $row['checkurl']; // для проверки на паблиш
$title = $row['title']; // название статьи
$annotation = $row['annotation']; // описание статьи
$post_img = $row['post_img']; // картинка
$telegraph = $row['telegraph']; // телеграф ссылка



if ($checkurl != 1) { //  1 проверка был ли опубликован пост
if($num < 3)   { // проверка для поста

makeHTTPRequest('sendMessage',[
'chat_id'=>$update['message']['from']['id'],
'text'=> '<b>'.$title.'</b>

<i>«'.$annotation.'»</i>

'.$telegraph.'
',
        'parse_mode'=>'HTML',
            'reply_markup' => json_encode([
                'inline_keyboard'=>[
                    [
                      ['callback_data' => 'ptri_'.$idbaz, 'text' => '✅'],
					  ['callback_data' => 'hide3_'.$idbaz, 'text' => '⚠'],
					  ['callback_data' => 'dell3_'.$idbaz, 'text' => '❌'],

                    ]
                ]]),
]);  
$num = $num + 1; 
}

}

}



}








// АВТОПОСТИНГ ДЛЯ САМОРАЗВИТИЯ


// Для добавления статей Саморазвитие
if($update['message']['text'] == "Саморазвитие" && $update['message']['from']['id'] == "1366890829"){


// Выполняем запрос. Если произойдет ошибка - вывести ее. 
$res = mysqli_query($db, "SELECT * FROM `psisam`") or die(mysql_error());
// Узнаем количество записей в базе данных 
$row = mysqli_num_rows($res);


$num = 0; // начало для 1 поста
while ($row = mysqli_fetch_array($res)) {

$idbaz = $row['id']; // url психо для обновления
$url = $row['url']; // url психо для обновления
$checkurl = $row['checkurl']; // для проверки на паблиш
$title = $row['title']; // название статьи
$annotation = $row['annotation']; // описание статьи
$post_img = $row['post_img']; // картинка
$telegraph = $row['telegraph']; // телеграф ссылка



if ($checkurl != 1) { //  1 проверка был ли опубликован пост
if($num < 3)   { // проверка для поста

makeHTTPRequest('sendMessage',[
'chat_id'=>$update['message']['from']['id'],
'text'=> '<b>'.$title.'</b>

<i>«'.$annotation.'»</i>

'.$telegraph.'
',
        'parse_mode'=>'HTML',
            'reply_markup' => json_encode([
                'inline_keyboard'=>[
                    [
                      ['callback_data' => 'pche_'.$idbaz, 'text' => '✅'],
					  ['callback_data' => 'hide4_'.$idbaz, 'text' => '⚠'],
					  ['callback_data' => 'dell4_'.$idbaz, 'text' => '❌'],

                    ]
                ]]),
]);  
$num = $num + 1; 
}

}

}



}














/*
                      ['callback_data' => 'like', 'text' => $like_count.' ❤'],
                      ['url' => 'tg://resolve?domain=psihozium_chat', 'text' => '💬'],
*/



// ДЛЯ УДАЛЕНИЯ ИЗ БАЗЫ СТАТЬИ
if(isset($update['callback_query']) && substr($update['callback_query']['data'], 0 , 4) == "dell"){
	
$delbaza =  substr($update['callback_query']['data'], 4 , 1); // проверяем к какой базе пренадлежит  dell2_777

if($delbaza == 1){
$delpost = substr($update['callback_query']['data'], 6); 
// для проверки если в базе данная модель
$sqlwhere = mysqli_query($db, "SELECT * FROM `psifull` WHERE `id` = '".$delpost."'");
$row = mysqli_fetch_assoc($sqlwhere); 
$idtelegraph = $row["telegraph"]; // для проверки

$query1 = mysqli_query($db, "DELETE FROM psifull WHERE telegraph = '$idtelegraph'");    
$query2 = mysqli_query($db, "DELETE FROM psiotnosh WHERE telegraph = '$idtelegraph'");      
$query3 = mysqli_query($db, "DELETE FROM psistory WHERE telegraph = '$idtelegraph'"); 
$query3 = mysqli_query($db, "DELETE FROM psisam WHERE telegraph = '$idtelegraph'"); 	
}

if($delbaza == 2){
// для проверки если в базе данная модель
$delpost = substr($update['callback_query']['data'], 6); 
$sqlwhere = mysqli_query($db, "SELECT * FROM `psiotnosh` WHERE `id` = '".$delpost."'");
$row = mysqli_fetch_assoc($sqlwhere); 
$idtelegraph = $row["telegraph"]; // для проверки

$query1 = mysqli_query($db, "DELETE FROM psifull WHERE telegraph = '$idtelegraph'");    
$query2 = mysqli_query($db, "DELETE FROM psiotnosh WHERE telegraph = '$idtelegraph'");      
$query3 = mysqli_query($db, "DELETE FROM psistory WHERE telegraph = '$idtelegraph'"); 
$query3 = mysqli_query($db, "DELETE FROM psisam WHERE telegraph = '$idtelegraph'"); 		
}


if($delbaza == 3){
// для проверки если в базе данная модель
$delpost = substr($update['callback_query']['data'], 6); 
$sqlwhere = mysqli_query($db, "SELECT * FROM `psistory` WHERE `id` = '".$delpost."'");
$row = mysqli_fetch_assoc($sqlwhere); 
$idtelegraph = $row["telegraph"]; // для проверки

$query1 = mysqli_query($db, "DELETE FROM psifull WHERE telegraph = '$idtelegraph'");    
$query2 = mysqli_query($db, "DELETE FROM psiotnosh WHERE telegraph = '$idtelegraph'");      
$query3 = mysqli_query($db, "DELETE FROM psistory WHERE telegraph = '$idtelegraph'"); 
$query3 = mysqli_query($db, "DELETE FROM psisam WHERE telegraph = '$idtelegraph'"); 	
}

if($delbaza == 4){
// для проверки если в базе данная модель
$delpost = substr($update['callback_query']['data'], 6); 
$sqlwhere = mysqli_query($db, "SELECT * FROM `psisam` WHERE `id` = '".$delpost."'");
$row = mysqli_fetch_assoc($sqlwhere); 
$idtelegraph = $row["telegraph"]; // для проверки

$query1 = mysqli_query($db, "DELETE FROM psifull WHERE telegraph = '$idtelegraph'");    
$query2 = mysqli_query($db, "DELETE FROM psiotnosh WHERE telegraph = '$idtelegraph'");      
$query3 = mysqli_query($db, "DELETE FROM psistory WHERE telegraph = '$idtelegraph'"); 
$query3 = mysqli_query($db, "DELETE FROM psisam WHERE telegraph = '$idtelegraph'"); 		
}

// отправка сообщения об удалении

    makeHTTPRequest('sendMessage',[
        'chat_id'=> $update['callback_query']['from']['id'],
        'text'=> 'Удаление статьи из баз произошло успешно',
        'parse_mode'=>'HTML',
    ]);
	
}
// УДАЛЕНИЕ ПРОШЛО УСПЕШНО 




// ДЛЯ СКРЫТИЯ ИЗ БАЗЫ СТАТЬИ 
if(isset($update['callback_query']) && substr($update['callback_query']['data'], 0 , 4) == "hide"){

$hidebaza =  substr($update['callback_query']['data'], 4 , 1); // проверяем к какой базе пренадлежит  dell2_777

if($hidebaza == 1){
$hidepost = substr($update['callback_query']['data'], 6); 
mysqli_query($db, "UPDATE `psifull` SET `checkurl`='1' WHERE id='".$hidepost."'") or die("Query failed model: " . mysqli_error());  
}

if($hidebaza == 2){
$hidepost = substr($update['callback_query']['data'], 6); 
mysqli_query($db, "UPDATE `psiotnosh` SET `checkurl`='1' WHERE id='".$hidepost."'") or die("Query failed model: " . mysqli_error());  
}

if($hidebaza == 3){
$hidepost = substr($update['callback_query']['data'], 6); 
mysqli_query($db, "UPDATE `psistory` SET `checkurl`='1' WHERE id='".$hidepost."'") or die("Query failed model: " . mysqli_error());  
}

if($hidebaza == 4){
$hidepost = substr($update['callback_query']['data'], 6); 
mysqli_query($db, "UPDATE `psisam` SET `checkurl`='1' WHERE id='".$hidepost."'") or die("Query failed model: " . mysqli_error());  
}

// отправка сообщения об удалении

    makeHTTPRequest('sendMessage',[
        'chat_id'=> $update['callback_query']['from']['id'],
        'text'=> 'Мы скрыли статью из базы',
        'parse_mode'=>'HTML',
    ]);	
}



// ДЛЯ ПУБЛИКАЦИИ ПОСТОВ В ОПРЕДЕЛЕННУЮ ГРУППУ
if(isset($update['callback_query']) && substr($update['callback_query']['data'], 0 , 4) == "pone"){
$postbaza =  substr($update['callback_query']['data'], 5); // проверяем какой ид публиковать

// для проверки если в базе данная модель
$sqlwhere = mysqli_query($db, "SELECT * FROM `psifull` WHERE `id` = '".$postbaza."'");
$row = mysqli_fetch_assoc($sqlwhere); 

$url = $row['url']; // url психо для обновления
$checkurl = $row['checkurl']; // для проверки на паблиш
$title = $row['title']; // название статьи
$annotation = $row['annotation']; // описание статьи
$post_img = $row['post_img']; // картинка
$telegraph = $row['telegraph']; // телеграф ссылка


if (empty($annotation)) {
// ПОСТИМ ТЕКСТОМ ЕСЛИ НЕТ АНАТАЦИИ 


makeHTTPRequest('sendMessage',[
        'chat_id'=> '@psihozium',
'text'=> '<b>'.$title.'</b>

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


// обновляем значение  в базе 
mysqli_query($db, "UPDATE `psifull` SET `checkurl`='1' WHERE url='".$url."'") or die("Query failed model: " . mysqli_error());   


} else {
    
    
// ИЗОБРАЖЕНИЕ ЕСЛИ НЕТ В БАЗЕ , ТО БЕРЕМ КАРТИНКУ ИЗ ИНТЕРНЕТА 
if (empty($post_img)) {
$rndomg = rand(1, 14);
$img = $rndomg.".jpg";
} else {
$img = $post_img;    
}


 makeHTTPRequest('sendPhoto',[
        'chat_id'=> '@psihozium',
'caption'=> '<b>'.$title.'</b>

<i>«'.$annotation.'»</i>

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
        





// обновляем значение  в базе 
mysqli_query($db, "UPDATE `psifull` SET `checkurl`='1' WHERE url='".$url."'") or die("Query failed model: " . mysqli_error());   
$num = $num + 1;  

} // АНАТАЦИИ НЕТ КОНЕЦ

}



// ПЕРВАЯ КОНЕЦ


// ВТОРАЯ НАЧАЛО

if(isset($update['callback_query']) && substr($update['callback_query']['data'], 0 , 4) == "ptwo"){

// для проверки если в базе данная модель
$sqlwhere = mysqli_query($db, "SELECT * FROM `psiotnosh` WHERE `id` = '".$postbaza."'");
$row = mysqli_fetch_assoc($sqlwhere); 

$url = $row['url']; // url психо для обновления
$checkurl = $row['checkurl']; // для проверки на паблиш
$title = $row['title']; // название статьи
$annotation = $row['annotation']; // описание статьи
$post_img = $row['post_img']; // картинка
$telegraph = $row['telegraph']; // телеграф ссылка



if (empty($annotation)) {
// ПОСТИМ ТЕКСТОМ ЕСЛИ НЕТ АНАТАЦИИ 

makeHTTPRequest('sendMessage',[
        'chat_id'=> '@psythread',
'text'=> '<b>'.$title.'</b>

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


// обновляем значение  в базе 
mysqli_query($db, "UPDATE `psiotnosh` SET `checkurl`='1' WHERE url='".$url."'") or die("Query failed model: " . mysqli_error());   


} else {
    
    
// ИЗОБРАЖЕНИЕ ЕСЛИ НЕТ В БАЗЕ , ТО БЕРЕМ КАРТИНКУ ИЗ ИНТЕРНЕТА 
if (empty($post_img)) {
$rndomg = rand(1, 14);
$img = $rndomg.".jpg";
} else {
$img = $post_img;    
}    


 makeHTTPRequest('sendPhoto',[
        'chat_id'=> '@psythread',
'caption'=> '<b>'.$title.'</b>

<i>«'.$annotation.'»</i>

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
        





// обновляем значение  в базе 
mysqli_query($db, "UPDATE `psiotnosh` SET `checkurl`='1' WHERE url='".$url."'") or die("Query failed model: " . mysqli_error());   

} // АНАТАЦИИ НЕТ КОНЕЦ

	
}

// ВТОРАЯ КОНЕЦ




// ТРЕТИЯ НАЧАЛО 
if(isset($update['callback_query']) && substr($update['callback_query']['data'], 0 , 4) == "ptri"){

// АВТОПОСТИНГ ДЛЯ СТОРИ

// для проверки если в базе данная модель
$sqlwhere = mysqli_query($db, "SELECT * FROM `psistory` WHERE `id` = '".$postbaza."'");
$row = mysqli_fetch_assoc($sqlwhere); 


$url = $row['url']; // url психо для обновления
$checkurl = $row['checkurl']; // для проверки на паблиш
$title = $row['title']; // название статьи
$annotation = $row['annotation']; // описание статьи
$post_img = $row['post_img']; // картинка
$telegraph = $row['telegraph']; // телеграф ссылка


if (empty($annotation)) {
// ПОСТИМ ТЕКСТОМ ЕСЛИ НЕТ АНАТАЦИИ 


makeHTTPRequest('sendMessage',[
        'chat_id'=> '@ncuxo_FM',
'text'=> '<b>'.$title.'</b>

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


// обновляем значение  в базе 
mysqli_query($db, "UPDATE `psistory` SET `checkurl`='1' WHERE url='".$url."'") or die("Query failed model: " . mysqli_error());   


} else {

// ИЗОБРАЖЕНИЕ ЕСЛИ НЕТ В БАЗЕ , ТО БЕРЕМ КАРТИНКУ ИЗ ИНТЕРНЕТА 
if (empty($post_img)) {

makeHTTPRequest('sendMessage',[
        'chat_id'=> '@ncuxo_FM',
'text'=> '<b>'.$title.'</b>

<i>'.$annotation.'</i>

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


// обновляем значение  в базе 
mysqli_query($db, "UPDATE `psistory` SET `checkurl`='1' WHERE url='".$url."'") or die("Query failed model: " . mysqli_error());   



} else {
    


$img = $post_img;
 makeHTTPRequest('sendPhoto',[
'chat_id'=> '@ncuxo_FM',
'caption'=> '<b>'.$title.'</b>

<i>'.$annotation.'</i>

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
        





// обновляем значение  в базе 
mysqli_query($db, "UPDATE `psistory` SET `checkurl`='1' WHERE url='".$url."'") or die("Query failed model: " . mysqli_error());   
}    


} // АНАТАЦИИ НЕТ КОНЕЦ
	
}
// ТРЕТИЯ КОНЕЦ



// ЧЕТВЕРТАЯ НАЧАЛО 
if(isset($update['callback_query']) && substr($update['callback_query']['data'], 0 , 4) == "pche"){

// для проверки если в базе данная модель
$sqlwhere = mysqli_query($db, "SELECT * FROM `psisam` WHERE `id` = '".$postbaza."'");
$row = mysqli_fetch_assoc($sqlwhere); 

$url = $row['url']; // url психо для обновления
$checkurl = $row['checkurl']; // для проверки на паблиш
$title = $row['title']; // название статьи
$annotation = $row['annotation']; // описание статьи
$post_img = $row['post_img']; // картинка
$telegraph = $row['telegraph']; // телеграф ссылка




if (empty($annotation)) {
// ПОСТИМ ТЕКСТОМ ЕСЛИ НЕТ АНАТАЦИИ 


makeHTTPRequest('sendMessage',[
        'chat_id'=> '@psypuzzle',
'text'=> '<b>'.$title.'</b>

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


// обновляем значение  в базе 
mysqli_query($db, "UPDATE `psisam` SET `checkurl`='1' WHERE url='".$url."'") or die("Query failed model: " . mysqli_error());   


} else {


// ИЗОБРАЖЕНИЕ ЕСЛИ НЕТ В БАЗЕ , ТО БЕРЕМ КАРТИНКУ ИЗ ИНТЕРНЕТА 
if (empty($post_img)) {
$rndomg = rand(1, 14);
$img = $rndomg.".jpg"; // добавление рандом фото если нет его
} else {
$img = $post_img;    
}    





 makeHTTPRequest('sendPhoto',[
        'chat_id'=> '@psypuzzle',
'caption'=> '<b>'.$title.'</b>

<i>«'.$annotation.'»</i>

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
        





// обновляем значение  в базе 
mysqli_query($db, "UPDATE `psisam` SET `checkurl`='1' WHERE url='".$url."'") or die("Query failed model: " . mysqli_error());   


} // АНАТАЦИИ НЕТ КОНЕЦ

	
}
// ЧЕТВЕРТАЯ КОНЕЦ

if(isset($update['callback_query']) && $update['callback_query']['data']=="like"){
    $callBackQueryID = $update['callback_query']['id'];
    $callBackQueryChatID = $update['callback_query']['message']['chat']['id'];
    if($callBackQueryChatID == ""){ //inline callbackquery
        $callBackQueryChatID = $update['callback_query']['from']['id'];
    }
    
    $callBackQueryMessageID = $update['callback_query']['message']['message_id'];
    if($callBackQueryMessageID==""){
        $callBackQueryMessageID = $update['callback_query']['inline_message_id'];
    }

    $userID = $update['callback_query']['from']['id'];
    $firstName = $update['callback_query']['from']['first_name'];
    $lastName = $update['callback_query']['from']['last_name'];
    $userName = $update['callback_query']['from']['username'];


    $user_like = $callBackQueryChatID.$callBackQueryMessageID.$userID;

// для проверки если в базе данная модель
$sqlwhere = mysqli_query($db, "SELECT * FROM `likepost` WHERE `user_like` = '".$user_like."'");
$row_test = mysqli_fetch_assoc($sqlwhere); 
$user_likeif = $row_test["user_like"]; // для проверки если в базе данная модель её ид но можно брать любую строчку не пустую

    // проверяем на наличие лайка в базе
    if ($user_likeif) { // проверяет на пустое значение , если истино то добавляем товар в нащи базы
        $alert = "Вы уже лайкали этот пост";
    } else {
        
    // Заносим лайк в базу
    $sql_like = mysqli_query($db, "INSERT INTO likepost(chat_id,query_id,message_id,user_id,user_like) VALUES('".$callBackQueryChatID."','".$callBackQueryID."','".$callBackQueryMessageID."','".$userID."','".$user_like."') ON DUPLICATE KEY UPDATE user_like='$user_like',query_id='$callBackQueryID'") or die("Query failed model: " . mysqli_error($db));
            
        
        // ПОДСЧИТАТЬ ЛАЙКИ
        
// Выполняем запрос. Если произойдет ошибка - вывести ее. 
$res_post = mysqli_query($db, "SELECT * FROM `likepost`") or die(mysql_error());


$like_count_post = 0;
while ($row_post = mysqli_fetch_array($res_post)) {
$post_like = $row_post['chat_id'].$row_post['message_id']; // для получения постов с группы
if ($post_like == $callBackQueryChatID.$callBackQueryMessageID) { // сравнение с постом c группы
$like_count_post = $like_count_post + 1;
}
}

$like_count =  $like_count_post; // добавляем лайк

$alert = "Кол-во лайков ".$like_count." ❤ :)";

        
        
        makeHTTPRequest("editMessageReplyMarkup",[
            'chat_id' => $callBackQueryChatID,
            'message_id' => $callBackQueryMessageID,
            'reply_markup' => json_encode([
                'inline_keyboard'=>[
                    [
                      ['callback_data' => 'like', 'text' => '👐'],

                                            ['callback_data' => 'like', 'text' => '🙌'],
                                                                  ['callback_data' => 'like', 'text' => '✨'],
                                                                                        ['callback_data' => 'like', 'text' => '😍'],
                                                                                                              ['callback_data' => 'like', 'text' => '👍'],                      ['callback_data' => 'like', 'text' => '✨'],

                                            ['callback_data' => 'like', 'text' => '🙌'],
                                                                  ['callback_data' => 'like', 'text' => '👐'],

                    ]
                ]]),
        ]);
        
sleep(1);

            makeHTTPRequest("editMessageReplyMarkup",[
            'chat_id' => $callBackQueryChatID,
            'message_id' => $callBackQueryMessageID,
            'reply_markup' => json_encode([
                'inline_keyboard'=>[
                    [
                      ['callback_data' => 'like', 'text' => $like_count.' '.$str3],
                      ['url' => 'tg://resolve?domain=psihozium_chat', 'text' => '💬'],
                    ]
                ]]),
        ]);
        
        
        
    }
    
    

    
    
    
    makeHTTPRequest("answerCallbackQuery", [
        'callback_query_id' => $callBackQueryID,
        'text' => '',
  //      'show_alert' => true,
    ] );

}



?>