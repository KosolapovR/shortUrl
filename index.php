<?php
// Include database configuration file
require_once 'src/dbConfig.php';

// Include URL Shortener library file
require_once 'src/Shortener.php';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
if ( isset( $_POST['longUrl'] ) && ! empty( $_POST['longUrl'] ) ){
   $longUrl = $_POST['longUrl'];
   $shortener = new Shortener($db);

   $shortURL_Prefix = 'https://autopole.ru/r/'; // with URL rewrite
 
 try{
    // Get short code of the URL
    $shortCode = $shortener->urlToShortCode($longUrl);

    // Create short URL
    $shortURL = $shortURL_Prefix.$shortCode;

    // Display short URL
    echo 'Short URL: '.$shortURL;
}catch(Exception $e){
    // Display error
    echo $e->getMessage();
}
   echo "<p>Выбран url = $longUrl</p>" . PHP_EOL;
   echo "<p>Сокращенный = $shortURL</p>" . PHP_EOL;
}
?>
<form action="<?= htmlentities( $_SERVER['PHP_SELF'] ); ?>" method="post">
    <label>
        Long url:
        <input type="text" name="longUrl" placeholder="Введите Url который необходимо сократить">
    </label>

    <button type="submit">Сократить</button>
</form>
</body>
</html>
