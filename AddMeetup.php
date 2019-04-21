<?php
    include ('Server.php');
    include ('Navbar.php');
?>
<!DOCTYPE html>
<html>
<body>
    <form method = "post" action = "Server.php" enctype="multipart/form-data">
        <input type="hidden" name="organizer_id" value="<?php echo $user_id?>">
        <div class = "input-group">
            <label>Name</label>
            <input type = "text" name = "name">
        </div>
        <div class = "input-group">
            <label>Description</label>
            <input type = "text" name = "description">
        </div>
        <div>
            <label>Date</label>
            <input type = "date" name = "date">
        </div>
        <div class = "input-group">
            <label>Location</label>
            <input type = "text" name = "location">
        </div>
        <div class = "input-group">
            <label>sphere</label>
            <input type = "text" name = "sphere">
        </div>
        <div class = "input-group">
            <button type="submit" name = "next" class = "btn">Next</button>
        </div>
    </form>
</body>
</html>

