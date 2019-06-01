<?php
    include ('Database.php');

    session_start();

    $name = "";
    $description = "";
    $date = "";
    $location = "";
    $sphere = "";
    $organizer_id= NULL;
    $meetup_id = NULL;
    $msg = "";


    if(isset($_GET['approve']))
    {
        $meetup_id = $_GET['approve'];
        $is_approved = true;
        mysqli_query($db, "UPDATE meetups SET is_approved = true WHERE meetup_id = $meetup_id");
        header('location: meetup_details.php?meetup='.$meetup_id);
    }

    if(isset($_GET['disapprove']))
    {
        $meetup_id = $_GET['disapprove'];
        mysqli_query($db, "UPDATE meetups SET is_approved = false WHERE meetup_id = $meetup_id");
        header('location: meetup_details.php?meetup='.$meetup_id);
    }

    if(isset($_POST['warn']))
    {
        $user_id = $_POST['user_id'];
        mysqli_query($db, "UPDATE user SET is_warned = true WHERE user_id = $user_id");
        header('location: users_list.php');
    }

    if(isset($_POST['warned']))
    {
        $user_id = $_POST['user_id'];
        mysqli_query($db, "UPDATE user SET is_warned = false WHERE user_id = $user_id");
        header('location: users_list.php');
    }
    mysqli_close($db);
?>