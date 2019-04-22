<?php
    include ('Server.php');
    include ('Navbar.php');
    include ('Database.php');

    if(isset($_GET['detail']))
    {
        $meetup_id = $_GET['detail'];

        $rec = mysqli_query($db, "SELECT * FROM meetups WHERE meetup_id = $meetup_id" );
        $record = mysqli_fetch_array($rec);

        $name = $record['name'];
        $description = $record['description'];
        $date = $record['date'];
        $location = $record['location'];
        $sphere = $record['sphere'];
        $organizer_id = $record['organizer_id'];
        $meetup_id = $record['meetup_id'];
        $is_approved = $record['is_approved'];
    }

    $sql_image = "SELECT * FROM image WHERE meetup_id = $meetup_id";
    $result_image = mysqli_query($db, $sql_image);

    $sql_comment = "SELECT * FROM comment WHERE meetup_id = $meetup_id";
    $result_comment = mysqli_query($db, $sql_comment);

    $users = mysqli_query($db,"SELECT * FROM user WHERE user_id = $organizer_id");
    $user = mysqli_fetch_array($users);

    $members = mysqli_query($db, "SELECT * FROM member WHERE meetup_id = $meetup_id");
    $member = mysqli_fetch_array($members);
?>
<!DOCTYPE html>
<html>
<body>
    <form method = "post" action = "Server.php">
        <input type="hidden" name="meetup_id" value="<?php echo $meetup_id;?>">
        <div class = "input-group">
            <label>Name: </label> <?php echo $name;?>
        </div>
        <div class = "input-group">
            <label>Description</label> <?php echo $description;?>
        </div>
        <div class="input-group">
            <label>Date</label> <?php echo $date;?>
        </div>
        <div class = "input-group">
            <label>Location</label> <?php echo $location;?>
        </div>
        <div class = "input-group">
            <label>sphere</label> <?php echo $sphere;?>
        </div>
        <div class = "input-group">
            <label>organizer</label>
            <?php
                foreach ($users as $user)
                {
                    echo $user['user_name'] . "<br>";
                }
            ?>
        </div>
        <div class = "input-group">
            <?php
                while($row_img = mysqli_fetch_array($result_image))
                {
                    echo "<img style = 'width:150px;height:128px;' src = 'images/".$row_img['path']."'>";
                }
            ?>
        </div>
        <?php if($user_id == $organizer_id || $is_admin):?>
        <div class = "input-group">
            <a href="EditMeetup.php?edit=<?php echo $meetup_id ?>" class="edit_btn" >Edit</a>
        </div>
        <div class = "input-group">
            <a href="AdminServer.php?del=<?php echo $meetup_id ?>" class="del_btn">Delete</a>
        </div>
        <?php if($is_admin && !$is_approved): ?>
        <div class = "input-group">
            <a href="AdminServer.php?approve=<?php echo $meetup_id ?>" class="edit_btn">Approve</a>
        </div>
        <?php endif;?>
            <?php if($is_admin && $is_approved): ?>
                <div class = "input-group">
                    <a href="AdminServer.php?disapprove=<?php echo $meetup_id ?>" class="edit_btn">Disapprove</a>
                </div>
            <?php endif;?>
        <?php elseif ($member['user_id'] != $user_id): ?>
            <div class = "input-group">
                <a href="Server.php?user=<?php echo $user_id ?>&jointo=<?php echo $meetup_id ?>" class="btn-primary">Join</a>
            </div>
        <?php else: ?>
            <div class = "input-group">
                <a href="Server.php?users=<?php echo $user_id ?>&unjointo=<?php echo $meetup_id ?>" class="btn-primary">Unjoin</a>
            </div>
        <?php endif;?>
    </form>

    <form method = "post" action = "Server.php">
        <input type = "hidden" name = "meetup_id" value="<?php echo $meetup_id;?>">
        <input type = "hidden" name = "user_id" value="<?php echo $user_id;?>">
        <div class = "input-group">
            <label>Comments</label>
            <?php
                while($row_comment = mysqli_fetch_array($result_comment))
                {
                    foreach ($users as $user)
                    {
                        if($user['user_id'] == $row_comment['user_id'])
                        {
                            echo $user['user_name']."<br>";
                            echo $row_comment['comment']."<br>";
                        }
                    }
                }
            ?>
        </div>
        <div class = <input-group>
            <input type = "text" name = "comment">
            <button type="submit" name = "submit_comment" class = "btn">Submit</button>
        </div>
    </form>
</body>
</html>


