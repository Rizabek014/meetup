<?php include ('login_registration.php');?>
<!DOCTYPE html>
<html>
<head>
    <title>Registartion</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form method="post" action="Registration.php">
        <?php include('Errors.php'); ?>
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="user_name" value="<?php echo $user_name; ?>">
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password_1">
        </div>
        <div class="input-group">
            <label>Confirm password</label>
            <input type="password" name="password_2">
        </div>
        <div class="input-group">
            <label>Phone number</label>
            <input type="text" name="phone">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="reg_user">Register</button>
        </div>
        <p>
            Already a member? <a href="login.php">Sign in</a>
        </p>
    </form>
</body>
</html>