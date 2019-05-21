<?php
    include ('Database.php');

    $name = "";
    $description = "";
    $date = "";
    $location = "";
    $sphere = "";
    $organizer_id= NULL;
    $meetup_id = NULL;
    $msg = "";
    $result = "";

    if(isset($_POST['next']))
        {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $date = $_POST['date'];
            $location = $_POST['location'];
            $sphere = $_POST['sphere'];
            $organizer_id = $_POST['organizer_id'];
            //need to fix
            $sql = "INSERT INTO meetups (name, description, date, location, sphere, organizer_id) 
                      VALUES ('$name', '$description', '$date', '$location', '$sphere', '$organizer_id')";

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
                $insert = mysqli_query($db,"INSERT INTO image (file_name, meetup_id, user_id, uploaded_on) VALUES $insertValuesSQL");
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
        $location = mysqli_real_escape_string($db, $_POST['location']);
        $sphere = mysqli_real_escape_string($db, $_POST['sphere']);
        $organizer_id = mysqli_real_escape_string($db, $_POST['organizer_id']);
        $meetup_id = mysqli_real_escape_string($db, $_POST['meetup_id']);
        //need to fix
        $sql = "UPDATE meetups 
                SET name = '$name', description = '$description', date = '$date', 
                    location = '$location', sphere = '$sphere', organizer_id = '$organizer_id' 
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
        mysqli_query($db, "DELETE FROM image WHERE meetup_id = $meetup_id");
        mysqli_query($db, "DELETE FROM comment WHERE meetup_id = $meetup_id");
        mysqli_query($db, "DELETE FROM member WHERE meetup_id = $meetup_id");
        mysqli_query($db, "DELETE FROM rating WHERE meetup_id = $meetup_id");
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
        header('location: meetup_details.php?meetup='.$meetup_id);
    }
    if(isset($_POST['submit_comment']))
    {
        $comment = $_POST['comment'];
        $meetup_id = $_POST['meetup_id'];
        $user_id = $_POST['user_id'];

        $sql = "INSERT INTO comment (user_id, meetup_id, comment) VALUES ('$user_id', '$meetup_id', '$comment')";
        mysqli_query($db, $sql);
        $_SESSION['message'] = "Saved!";
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

        $target = "profiles/".basename($_FILES['logo']['name']);
        $logo = $_FILES['logo']['name'];

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

        if(!empty($current_password) && !empty($new_password1)) {
            $current_password = md5($current_password);

            if ($current_password === $password['password']) {
                if ($new_password1 === $new_password2) {
                    $new_password1 = md5($new_password1);
                    $sql = "UPDATE user 
                            SET user_name = '$user_name', email= '$email', phone = '$phone', 
                                address= '$address', logo = '$logo', password = '$new_password1' 
                            WHERE user_id = $user_id";
                    mysqli_query($db, $sql);
                    header('location: Profile.php?user_id=' . $user_id);
                } else {
                    $_SESSION['message'] = "The two passwords do not match";
                    header('location: EditProfile.php?user_edit=' . $user_id);
                }
            } else {
                $_SESSION['message'] = "Current password is incorrect";
                header('location: EditProfile.php?user_edit=' . $user_id);
            }
        }
        else
        {
            $sql = "UPDATE user 
                    SET user_name = '$user_name', email= '$email', phone = '$phone', address= '$address', logo = '$logo'  
                    WHERE user_id = $user_id";
            mysqli_query($db, $sql);
            header('location: Profile.php?user_id=' . $user_id);
        }
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
        $email_check = "SELECT email FROM newsletter WHERE email = '$email'";
        $result = mysqli_query($db,$email_check);
        $is_exist = mysqli_fetch_assoc($result);

        if(!$is_exist)
        {
            $sql = "INSERT INTO newsletter (email) VALUES ('$email')";
            mysqli_query($db, $sql);
        }
        header('location: index.php');
    }

    mysqli_close($db);
?>