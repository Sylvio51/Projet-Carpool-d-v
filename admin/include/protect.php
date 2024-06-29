<?php session_start();
if (!isset($_SESSION['user_connected']) || $_SESSION['user_connected'] != "ok") {
<<<<<<< HEAD
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
=======
    header("Location:/index.html");
    exit();
}
?>
>>>>>>> 3d59716b681744a114563079b4c4a890097157aa
