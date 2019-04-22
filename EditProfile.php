<?php
    include ('Server.php');
    include ('Navbar.php');
    include ('Database.php');

    if(isset($_GET['user_edit']))
    {
        $rec = mysqli_query($db, "SELECT * FROM user WHERE user_id = $user_id" );
        $record = mysqli_fetch_array($rec);

        $user_name = $record['user_name'];
        $password = $record['password'];
        $phone = $record['phone'];
        $email = $record['email'];
        $address = $record['address'];
        $logo = $record['logo'];
    }
?>
<!DOCTYPE html>
<html>
<body>
<form method = "post" action = "Server.php">
    <?php if (isset($_SESSION['message'])): ?>
        <div class = "alert alert-danger">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>
    <input type = "hidden" name="user_id" value="<?php echo $user_id;?>">
    <div class = "input-group">
        <label>Name</label>
        <input type = "text" name = "user_name" value="<?php echo $user_name;?>">
    </div>
    <div class = "input-group">
        <label>Email</label>
        <input type = "email" name = "email" value="<?php echo $email;?>">
    </div>
    <div class = "input-group">
        <label>Phone Number</label>
        <input type = "text" name = "phone" value="<?php echo $phone;?>">
    </div>
    <div class = "input-group">
        <label>Address</label>
        <input type = "text" name = "address" value="<?php echo $address;?>">
    </div>
    <div class = "input-group">
        <label>Logo</label>
    </div>
    <input type = "file" name = "logo">
    <div class = "input-group">
        <label>Password</label>
        <p onclick = "change_password()" style="cursor: pointer" >change</p>
            <div id = "password_field" style="display: none">
                Current Password
                <input type="password" name = "current_password">
                New Password
                <input type="password" name = "new_password1">
                Repeat New Password
                <input type="password" name = "new_password2">
            </div>
    </div>
    <div class = "input-group">
        <button type="submit" name = "user_update" class = "btn">Save</button>
    </div>
</form>
</body>
</html>

<script>
    function change_password() {
        var field = document.getElementById("password_field");
        if (field.style.display === "none") {
            field.style.display = "block";
            $( "p" ).text( "cancel" );
        } else {
            field.style.display = "none";
            $( "p" ).text( "change" );
        }

    }
</script>

