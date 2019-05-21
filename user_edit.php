<?php
$GLOBALS['filename'] = 'profile';
session_start();
include ('Database.php');
include("nav.php");

if(isset($_COOKIE["type"]))
{
    $user_id = $_COOKIE['type'];
    $user = mysqli_query($db, "SELECT * FROM user WHERE user_id = '$user_id'");
    $users = mysqli_fetch_array($user);
    $user_name = $users['user_name'];
    $email = $users['email'];
    $address = $users['address'];
    $image = $users['logo'];
    $phone = $users['phone'];
    $is_admin = $users['is_admin'];
}
?>
<main id="main" class="main-page">
    <!--==========================
      Speaker Details Section
    ============================-->
    <section id="speakers-details" class="wow fadeIn">
        <div class="container">
            <div class="section-header">
                <h2>Sign Up</h2>
                <p>Join our awesome community.</p>
            </div>

            <div class="row" >
                <div class="col-md-3"></div>
                <div class="col-md-6" id = "height">
                    <div class="details" >
                        <div class="social"></div>
                        <form method = "post" action = "Server.php" enctype="multipart/form-data">
                            <?php if (isset($_SESSION['message'])): ?>
                                <div class = "alert alert-danger">
                                    <?php
                                    echo $_SESSION['message'];
                                    unset($_SESSION['message']);
                                    ?>
                                </div>
                            <?php endif ?>
                            <input type = "hidden" name="user_id" value="<?= $user_id;?>">
                            <div class="form-group" >
                                <label>Username</label>
                                <input class="form-control" type="text" name = "user_name" value="<?= $user_name; ?>">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="email" name = "email" value="<?= $email; ?>">
                            </div>
                            <div class="form-group">
                                <label>Phone number</label>
                                <input class="form-control" type="text" name="phone" value="<?= $phone; ?>">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input class="form-control" type="text" name="address" placeholder="Enter your address" value="<?= $address; ?>">
                            </div>
                            <input type = "file" name = "logo">
                            <input type="hidden" name = "image" value="<?= $image; ?>">
                            <div class="text-center" style="margin:20px 0 10px 0;">
                                <input type="button" class="btn" onclick="change_password()" value="Change password">
                            </div>
                            <div id = "password_field" style="display: none">
                                <div class="form-group">
                                    <label>Current Password</label>
                                    <input class="form-control" type="password" name="current_password">
                                </div>
                                <div class="form-group">
                                    <label>New password</label>
                                    <input class="form-control" type="password" name="new_password1">
                                </div>
                                <div class="form-group">
                                    <label>Confirm new password</label>
                                    <input class="form-control" type="password" name="new_password2">
                                </div>
                            </div>
                            <div class="text-center" style="margin:20px 0 10px 0;">
                                <button type="submit" name = "user_update" class = "btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
</main>
<?php include("footer.php");?>
</body>
</html>

<script>
    function change_password() {
        var field = document.getElementById("password_field");
        if (field.style.display === "none") {
            field.style.display = "block";
            document.getElementById("height").style.height="750px";
            $( "p" ).text( "cancel" );
        } else {
            field.style.display = "none";
            document.getElementById("height").style.height="500px";
            $( "p" ).text( "change" );
        }

    }
</script>