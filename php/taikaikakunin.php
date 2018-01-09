<DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <link rel="stylesheet" type="text/css" href="/php/css/bootstrap.min.css"> 
    <link rel="stylesheet" type="text/css" href="/php/css/taikaikakunin.css"> 
    <script type="text/javascript" src="/php/js/jquery-3.1.1.min.js"></script> 
    <script type="text/javascript" src="/php/js/bootstrap.min.js"></script> 
    <title>退会確認画面</title> 
</head> 
<body> 
    <?php 
        require('navbar.php'); 
        // echo $_GET["calendar_val"]; 
        if(isset($_SESSION["token"])){ 
            unset($_SESSION["token"]); 
        } 
    ?>

    <div class="container main">
    <div class="text-center">
    <h3 id="taikaiTitle">本当に退会しますか？</h3>
    <form method="post" action="/php/logincontroller">
    <input type="hidden" name="id" value="<?php echo unserialize($_SESSION['UserID']) ?>">
    <input type="hidden" name="process" value="taikaiconfirm">
    <button type="submit" class="btn btn-success">退会</button>
    <button type="button" class="btn btn-danger">キャンセル</button>
    </form>

    </div>
    </div>
    </body>
    </html>