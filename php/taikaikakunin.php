<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="/php/css/bootstrap.min.css"> 
    <link rel="stylesheet" type="text/css" href="/php/css/taikaikakunin.css"> 
    <script type="text/javascript" src="/php/js/jquery-3.1.1.min.js"></script> 
    <script type="text/javascript" src="/php/js/bootstrap.min.js"></script> 
    <title>退会確認画面</title> 
</head> 
<body> 
    <?php 
        require('navbar.php'); 
         
        if(!isset($_SESSION["UserName"])){
            header("Location: /php/logincontroller");
            exit;
        } 
        else{
        }
 
    ?>

    <div class="container main">
    <div class="text-center">
    <div class="col-md-6 col-md-offset-3 dropBox">
    <h3 id="taikaiTitle">本当に退会しますか？</h3>
    <form method="post" action="/php/logincontroller">
    <input type="hidden" name="id" value="<?php echo unserialize($_SESSION['UserID']) ?>">
    <input type="hidden" name="process" value="taikaiconfirm">
    <button type="submit" class="btn btn-success">退会する</button>
    <button type="button" class="btn btn-danger">キャンセル</button>
    </form>

    </div>
    </div>
    </div>
    </body>
    </html>