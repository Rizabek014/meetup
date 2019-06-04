<?php
    include ('Database.php');

    $meetup_array = array();
    $is_date = false;
    $today_meetup_id = 0;
    $today_meetup_name = NULL;
    $user_id = 0;
    $is_coming = 0;
    if(isset($_COOKIE["type"])) $user_id = $_COOKIE['type'];

    $tz_object = new DateTimeZone('Asia/Almaty');
    $datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    $dating = $datetime->format('Y\-m\-d');

    $member = mysqli_query($db, "SELECT * FROM member WHERE user_id = '$user_id'");

    while($member_of = mysqli_fetch_array($member))
    {
        $meetup_id = $member_of['meetup_id'];
        $is_coming = $member_of['is_coming'];
        $member_id = $member_of['member_id'];
        $meetup = mysqli_query($db, "SELECT * FROM meetups WHERE meetup_id = '$meetup_id'");
        $meetups = mysqli_fetch_array($meetup);
        array_push($meetup_array, $meetups);
    }

    foreach ($meetup_array as $row) {
        if(date('Y-m-d',strtotime($row['date'])) == $dating)
        {
            $is_date = true;
            $today_meetup_id = $row['meetup_id'];
            $today_meetup_name = $row['name'];
        }
    }
?>
