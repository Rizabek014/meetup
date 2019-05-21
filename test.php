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
        <pre onclick = "change_password()" style="cursor: pointer" > change</pre>
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