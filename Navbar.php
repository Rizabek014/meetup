<?php
    include ('Database.php');

    if(!isset($_COOKIE["type"]))
    {
        header('location: Login.php');
    }
    else
    {
        $user_id = $_COOKIE['type'];
        $user = mysqli_query($db, "SELECT * FROM user WHERE user_id = '$user_id'");
        $users = mysqli_fetch_array($user);
        $user_name = $users['user_name'];
        $is_admin = $users['is_admin'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Meetup</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<nav class = "navbar navbar-inverse">
    <div class = "container-fluid">
        <div class = "navbar-header">
            <a class = "navbar-brand" >Meetups</a>
        </div>
        <ul class = "nav navbar-nav">
            <li><a href = "AddMeetup.php">Add Meetups</a></li>
            <li><a href = "Meetups.php">Meetups</a></li>
        </ul>
        <ul class = "nav navbar-nav navbar-right">
            <?php if($is_admin): ?>
                <li><a href = "Profile.php?user_id=<?php echo $user_id ?>"><?php echo "Admin ".$user_name?></a></li>
            <?php else:?>
                <li><a href = "Profile.php?user_id=<?php echo $user_id ?>"><?php echo $user_name?></a></li>
            <?php endif ?>
            <li><a href = "Logout.php"> Log out</a></li>
        </ul>
    </div>
</nav>
</body>
</html>