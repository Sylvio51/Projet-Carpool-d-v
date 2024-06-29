<?php session_start();
if (!isset($_SESSION['user_connected']) || $_SESSION['user_connected'] != "ok") {
<<<<<<<<< Temporary merge branch 1
    header("Location:/index.html");
    exit();
}
?>
=========
    header("Location:/admin/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
>>>>>>>>> Temporary merge branch 2
