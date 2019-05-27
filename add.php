<?php
    $GLOBALS['filename'] = 'sign';

    include ('Server.php');
    include ('Database.php');
    include ('nav.php');
?>
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
          <div class="col-md-6" style="height: 700px;">
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
                    <div class="form-group text-center">
                        <br>
                        Choose
                        <br>
                        <label style="margin: 10px 38px 10px 30px;">Exact Date</label> <input type="radio" name="choose" value="date">
                        <label style="margin: 10px 38px 10px 30px;">Week days</label><input type="radio" name="choose" value="everyweek" style="margin-left: 20px;">
                        <div class="date">
                            <input class="form-control" type="date" name="date">
                        </div>
                        <div class="week">
                            <hr>
                            <input type="checkbox" name="date[]" value="Monday"> <label>Monday</label>
                            <input type="checkbox" name="date[]" value="Tuesday"> <label>Tuesday</label>
                            <input type="checkbox" name="date[]" value="Wendesday"> <label>Wednesday</label>
                            <input type="checkbox" name="date[]" value="Thursday"> <label>Thursday</label><br>
                            <input type="checkbox" name="date[]" value="Friday"> <label>Friday</label>
                            <input type="checkbox" name="date[]" value="Saturday"> <label>Saturday</label>
                            <input type="checkbox" name="date[]" value="Sunday"> <label>Sunday</label>
                            <hr>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <input class="form-control" type="text" name="location" >
                    </div>
                    <div class="form-group">
                        <label>Sphere</label>
                        <select class="form-control" name = "sphere">
                            <option value="" selected disabled hidden>Choose here</option>
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