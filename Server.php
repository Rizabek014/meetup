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
        $target = "images/".basename($_FILES['image']['name']);
        $image = $_FILES['image']['name'];
        $user_id = $_POST['user_id'];
        $meetup_id = $_POST['meetup_id'];

        $sql = "INSERT INTO image (meetup_id, user_id, path) VALUES ('$meetup_id', '$user_id', '$image')";
        mysqli_query($db, $sql);

        if(move_uploaded_file($_FILES['image']['tmp_name'], $target))
        {
            $msg = "Success";
        }
        else
        {
            $msg = "Error";
        }
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
        $sql = "UPDATE meetups SET 
                        name = '$name', description = '$description', date = '$date', 
                        location = '$location', sphere = '$sphere', organizer_id = '$organizer_id' 
                        WHERE meetup_id = $meetup_id";
        mysqli_query($db, $sql);

        $target = "images/".basename($_FILES['image']['name']);
        $image = $_FILES['image']['name'];
        $sql = "UPDATE image SET user_id = '$organizer_id', path = '$image' WHERE meetup_id = $meetup_id";

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
        $_SESSION['message'] = "Deleted!";
        header('location: index.php');
    }

    if(isset($_GET['join']))
    {
        $user_id = $_GET['join'];
        $meetup_id = $_GET['jointo'];
        mysqli_query($db, "INSERT INTO member (user_id, meetup_id) VALUES ('$user_id', '$meetup_id')");
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
                    $sql = "UPDATE user SET 
                                        user_name = '$user_name', email= '$email', phone = '$phone', 
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
            $sql = "UPDATE user SET 
                                user_name = '$user_name', email= '$email', phone = '$phone', 
                                address= '$address', logo = '$logo'  
                                WHERE user_id = $user_id";
            mysqli_query($db, $sql);
            header('location: Profile.php?user_id=' . $user_id);
        }
    }

    mysqli_close($db);
?>