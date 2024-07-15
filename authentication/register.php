<?php 
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="../css/loginStyle.css">
</head>

<body>
    <form action="handelRegister.php" method="post">
        <h2>REGISTER</h2>
        <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <label>User Name</label>
        <input type="text" name="username" placeholder="Enter Your UserName"><br>

        <label>Address</label>
        <input type="text" name="address" placeholder="Enter Your Address"><br>

        <label>Phone</label>
        <input type="text" name="phone" placeholder="Enter Your Phone Number"><br>

        <label> Email</label>
        <input type="text" name="email" placeholder="Enter Valid Email"><br>

        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br>

        <button type="submit">Register</button>
    </form>
</body>

</html>