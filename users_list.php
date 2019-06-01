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

    $users = mysqli_query($db, "SELECT * FROM user");

    if ($_SERVER['REQUEST_METHOD'] == 'DELETE' || ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['_METHOD'] == 'DELETE')) {
        $user_id = $_POST['user_id'];
        $result = mysqli_query($db, "DELETE FROM user WHERE user_id = $user_id");
        if ($result !== false) {
            // there's no way to return a 200 response and show a different resource, so redirect instead. 303 means "see other page" and does not indicate that the resource has moved.
            header('location: users_list.php');
            exit;
        }
    }
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
            <li><a href = "AdminPage.php"> List of Meetups</a></li>
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
                    <th>User name</th>
                    <th>email</th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_array($users)): ?>
                    <tr>
                        <?php if(empty($row['logo'])): ?>
                        <td><img style='width:150px;height:128px;' src='profiles/avatar.png'></td>
                        <?php else:?>
                        <td><img style='width:150px;height:128px;' src='profiles/<?= $row['logo']?>'></td>
                        <?php endif;?>
                        <td><?= $row['user_name'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td>
                        <?php if(!$row['is_admin']): ?>
                            <form method="POST" onSubmit="return confirm('Are you sure you want to delete this user?')">
                                <input type="hidden" name="_METHOD" value="DELETE">
                                <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                                <button type="submit" name = "user_delete" class="btn-danger" style="width: 75px"> DELETE </button>
                            </form>
                        <form method="post" action="AdminServer.php">
                            <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                            <?php if($row['is_warned'])
                                    echo '<button type="submit" name = "warned" class="btn-warning" style="width: 75px"> WARNED </button>';
                                    else echo '<button  name = "warn" class="btn-warning" style="width: 75px"> WARN </button>'
                            ?>
                        </form>
                        <?php else: echo "ADMIN"; endif;?>
                        </td>
                    </tr>
                <?php endwhile;?>
            </table>
        </div>
    </section>
</main>
</body>
</html>
