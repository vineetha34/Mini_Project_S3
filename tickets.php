<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['uid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit']))
  {
    $uid=$_SESSION['uid'];
    $sub=$_POST['subject'];
    $noi=$_POST['issue'];
    
    $des=$_POST['description'];
    
     
    $query=mysqli_query($con, "insert into tblticket(UserId, Subject, NatureofIssue, Description) value('$uid', '$sub','$noi','$des')");
    if ($query) {
    $msg="Ticket has been raised.";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }

  
}
  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta -->
 <meta name="description" content="Insurance Management System in PHP and MySQL">
    <meta name="author" content="Sarita Pandey">

    <title>Ticket Form!!</title>

    <!-- vendor css -->
    <link href="../lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../lib/typicons.font/typicons.css" rel="stylesheet">
    <link href="../lib/morris.js/morris.css" rel="stylesheet">
    <link href="../lib/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link href="../lib/jqvmap/jqvmap.min.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="../css/azia.css">

 

  </head>
  <body class="az-body az-body-sidebar">
      <!-- -sidebar -->
<?php include_once('includes/sidebar.php');?>
  <!-- -sidebar -->
    <div class="az-content az-content-dashboard-two">
     
     <!-- -header -->
<?php include_once('includes/header.php');?>
  <!-- -header -->

      <div class="az-content-header d-block d-md-flex">
        <div>
          <h2 class="az-content-title mg-b-5 mg-b-lg-8">Ticket Form !</h2>
        </div>
       <!-- az-dashboard-header-right -->
      </div><!-- az-content-header -->
      <div class="az-content-body">
     

        <div class="row row-sm mg-b-20 mg-lg-b-0">
          <div class="col-md-12 col-xl-7">
            <div class="card card-table-two">
              <h6 class="card-title"> Fill the Info</h6>
            <form method="post">
        <p style="font-size:16px; color:red" align="left"> <?php if($msg){
    echo $msg;
  }  ?> </p>
         <div class="d-flex flex-column wd-md-500 pd-30 pd-sm-40 bg-gray-200">
               
<div class="form-group">
                  <label class="form-label">Subject: <span class="tx-danger">*</span></label>
                  <input type="text" name="subject" class="form-control wd-450" required="true">
                </div>
                
<div class="form-group">
                  <label class="form-label">Nature of Issue: <span class="tx-danger">*</span></label>
                  <select name="issue" class="form-control wd-450" required="true">
                    <option value="">Nature Of Issue</option>
                    <option value="payment issue" selected="true">Payment Of Issue</option>
                    <option value="policy of issue">Policy Of Issue</option>
                    <option value="claim  issue">Claim Issue</option>
                    <option value="profile wrong updation">Profile Wrong Updation</option>
                    <option value="Other">Other</option>

                  </select>
                </div>

                <div class="form-group">
                  <label class="form-label">Description: <span class="tx-danger">*</span></label>
                  <textarea name="description" placeholder="Desribe your Issue" rows="12" cols="14" class="form-control wd-450" required="true"></textarea>
                </div>

            
            

            <div class="form-group" align="center">
              <button type="submit" name="submit" class="btn btn-az-primary pd-x-20">Submit</button>
            </div>
            </div></div>
              </div><!-- d-flex -->
            
          </form>

            </div><!-- card-dashboard-five -->
          </div>
    
       <!-- az-content-body -->
    <!-- footer -->
    <?php include_once('includes/footer.php');?>
    </div><!-- az-content -->


    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/ionicons/ionicons.js"></script>
    <script src="../lib/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="../lib/raphael/raphael.min.js"></script>
    <script src="../lib/morris.js/morris.min.js"></script>
    <script src="../lib/jqvmap/jquery.vmap.min.js"></script>
    <script src="../lib/jqvmap/maps/jquery.vmap.usa.js"></script>

    <script src="../js/azia.js"></script>
    
  </body>
</html>
<?php  } ?>
