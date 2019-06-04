<?php
    include ('Database.php');
    session_start();
    $name = "";
    $description = "";
    $date = "";
    $time = "";
    $location = "";
    $address = "";
    $sphere = "";
    $organizer_id= NULL;
    $meetup_id = NULL;
    $msg = "";
    $result = "";

    function getDatetimeNow()
    {
        $tz_object = new DateTimeZone('Asia/Almaty');

        $datetime = new DateTime();
        $datetime->setTimezone($tz_object);
        return $datetime->format('Y\-m\-d\ H:i:s');
    }

    if(isset($_POST['next']))
        {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            $location = $_POST['location'];
            $address = $_POST['address'];
            $social = $_POST['social'];
            $sphere = $_POST['sphere'];
            $organizer_id = $_POST['organizer_id'];
            $created_at = getDatetimeNow();

            foreach ($date as $selected)
            {
                $dates .= " ".$selected;
            }

            foreach ($social as $filled)
            {
                $socials .= " ".$filled;
            }

            $sql = "INSERT INTO meetups (name, description, date, time, location, address, social, sphere, organizer_id, created_at) 
                    VALUES ('$name', '$description', '$dates', '$time', '$location', '$address', '$socials', '$sphere', '$organizer_id', '$created_at')";

            mysqli_query($db, $sql);
            $meetup = mysqli_query($db, "SELECT meetup_id FROM meetups WHERE name = '$name' AND description = '$description'");
            $meetupz = mysqli_fetch_array($meetup);
            $meetup_id = $meetupz['meetup_id'];
            header('location: add_image.php?next='.$meetup_id);
        }

    if(isset($_POST['save']))
    {
        $targetDir = "images/";
        $allowTypes = array('jpg','png','jpeg','gif');
        $user_id = $_POST['user_id'];
        $meetup_id = $_POST['meetup_id'];

        $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
        if(!empty(array_filter($_FILES['files']['name']))){
            foreach($_FILES['files']['name'] as $key=>$val){
                // File upload path
                $fileName = basename($_FILES['files']['name'][$key]);
                $targetFilePath = $targetDir . $fileName;
                // Check whether file type is valid
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                if(in_array($fileType, $allowTypes)){
                    // Upload file to server
                    if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                        // Image db insert sql
                        $insertValuesSQL .= "('".$fileName."', '".$meetup_id."', '".$user_id."', NOW()),";
                    }else{
                        $errorUpload .= $_FILES['files']['name'][$key].', ';
                    }
                }else{
                    $errorUploadType .= $_FILES['files']['name'][$key].', ';
                }
            }
            if(!empty($insertValuesSQL)){
                $insertValuesSQL = trim($insertValuesSQL,',');
                // Insert image file name into database
                $insert = mysqli_query($db,"INSERT INTO image (file_name, meetup_id, user_id, created_at) VALUES $insertValuesSQL");
                if($insert){
                    $errorUpload = !empty($errorUpload)?'Upload Error: '.$errorUpload:'';
                    $errorUploadType = !empty($errorUploadType)?'File Type Error: '.$errorUploadType:'';
                    $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
                    $statusMsg = "Files are uploaded successfully.".$errorMsg;
                }else{
                    $statusMsg = "Sorry, there was an error uploading your file.";
                }
            }
        }else{
            $statusMsg = 'Please select a file to upload.';
        }
        // Display status message
        echo $statusMsg;
        header('location: index.php');
    }

    $results = mysqli_query($db, "SELECT * FROM meetups");

    if(isset($_POST['update']))
    {
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $description = mysqli_real_escape_string($db, $_POST['description']);
        $date = mysqli_real_escape_string($db, $_POST['date']);
        $time = mysqli_real_escape_string($db, $_POST['time']);
        $location = mysqli_real_escape_string($db, $_POST['location']);
        $address = mysqli_real_escape_string($db, $_POST['address']);
        $sphere = mysqli_real_escape_string($db, $_POST['sphere']);
        $organizer_id = mysqli_real_escape_string($db, $_POST['organizer_id']);
        $meetup_id = mysqli_real_escape_string($db, $_POST['meetup_id']);
        $updated_at = getDatetimeNow();
        //need to fix
        $sql = "UPDATE meetups 
                SET name = '$name', description = '$description', date = '$date', time = '$time',
                    location = '$location', address = '$address', sphere = '$sphere', organizer_id = '$organizer_id', is_approved = false, updated_at = '$updated_at' 
                WHERE meetup_id = $meetup_id";
        mysqli_query($db, $sql);

        $target = "images/".basename($_FILES['image']['name']);
        $image = $_FILES['image']['name'];
        $sql = "UPDATE image SET user_id = '$organizer_id', file_name = '$image' WHERE meetup_id = $meetup_id";

        if(move_uploaded_file($_FILES['image']['tmp_name'], $target))
        {
            $msg = "Success";
        }
        else
        {
            $msg = "Error";
        }
        $_SESSION['message'] = "Updated!";
        header('location: index.php');
    }

    if(isset($_GET['del']))
    {
        $meetup_id = $_GET['del'];
        mysqli_query($db, "DELETE FROM meetups WHERE meetup_id = $meetup_id");
        header('location: index.php');
    }

    if(isset($_GET['join']))
    {
        $user_id = $_GET['join'];
        $meetup_id = $_GET['jointo'];
        mysqli_query($db, "INSERT INTO member (user_id, meetup_id) VALUES ('$user_id', '$meetup_id')");
        mysqli_query($db, "INSERT INTO rating (user_id, meetup_id) VALUES ('$user_id', '$meetup_id')");
        header('location: meetup_details.php?meetup='.$meetup_id);
    }

    if(isset($_GET['unjoin']))
    {
        $user_id = $_GET['unjoin'];
        $meetup_id = $_GET['unjointo'];
        mysqli_query($db, "DELETE FROM member WHERE meetup_id = $meetup_id AND user_id = $user_id");                                
        mysqli_query($db, "DELETE FROM rating WHERE meetup_id = '$meetup_id' AND user_id = '$user_id'");
        header('location: meetup_details.php?meetup='.$meetup_id);
    }

    if(isset($_POST['submit_comment']))
    {
        $comment = $_POST['comment'];
        $meetup_id = $_POST['meetup_id'];
        $user_id = $_POST['user_id'];
        $created_at = getDatetimeNow();
        $sql = "INSERT INTO comment (user_id, meetup_id, comment, created_at) VALUES ('$user_id', '$meetup_id', '$comment', '$created_at')";
        mysqli_query($db, $sql);
        $_SESSION['message'] = "Saved!";
        header('location: meetup_details.php?meetup='.$meetup_id);
    }

    if(isset($_POST['delete_comment']))
    {
        $comment_id = $_POST['comment_id'];
        $meetup_id = $_POST['meetup_id'];
        mysqli_query($db, "DELETE FROM comment WHERE comment_id = $comment_id");
        header('location: meetup_details.php?meetup='.$meetup_id);
    }

    if(isset($_POST['user_update']))
    {
        $user_id = mysqli_real_escape_string($db, $_POST['user_id']);
        $user_name = mysqli_real_escape_string($db, $_POST['user_name']);
        $email= mysqli_real_escape_string($db, $_POST['email']);
        $phone = mysqli_real_escape_string($db, $_POST['phone']);
        $address = mysqli_real_escape_string($db, $_POST['address']);
        $current_password = mysqli_real_escape_string($db, $_POST['current_password']);
        $new_password1 = mysqli_real_escape_string($db, $_POST['new_password1']);
        $new_password2 = mysqli_real_escape_string($db, $_POST['new_password2']);
        $logotype = $_POST['logo'];
        $image = $_POST['image'];
        $target = "profiles/".basename($_FILES['logo']['name']);
        $logo = $_FILES['logo']['name'];
        $updated_at = getDatetimeNow();

        if(move_uploaded_file($_FILES['logo']['tmp_name'], $target))
        {
            $msg = "Success";
        }
        else
        {
            $msg = "Error";
        }

        $record = mysqli_query($db, "SELECT * FROM user WHERE user_id = '$user_id'");
        $password = mysqli_fetch_array($record);
        if($_FILES['logo']['size'] == 0) $logo = $image;
        if(!empty($current_password) && !empty($new_password1)) {
            $current_password = md5($current_password);

            if ($current_password === $password['password']) {
                if ($new_password1 === $new_password2) {
                    $new_password1 = md5($new_password1);
                    $sql = "UPDATE user 
                            SET user_name = '$user_name', email= '$email', phone = '$phone', 
                                address= '$address', logo = '$logo', password = '$new_password1', created_at = '$created_at' 
                            WHERE user_id = $user_id";
                    mysqli_query($db, $sql);
                    header('location: user_profile.php?user_id=' . $user_id);
                } else {
                    $_SESSION['message'] = "The two passwords do not match";
                    header('location: user_profile.php?user_edit=' . $user_id);        
                }
            } else {
                $_SESSION['message'] = 'Current password is incorrect';
                header('location: user_profile.php?user_edit=' . $user_id);
            }
        }
        else
        {
            $sql = "UPDATE user 
                    SET user_name = '$user_name', email= '$email', phone = '$phone', address= '$address', logo = '$logo', updated_at = '$updated_at'  
                    WHERE user_id = $user_id";
            mysqli_query($db, $sql);
            header('location: user_profile.php?user_id=' . $user_id);
        }
    }

    if(isset($_GET['user_delete']))
    {
        $user_id = $_GET['user_delete'];
        mysqli_query($db, "DELETE FROM user WHERE user_id = $user_id");
        header('location: Logout.php');
    }

    if(isset($_POST['submit_points']))
    {
        $new_points = $_POST['points'];
        $meetup_id = $_POST['meetup_id'];
        $user_id = $_POST['user_id'];
        $rating =  mysqli_query($db, "SELECT * FROM rating WHERE meetup_id = $meetup_id AND user_id = $user_id");
        $ratings = mysqli_fetch_array($rating);
        $is_rated = isset($ratings);

        if($is_rated)
            mysqli_query($db,"UPDATE rating SET point = '$new_points' 
                                    WHERE meetup_id = '$meetup_id' AND user_id = '$user_id'");
        else
            mysqli_query($db,"INSERT INTO rating(meetup_id, user_id, point) 
                                    VALUES ('$meetup_id', '$user_id', '$new_points')");

        $current_rating = mysqli_query($db,"SELECT point FROM rating 
                                                  WHERE meetup_id = '$meetup_id'");
        $points = 0;
        foreach ($current_rating as $current_points)
        {
            $points = $points + $current_points['point'];
        }

        mysqli_query($db,"UPDATE meetups SET points = '$points' WHERE meetup_id = '$meetup_id'");
        header('location: meetup_details.php?meetup='.$meetup_id);
    }

    if(isset($_POST['send-email']))
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $to = 'apushev.ye@gmail.com';
        $headers = 'From: '. $name . "\r\n" .
                    'Reply-To: '. $email . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
        header('location: index.php');
    }

    if(isset($_POST['submit_newsletter']))
    {
        $email = $_POST['newsletter'];
        $sphere = $_POST['newsletter_sphere'];
        $header = $_POST['header'];
        $email_check = "SELECT email FROM newsletter WHERE email = '$email'";
        $result = mysqli_query($db,$email_check);
        $is_exist = mysqli_fetch_assoc($result);

        if(!$is_exist)
        {
            $sql = "INSERT INTO newsletter (email,sphere) VALUES ('$email','$sphere')";
            mysqli_query($db, $sql);
        }
        header($header);
    }

    if(isset($_POST['delete_newsletter']))
    {
        $newsletter_id = $_POST['newsletter_id'];
        mysqli_query($db, "DELETE FROM newsletter WHERE newsletter_id = $newsletter_id");
        header('location: user_profile.php');
    }

    if(isset($_POST['delete_img']))
    {
        $user_id = $_POST['user_id'];
        mysqli_query($db, "UPDATE user SET logo = NULL WHERE user_id = $user_id");
        header('location: user_edit.php?user_edit='.$user_id);
    }

    if(isset($_POST['today_approve']))
    {
        $member_id = $_POST['member_id'];
        mysqli_query($db, "UPDATE member SET is_coming = 1 WHERE member_id = $member_id");
        header('location: user_profile.php');
    }

    if(isset($_POST['today_reject']))
    {
        $member_id = $_POST['member_id'];
        mysqli_query($db, "UPDATE member SET is_coming = 2 WHERE member_id = $member_id");
        header('location: user_profile.php');
    }

    mysqli_close($db);
?>