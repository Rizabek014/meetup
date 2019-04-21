<?php
    include ('Server.php');
    include ('Navbar.php');

    if(isset($_GET['next']))
    {
        $meetup_id = $_GET['next'];
    }
?>
<!DOCTYPE html>
<html>
<body>
<form method = "post" action = "Server.php" enctype="multipart/form-data">
    <input type = "hidden" name = "meetup_id" value="<?php echo $meetup_id ?>">
    <div>
        <label>Image</label>
        <input type = "file" name = "image">
        <br>
        <input type = "hidden" name = "user_id" value="<?php echo $user_id ?>">
    </div>
    <div class = "input-group">
        <button type="submit" name = "save" class = "btn">Save</button>
    </div>
</form>
</body>
</html>

