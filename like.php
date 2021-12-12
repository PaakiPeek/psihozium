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


$token_telega = 'token_telega';



function makeHTTPRequest($method,$datas=[]){
    $url = "https://api.telegram.org/bot".$token_telega."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($datas));
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}


 $data = file_get_contents('php://input');
 $update = json_decode($data, true);

if($update['message']['text'] == "/start"){
    $chat_id = $update['message']['from']['id']; // ид пользователя кто написал

    makeHTTPRequest('sendMessage',[
        'chat_id'=>$update['message']['from']['id'],
        'text'=> '123',
        'parse_mode'=>'HTML',
    ]); 
}



// АВТОПОСТИНГ С КНОПКОЙ ЛАЙКА


if(isset($update['inline_query'])){
    $chat_id = $update['inline_query']['from']['id'];
    makeHTTPRequest('sendMessage',[
        'chat_id'=>"@testt12",
        'text'=>json_encode($update),
        'parse_mode'=>'HTML',
    ]);
    $inlineQueryID = $update['inline_query']['id'];
    makeHTTPRequest('answerInlineQuery',[
        'inline_query_id'=>$inlineQueryID,
        'results' => json_encode([[
            'type' => 'article',
            'id' => base64_encode(1),
            'title' => 'Send?',
            'input_message_content' => ['parse_mode' => 'HTML', 'message_text' => $update['inline_query']['query']],
            'reply_markup' => [
                'inline_keyboard'=>[
                    [
                        ['text'=> "",'callback_data'=>'like']
                    ]
                ]]
        ]])
    ]);
}





if(isset($update['callback_query']) && $update['callback_query']['data']=="like"){
    $alert = "Кол-во лайков ❤ :)";
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




// для проверки если в базе данная модель
$sqlwhere = mysqli_query($db, "SELECT * FROM `likepost` WHERE `user_like` = '".$user_like."'");
$row_test = mysqli_fetch_assoc($sqlwhere); 
$user_likeif = $row_test["user_like"]; // для проверки если в базе данная модель её ид но можно брать любую строчку не пустую

    // проверяем на наличие лайка в базе
    if ($user_likeif) { // проверяет на пустое значение , если истино то добавляем товар в нащи базы
        $alert = "Вы уже лайкали этот пост";
    } else {
        
    // Заносим лайк в базу отдельной строчкой
    $user_like = $callBackQueryMessageID.$userID;
    $sql_like = mysqli_query($db, "INSERT INTO likepost(chat_id,query_id,message_id,user_id,user_like) VALUES('".$callBackQueryChatID."','".$callBackQueryID."','".$callBackQueryMessageID."','".$userID."','".$user_like."') ON DUPLICATE KEY UPDATE user_like='$user_like'") or die("Query failed model: " . mysqli_error($db));
            
        
        // ПОДСЧИТАТЬ ЛАЙКИ
        $st= $pdo->prepare("select count(*) as like_count from likes where message_id=:message_id");
        $st->bindParam(":message_id", $callBackQueryMessageID);
        $st->execute();
        
// Выполняем запрос. Если произойдет ошибка - вывести ее. 
$res_post = mysqli_query($db, "SELECT * FROM `likepost`") or die(mysql_error());


$like_count_post = 0;
while ($row_post = mysqli_fetch_array($res_post)) {
$post_like = $row_post['message_id']; // для получения постов
if ($post_like == $callBackQueryMessageID) { // сравнение с постом
$like = $num + 1;
}
}

 $like_count =  $like_count_post + 1; // добавляем лайк


        if(intval($like_count) < 10){
            $likes = str_repeat('❤',$like_count);
        }
        else{
            $likes = $like_count . ' ' . '❤';
        }
        
        
        makeHTTPRequest("editMessageReplyMarkup",[
            'inline_message_id' => $callBackQueryMessageID,
            'reply_markup' => json_encode([
                'inline_keyboard'=>[
                    [
//                    ['text'=> $like_count . '  ❤','callback_data'=>'like']
                      ['text'=> $likes,'callback_data'=>'like']
                    ]
                ]]),
        ]);
    }
    makeHTTPRequest("answerCallbackQuery", [
        'callback_query_id' => $callBackQueryID,
        'text' => $alert,
//      'show_alert' => true,
    ] );

}



?>