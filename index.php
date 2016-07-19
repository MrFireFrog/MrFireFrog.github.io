<?php

if (!empty($_COOKIE['sid'])) {
    session_id($_COOKIE['sid']);
}
session_start();
require_once 'classes/Auth.class.php';
$ip = ($_SERVER['REMOTE_ADDR']); 
if (!($ip == "127.0.0.1"||"94.241.221.197"))
{
echo "<center style='color:red;'>Доступ запрещен!";
exit();
}

?>
<?php 
if (Auth\User::isAuthorized()){ }else{include "login.php";exit;}?>
<?php 
$content =  implode ("", file ( 'history.php' ) );
?>
<!DOCTYPE HTML>
<html>
  
  <head>
  
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script type="text/javascript" src="common/js/form_init.js" data-name=""
    id="form_init_script">
    </script>
    <link rel="stylesheet" type="text/css" href="theme/default/css/default.css"
    id="theme" />
    <title>
      Instagram
    </title>
  </head>
  
  <body>
    <style>
   body {
    background: url(009.jpg) no-repeat;
    -moz-background-size: 100%; /* Firefox 3.6+ */
    -webkit-background-size: 100%; /* Safari 3.1+ и Chrome 4.0+ */
    -o-background-size: 100%; /* Opera 9.6+ */
    background-size: 100%; /* Современные браузеры */
		 position: fixed; top: 50%; left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);

   }
  </style>
    
	<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" id="docContainer" class="fb-toplabel fb-75-item-column selected-object"
    style="BACKGROUND-IMAGE: none; TOP: 0px; WebkitTransform: " enctype="multipart/form-data"
    
      <div id="fb-form-header1" class="fb-form-header" style="MIN-HEIGHT: 20px">
        <a id="fb-link-logo1" class="fb-link-logo" href="" target="_blank"><img id="fb-logo1" title="Alternative text" class="fb-logo" style="DISPLAY: none" alt="Alternative text" src="common/images/image_default.png"/></a>
      </div>
      <div id="section1" class="section">
        <div id="column1" class="column ui-sortable">
          <div id="fb_confirm_inline" style="MIN-HEIGHT: 256px; DISPLAY: none">
          </div>
          <div id="fb_error_report" style="DISPLAY: none">
          </div>
          <div id="item1" class="fb-item fb-100-item-column" style="POSITION: ; FILTER: none">
            <div class="fb-header fb-item-alignment-center">
              <h2 style="FONT-FAMILY: georgia; FONT-WEIGHT: bold; COLOR: #1a1d42; FONT-STYLE: italic; DISPLAY: inline">
                Instagram
              </h2>
            </div>
          </div>
          <div id="item2" class="fb-item fb-100-item-column">
            <div class="fb-grouplabel">
              <label id="item2_label_0" style="DISPLAY: inline">
                &#1057;&#1089;&#1099;&#1083;&#1082;&#1072; &#1085;&#1072; &#1092;&#1086;&#1090;&#1086;
                &#1074; &#1080;&#1085;&#1089;&#1090;&#1072;&#1075;&#1088;&#1072;&#1084;&#1077;:
              </label>
            </div>
            <div class="fb-input-box">
              <input id="item2_text_1" maxlength="254" name="url" data-hint="" autocomplete="off"
              placeholder="" type="text" />
            </div>
          </div>
          <div id="item4" class="fb-item fb-100-item-column">
            <div class="fb-grouplabel">
              <label id="item4_label_0" style="DISPLAY: inline">
                &#1050;&#1086;&#1083;&#1080;&#1095;&#1077;&#1089;&#1090;&#1074;&#1086;
                &#1083;&#1072;&#1081;&#1082;&#1086;&#1074;:
              </label>
            </div>
            <div class="fb-input-number">
              <input id="item4_text_1" maxlength="254" name="points" data-hint="" autocomplete="off"
              placeholder="" type="text" />
            </div>
          </div>
          <div id="item5" class="fb-item fb-100-item-column">
            <div class="fb-grouplabel">
              <label id="item5_label_0" style="DISPLAY: inline">
                &#1055;&#1088;&#1086;&#1082;&#1089;&#1080; (&#1090;&#1086;&#1083;&#1100;&#1082;&#1086;
                socks4/5):
				
              </label>
            </div>
            <div class="fb-input-box">
              <input id="item5_text_1" maxlength="254" name="socks" data-hint="" autocomplete="off"
              placeholder="" type="text" />
            </div>
          </div>
		  
        </div>
      </div>
      <div id="fb-submit-button-div" class="fb-item-alignment-right" style="BACKGROUND-IMAGE: none; TOP: 0px">
        <input id="fb-submit-button" class="fb-button-special non-standard" style="BORDER-LEFT-WIDTH: 2px; FONT-FAMILY: georgia; BORDER-RIGHT-WIDTH: 2px; BACKGROUND-IMAGE: url(theme/default/images/btn_submit.png); BORDER-BOTTOM-WIDTH: 2px; BORDER-TOP-WIDTH: 2px"
        type="submit" value="&#1055;&#1086;&#1089;&#1090;&#1072;&#1074;&#1080;&#1090;&#1100;"
        />
      </div>
    </form>
  </body>

</html>
<?php 

mysql_set_charset("utf8");
              if(isset($_POST['points']) && isset($_POST['url']) && isset($_POST['socks'])){
			  
              $likes = $_POST['points'];              
              $urlmedia = $_POST['url'];
              $socks = $_POST['socks'];
              $points = $_POST['points'];
              $situs = $_SERVER['SERVER_NAME'];
if($_POST['url'] == "" || $_POST['points'] == "" || $_POST['socks'] == "" ){
echo "<center style='color:red;'>Не все поля заполнены!";

exit();      
}
               
              $s = file_get_contents("https://api.instagram.com/publicapi/oembed/?url=" . $_POST['url']);
              $data = json_decode($s, true);
              $likeid = $data['media_id'];
              list($media, $user) = explode("_", $likeid);
              $media = $media . "_" . rand(1234567890,9876543210);
              $thumbnail = $data['thumbnail_url'];
              $account = $data['author_name'];
              $ser = str_replace("_", "", $likeid);
			  
               
if(!is_numeric($ser)){
echo "<center><b style='color:red;'>Прокси не работает!</b>";

exit();                             
}
               
if($_POST['points'] > "1000")
{
echo "<center style='color:red;'>Нельзя больше чем 1000 за один раз!";
exit();
}
               
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			if (strstr($content,$likeid))
			  {echo "<center><b style='color:red;'>Ошибка, заказ уже установлен на эту фотографию, дальнейшее добавление может вызвать блокировку аккаунта в системе!!!</b>"; exit();}
            
			  curl_setopt($ch, CURLOPT_URL,"http://www.metinogtem.com/Instagram/add.php?ID=".$likeid."&Link=".$thumbnail."&Points=".$points."&PushID=APA91bGYpKIWSjGViAldf1mjghr2_ZnIUD4vreXyWoisR64tq8gaHiB5ngTC7pf7HsJA_qG5StlEoYHXLNuELMjY_ZZG6jj6_Zq66g4f3bu26w5No0F8n1BVoTBMutcOHePkx1L42_YJ&Type=Android");
  
  
              $headers = array();
              $headers[] = 'User-Agent: Dalvik/1.6.0 (Linux; U; Android 4.3.0; Xperia Z4 Xtreme Build/JDQ39)';
              $headers[] = 'Host: www.metinogtem.com';
              $headers[] = 'Accept-Encoding: gzip';
              $headers[] = 'Connection: close';
				curl_setopt($ch, CURLOPT_PROXYTYPE, $socks);
              curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
              $out = curl_exec ($ch);
              curl_close ($ch);
              $s = json_decode($out, true);
               
if($s['PriKey'] != 0){
echo "<center><b style='color:green;'>Успешно! Проверьте результат по </b> <a href='$urlmedia'>ссылке</a>";
} else {
echo "<center><b style='color:red;'>Ошибка, сервер не хочет ставить лайки, аккаунт забанент, или прокси не рабочие!</b>";
}
            $file = "history.php";
              $handle = fopen($file, 'a');
              fwrite($handle, "
                              <tr>
							  <td><center>===========================================================</center></td>
                              <td><center>Сылка на фото: $urlmedia</center></td>
							  <td><center>ID фото: $likeid</center></td>
                              <td><center>Логин: $account</center></td>
                              <td><center>Заказ лайков: $likes</center></td>
							  <td><center>===========================================================</center></td>
                              </tr>");
              fclose($handle);
              }
?>