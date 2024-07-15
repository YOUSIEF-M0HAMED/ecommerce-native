<?php 
session_start();
if(isset($_SESSION['id'])){
header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="../css/loginStyle.css">
</head>

<body>
    <form action="submitLogin.php" method="post">
        <h2>LOGIN</h2>
        <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label>Email</label>
        <input type="text" name="email" placeholder="Enter Your Email"><br>

        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br>

        <button type="submit">Login</button>
    </form>
</body>

</html>