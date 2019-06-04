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
                <h2>Редактировать Профиль</h2>
                <p>Укажите наиболее достоверную информацию, чтобы мы могли оставаться на связи.</p>
            </div>

            <div class="row" >
                <div class="col-md-3"></div>
                <div class="col-md-6" id = "height">
                    <div class="details" >
                        <div class="social"></div>
                        <form method = "post" action = "Server.php" enctype="multipart/form-data">
                            <input type = "hidden" name="user_id" value="<?= $user_id;?>">
                            <div class="text-center">
                                <?php
                                if(!empty($image))
                                {
                                    echo "<img class='img-fluid' id='avatar' src='../profiles/" . $image. "'>";
                                    echo "<br><button type='submit' name = 'delete_img' class = 'btn-danger'>Удалить фотографию</button>";
                                }
                                else
                                    echo "<img src = 'profiles/avatar.png' id='avatar'><br>
                                    У вас нет фотографии профиля<br> <input type = 'file' name = 'logo'>"
                                ?>
                            </div>
                            <div class="form-group" style="margin-top:30px;">
                            <input type="hidden" name = "image" value="<?= $image; ?>">
                            <div class="form-group" >
                                <label>Имя пользователя</label>
                                <input class="form-control" type="text" name = "user_name" value="<?= $user_name; ?>">
                            </div>
                            <div class="form-group">
                                <label>Электронная почта</label>
                                <input class="form-control" type="email" name = "email" value="<?= $email; ?>">
                            </div>
                            <div class="form-group">
                                <label>Номер телефона</label>
                                <input class="form-control" type="text" name="phone" value="<?= $phone; ?>">
                            </div>
                            <div class="form-group">
                                <label>Адресс</label>
                                <input class="form-control" type="text" name="address" value="<?= $address; ?>">
                            </div>
                            <div class="text-center" style="margin:20px 0 10px 0;">
                                <input type="button" class="btn" onclick="change_password()" value="Изменить пароль">
                            </div>
                            <div id = "password_field" style="display: none">
                                <div class="form-group">
                                    <label>Текущий пароль</label>
                                    <input class="form-control" type="password" name="current_password">
                                </div>
                                <div class="form-group">
                                    <label>Новый пароль</label>
                                    <input class="form-control" type="password" name="new_password1">
                                </div>
                                <div class="form-group">
                                    <label>Введите повторно пароль</label>
                                    <input class="form-control" type="password" name="new_password2">
                                </div>
                            </div>
                            <div class="text-center" style="margin:20px 0 10px 0;">
                                <button type="submit" name = "user_update" class = "btn">Сохранить</button>
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