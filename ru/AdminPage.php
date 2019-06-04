<?php
    include ('Database.php');

    if(isset($_COOKIE["type"]))
    {
        $user_id = $_COOKIE['type'];
        $user = mysqli_query($db, "SELECT * FROM user WHERE user_id = '$user_id'");
        $users = mysqli_fetch_array($user);
        $user_name = $users['user_name'];
        $is_admin = $users['is_admin'];
    }

    if(!isset($_COOKIE["type"]) || !$is_admin) header('location: index.php');

    $meetup = mysqli_query($db, "SELECT * FROM meetups");
    $image = mysqli_query($db, "SELECT * FROM image");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<nav class = "navbar navbar-inverse">
    <div class = "container">
        <div class = "navbar-header">
            <a href="index.php" class = "navbar-brand" >Meetup</a>
        </div>
        <ul class = "nav navbar-nav navbar-right">
            <li><a href = "users_list.php"> List of users</a></li>
            <li><a href = "user_profile.php?user_id=<?php echo $user_id ?>"><?php echo "Admin ".$user_name?></a></li>
            <li><a href = "Logout.php"> Log out</a></li>
        </ul>
    </div>
</nav>
<main>
<section id="speakers" class="wow fadeInUp">
<div class="container">
    <table class="table ">
        <thead>
        <tr>
            <th> </th>
            <th>Meetup Name</th>
            <th>Location</th>
            <th>Approvement</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_array($meetup)) {
        if ($row['is_approved']) {
            ?>
        <div class="col-lg-4 col-md-6">
            <div class="speaker">
            <tr class='clickable-row' data-href="meetup_details.php?meetup=<?php echo $row['meetup_id']; ?>">
                <?php
                $check = true;
                foreach ($image as $images) {
                    if ($images['meetup_id'] == $row['meetup_id'] && $check) {
                        $check = false;
                        echo "<td><img style='width:150px;height:128px;' src='../images/" . $images['file_name'] . "'></td>";
                    }
                }
                ?>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td><li class="glyphicon glyphicon-ok"></li></td>
            </tr>
            <?php
        }
        if (!$row['is_approved']) {
            ?>
            <tr class='clickable-row' data-href="meetup_details.php?meetup=<?php echo $row['meetup_id']; ?>">
                <?php
                foreach ($image as $images) {
                    if ($images['meetup_id'] == $row['meetup_id']) {
                        echo "<td><img style='width:150px;height:128px;' src='../images/" . $images['file_name'] . "'></td>";
                    }
                }
                ?>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td><li class="glyphicon glyphicon-time"></li></td>
            </tr>
            <?php
        }
    }
    ?>
            </div>
        </div>
        </tbody>
    </table>
</div>
</section>
</main>
</body>
</html>

<script>
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>