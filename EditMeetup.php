<?php

    include ('Server.php');
    include ('Navbar.php');

    $db = mysqli_connect('localhost', 'root', '', 'meetup');

    if(isset($_GET['edit']))
    {
        $meetup_id = $_GET['edit'];

        $rec = mysqli_query($db, "SELECT * FROM meetups WHERE meetup_id = $meetup_id" );
        $record = mysqli_fetch_array($rec);


        $name = $record['name'];
        $description = $record['description'];
        $date = $record['date'];
        $location = $record['location'];
        $sphere = $record['sphere'];
        $organizer_id = $record['organizer_id'];
        $meetup_id= $record['meetup_id'];
    }
?>
<!DOCTYPE html>
<html>
<body>
    <form method = "post" action = "Server.php">
        <input type="hidden" name="meetup_id" value="<?php echo $meetup_id;?>">
        <div class = "input-group">
            <label>Name</label>
            <input type = "text" name = "name" value="<?php echo $name;?>">
        </div>
        <div class = "input-group">
            <label>Description</label>
            <input type = "text" name = "description" value="<?php echo $description;?>">
        </div>
        <div>
            <label>Date</label>
            <input type = "date" name = "date" value="<?php echo $date;?>">
        </div>
        <div class = "input-group">
            <label>Location</label>
            <input type = "text" name = "location" value="<?php echo $location;?>">
        </div>
        <div class = "input-group">
            <label>sphere</label>
            <input type = "text" name = "sphere" value="<?php echo $sphere;?>">
        </div>
        <div class = "input-group">
            <label>org_id</label>
            <input type = "text" name = "organizer_id" value="<?php echo $organizer_id;?>">
        </div>
        <div class = "input-group">
                <button type="submit" name = "update" class = "btn">Update</button>
        </div>
    </form>
</body>
</html>

