<?php 

echo "<center style='color:red;'>Доступ запрещен!";
file_put_contents('file.txt', "IP: ".$_SERVER["REMOTE_ADDR"]." enter in ".date("d:m:y H:i:s")."\n" , FILE_APPEND);

 ?>