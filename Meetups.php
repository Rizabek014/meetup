<?php

    include ('Navbar.php');

    session_start();

    $db = mysqli_connect('localhost', 'root', '', 'meetup');
    $meetup = mysqli_query($db, "SELECT * FROM meetups");

    $image = mysqli_query($db, "SELECT * FROM image");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Read meetups</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <table>
        <?php while ($row = mysqli_fetch_array($meetup)) {
            if ($row['is_approved'] == true) {
                ?>
                <tr class='clickable-row' data-href="MeetupDetails.php?detail=<?php echo $row['meetup_id']; ?>">
                    <?php
                    foreach ($image as $images) {
                        if ($images['meetup_id'] == $row['meetup_id']) {
                            echo "<td><img style='width:150px;height:128px;' src='images/" . $images['path'] . "'></td>";
                        }
                    }
                    ?>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
    </body>
</html>

<script>
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>