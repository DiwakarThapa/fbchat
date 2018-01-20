<?php
$access_token="EAAd8XDhzpuQBAD5xpAZAIZCbQleqoOs09MaH5mGh1E2zjtaufBdgFxI2jZBjG12ziAR3an5KlROpWhvaGgJyWIttNVoAxH1a7AC6h9ZCVWDEPTQz2pZBxr9yv0cig4t5W53qYjZBe62GdL0ZC5i1qhTmxAPA2ZCgZBIAUBGBKhzkMuwZDZD";

$verify_token="facebookbot";
$hub_verify_token=null;
if(isset($_REQUEST['hub_mode']) && $_REQUEST['hub_mode']=='subscribe'){
$challenge=$_REQUEST['hub_challenge'];
$hub_verify_token=$_REQUEST['hub_verify_token'];
if($hub_verify_token==$verify_token){
    header('HTTP/1.1 200 OK');
    echo $challenge;
    die;

}
}
$input=json_decode(file_get_contents('php://input'),true);
$sender=$input['entry'][0]['messaging'][0]['sender']['id'];
$message=isset($input['entry'][0]['messaging'][0]['message']['text'])? $input['entry'][0]['messaging'][0]['message']['text']:'';
if($message){
    $message_to_reply="this is sastosaman";
    $url="https://graph.facebook.com/v2.8/messages?access_token".$access_token;
    $jasonData='[
    "recipient":(
"id":"'.$sender.'"
    ),
    "message":(
"text":"'.$message_to_reply'"
    )
    ]';
$ch=curl_init($url);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,$jasonData);
curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type:application/json'));
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
$result=curl_exec($ch);
curl_close($ch);


}

?>
