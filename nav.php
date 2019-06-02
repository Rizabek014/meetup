 <?php
    $db = mysqli_connect('localhost', 'root', '', 'meetup');
    $user_id = 0;
    $is_admin = false;
    include ('today_is_meetup.php');

    if(isset($_COOKIE["type"]))
    {
        $user_id = $_COOKIE['type'];
        $user = mysqli_query($db, "SELECT * FROM user WHERE user_id = '$user_id'");
        $users = mysqli_fetch_array($user);
        $user_name = $users['user_name'];
        $is_admin = $users['is_admin'];
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Meetup</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/favicon1.png" rel="icon">
  <link href="img/apple-touch-icon1.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/venobox/venobox.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: Meetup
    Author: Apushev Yelaman and Kabzhanov Rizabek and Mergazy Zharas
  ======================================================= -->
</head>

<body>

  <!--==========================
    Header
  ============================-->
  <header id="header" <?php if($GLOBALS['filename'] != 'index'){ ?>class="header-fixed"<?php } ?>> 
      <div class="container">

      <div id="logo" class="pull-left">
        <!-- Uncomment below if you prefer to use a text logo -->
          <h1><a href="index.php">Meet<span>up</span></a></h1>
        <!-- <a href="#intro" class="scrollto"><img src="img/logo1.png" alt="" title=""></a>-->
      </div>
    <?php      
    if(($GLOBALS['filename'] == 'index') || ($GLOBALS['filename'] == 'meetup_search')){ ?>
              <nav id="nav-menu-container">
                <ul class="nav-menu">
                  <li class="menu-active"><a href="index.php">Home</a></li>
                  <li><a href="#about">Meetups</a></li>
                  <li><a href="#gallery">Gallery</a></li>
                  <li><a href="#faq">FAQ</a></li>
                  <li><a href="#contact">Contact</a></li>
                  <li>
                      <form method="post" action="meetup_search.php" id="searchform">
                      <div class="container" style="margin-top:5px;">
                        <div class="input-group">                            
                            <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" name="search_field" style="width:100px;"> 
                              <span class="input-group-btn">
                                <button class="btn btn-search" type="submit" name="find"><i class="fa fa-search fa-fw"></i> </button>
                              </span>                            
                        </div>
                      </div>
                      </form>
                  </li>
                    <?php if (!isset($_COOKIE["type"])): ?>
                        <li class="buy-tickets"><a href="sign_in.php">Sign in</a></li>
                        <li class="buy-tickets"><a href="sign_up.php">Sign up</a></li>
                    <?php else:?>
                        <li class="buy-tickets"><a href="add.php">Create meetup</a></li>
                        <li class="buy-tickets"><a href="user_profile.php"><?php echo $user_name ?><span class="badge">1             <?php
                            if($is_date){
                                echo "1";
                            }
                         ?>    
             </span></a></li>
                        <li class="buy-tickets"><a href="Logout.php">Log out</a></li>
                    <?php endif ?>
                </ul>
              </nav><!-- #nav-menu-container -->
          <?php } 
          elseif($GLOBALS['filename'] == 'sign'){ ?>
              <nav id="nav-menu-container">
                <ul class="nav-menu">
                  <li>
                      <form method="post" action="meetup_search.php" id="searchform">
                      <div class="container" style="margin-top:5px;">
                        <div class="input-group">                            
                            <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" name="search_field" style="width:250px;"> 
                              <span class="input-group-btn">
                                <button class="btn btn-search" type="submit" name="find"><i class="fa fa-search fa-fw"></i> </button>
                              </span>                            
                        </div>
                      </div>
                      </form>
                  </li>
                    <?php if (!isset($_COOKIE["type"])): ?>
                     <li class="buy-tickets"><a href="sign_in.php">Sign in</a></li>
                    <li class="buy-tickets"><a href="sign_up.php">Sign up</a></li>
                    <?php else:?>
                    <li class="buy-tickets"><a href="add.php">Create meetup</a></li>
                  <li class="buy-tickets"><a href="user_profile.php"><?php echo $user_name ?></a></li>
                  <li class="buy-tickets"><a href="Logout.php">Log out</a></li>
                    <?php endif ?>
                </ul>
              </nav><!-- #nav-menu-container -->
          <?php } 
          elseif($GLOBALS['filename'] == 'profile'){ ?>
              <nav id="nav-menu-container">
                <ul class="nav-menu">
                  <li>
                      <form method="post" action="index.php" id="searchform">
                      <div class="container" style="margin-top:5px;">
                        <div class="input-group">                            
                            <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" name="search_field" style="width:250px;"> 
                              <span class="input-group-btn">
                                <button class="btn btn-search" type="submit" name="find"><i class="fa fa-search fa-fw"></i> </button>
                              </span>                            
                        </div>
                      </div>
                      </form>
                  </li>
                    <?php if (!isset($_COOKIE["type"])): ?>
                     <li class="buy-tickets"><a href="sign_in.php">Sign in</a></li>
                    <li class="buy-tickets"><a href="sign_up.php">Sign up</a></li>
                    <?php else:?>
                    <li class="buy-tickets"><a href="add.php">Create meetup</a></li>
                    <li class="buy-tickets"><a href="user_profile.php"><?php echo $user_name ?></a></li>
                    <li class="buy-tickets"><a href="Logout.php">Log out</a></li>
                    <?php endif ?>
                </ul>
              </nav><!-- #nav-menu-container -->
          <?php } 
          elseif($GLOBALS['filename'] == 'about'){ ?>
              <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li>
                      <form method="post" action="meetup_search.php" id="searchform">
                      <div class="container" style="margin-top:5px;">
                        <div class="input-group">                            
                            <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" name="search_field" style="width:250px;"> 
                              <span class="input-group-btn">
                                <button class="btn btn-search" type="submit" name="find"><i class="fa fa-search fa-fw"></i> </button>
                              </span>                            
                        </div>
                      </div>
                      </form>
                  </li>
                    <?php if (!isset($_COOKIE["type"])): ?>
                     <li class="buy-tickets"><a href="sign_in.php">Sign in</a></li>
                    <li class="buy-tickets"><a href="sign_up.php">Sign up</a></li>
                    <?php else:?>
                  <li class="buy-tickets"><a href="user_profile.php"><?php echo $user_name ?></a></li>
                  <li class="buy-tickets"><a href="Logout.php">Log out</a></li>
                    <?php endif ?>
                </ul>
              </nav><!-- #nav-menu-container -->
          <?php } 
          elseif($GLOBALS['filename'] == 'meetups'){ ?>
              <nav id="nav-menu-container">
                <ul class="nav-menu">
                  <li class="menu-active"><a href="#meetup_details">Meetup details</a></li>
                  <li><a href="#comments">Comments</a></li>
                  <li><a href="#venue">Gallery</a></li>
                  <li><a href="#hotels">Hotels</a></li>
                    <?php if (!isset($_COOKIE["type"])): ?>
                        <li class="buy-tickets"><a href="sign_in.php">Sign in</a></li>
                        <li class="buy-tickets"><a href="sign_up.php">Sign up</a></li>
                    <?php else:?>
                        <li class="buy-tickets"><a href="user_profile.php"><?php echo $user_name ?></a></li>
                        <li class="buy-tickets"><a href="Logout.php">Log out</a></li>
                    <?php endif ?>
                </ul>
              </nav><!-- #nav-menu-container -->
          <?php } ?>
    </div>
</header>