<?php
    $GLOBALS['filename'] = 'sign';

    include ('Server.php');
    include ('Database.php');
    include ('nav.php');
?>
<body>
  <main id="main" class="main-page">

    <!--==========================
      Speaker Details Section
    ============================-->
    <section id="speakers-details" class="wow fadeIn">
      <div class="container">
        <div class="section-header">
          <h2>Add new meetup</h2>
          <p>Create own awesome community.</p>
        </div>

        <div class="row" >
          <div class="col-md-3"></div>
          <div class="col-md-6" style="height: 600px;">
            <div class="details" >
                <div class="social"></div>
                <form method="post" action = "Server.php">
                    <input type="hidden" name="organizer_id" value="<?php echo $user_id?>">
                    <div class="form-group" >
                        <label>Name</label>
                        <input class="form-control" type="text" name="name">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="5" cols="50" name="description" ></textarea>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <br><input type="radio" name="choose" value="date">on Date
                        <br><input type="radio" name="choose" value="everyweek">Every week
                        <div class="date">
                            <input class="form-control" type="date" name="date">
                        </div>
                        <div class="week">
                            <input type="checkbox" name="date" value="Monday"> Monday
                            <input type="checkbox" name="date" value="Tuesday"> Tuesday
                            <input type="checkbox" name="date" value="Wendesday"> Wednesday
                            <input type="checkbox" name="date" value="Thursday"> Thursday
                            <input type="checkbox" name="date" value="Friday"> Friday
                            <input type="checkbox" name="date" value="Saturday"> Saturday
                            <br><input type="checkbox" name="date" value="Sunday"> Sunday
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <input class="form-control" type="text" name="location" >
                    </div>
                    <div class="form-group">
                        <label>Sphere</label>
                        <select class="form-control" name = "sphere">
                            <option value="it">IT</option>
                            <option value="hackaton">Hackaton</option>
                            <option value="marathon">Marathon</option>
                            <option value="sport">Sport</option>
                            <option value="mobile">Mobile</option>
                            <option value="data science">Data Science</option>
                            <option value="activities">Activities</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="text-center" style="margin:20px 0 10px 0;">
                        <button type="submit" class="btn" name="next">Next</button>
                    </div>
                </form>                
            </div>
              
          </div>
            <div class="col-md-3">
            
          </div>
          
        </div>
      </div>

    </section>

  </main>
       
<?php include ('footer.php'); ?>
</body>

</html>
<script>
    $('input[name="choose"]').click(function(e) {
        if(e.target.value === 'date') $('.date').show();
        else $('.date').hide();
        if(e.target.value === 'everyweek') $('.week').show();
        else $('.week').hide();
    })

    $('.date').hide();
    $('.week').hide();
</script>