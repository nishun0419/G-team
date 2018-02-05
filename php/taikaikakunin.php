<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="/teamG/css/bootstrap.min.css"> 
    <link rel="stylesheet" type="text/css" href="/teamG/css/taikaikakunin.css"> 
    <link rel="stylesheet" type="text/css" href="/teamG/css/navbar.css">
    <link rel="stylesheet" type="text/css" href="/teamG/css/footer.css">
    <script type="text/javascript" src="/teamG/js/jquery-3.1.1.min.js"></script> 
    <script type="text/javascript" src="/teamG/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/teamG/js/footerFixed.js"></script>
    <title>退会確認画面</title> 
</head> 
<body> 
    <?php 
        require('navbar.php'); 
         
        if(!isset($_SESSION["UserName"])){
            header("Location: /teamG/logincontroller");
            exit;
        } 
        else{
        }
 
    ?>

    <div class="container main">
    <div class="text-center">
    <div class="col-md-6 col-md-offset-3 dropBox">
    <h3 id="taikaiTitle">本当に退会しますか？</h3>
    <form method="post" action="/teamG/logincontroller">
    <input type="hidden" name="id" value="<?php echo unserialize($_SESSION['UserID']) ?>">
    <input type="hidden" name="process" value="taikaiconfirm">
    <button type="submit" class="btn btn-success">退会する</button>
    <button type="button" class="btn btn-danger" onClick="location.href='/teamG/php/mypage.php'">キャンセル</button>
    </form>

    </div>
    </div>
    </div>
    <?php 
        require('footer.php');
    ?>
    </body>
    </html>