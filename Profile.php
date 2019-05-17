<?php
    include ('Server.php');
    include ('Navbar.php');
    include ('Database.php');

    if(isset($_GET['user_id']))
    {
        $rec = mysqli_query($db, "SELECT * FROM user WHERE user_id = $user_id" );
        $record = mysqli_fetch_array($rec);

        $user_name = $record['user_name'];
        $email = $record['email'];
        $phone = $record['phone'];
        $address = $record['address'];
        $logo = $record['logo'];
    }
?>

<!DOCTYPE html>
<html>
<body>
<form method = "post" action = "Server.php" enctype="multipart/form-data">
    <div class = "input-group">
        <label>Name: </label> <?php echo $user_name;?>
    </div>
    <div class="input-group">
        <label>Email</label> <?php echo $email;?>
    </div>
    <div class = "input-group">
        <label>Phone Number: </label> <?php echo $phone;?>
    </div>
    <?php
    if(!empty($address)): ?>
    <div class = "input-group">
        <label>Address</label> <?php echo $address; ?>
    </div>
    <?php endif; ?>
    <?php if(!empty($logo)): ?>
    <div class = "input-group">
        <label>logo</label> <?php echo $logo;?>
    </div>
    <?php endif; ?>
    <div class = "input-group">
        <a href="EditProfile.php?user_edit=<?php echo $user_id ?>" class="edit_btn" >Edit</a>
    </div>
<?php var_dump($result);?>
</form>
</body>
</html>



