<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['uid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_GET['polid']))
{
$userid=$_SESSION['uid'];
$pid=$_GET['polid'];
$status=0;
$policynumber = mt_rand(100000000, 999999999);
$ret=mysqli_query($con,"select ID from tblpolicyholder where UserId='$userid' and PolicyId='$pid'");
$row=mysqli_fetch_array($ret);
if($row >0)
{
 $msg="You already applied for this Policy. "; 
} else {


$query=mysqli_query($con,"insert into  tblpolicyholder(UserId,PolicyId,PolicyStatus,PolicyNumber) value('$userid','$pid','$status','$policynumber')");
$msg="You have successfully applied for Policy. ";

}
}
?>






<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta -->
 <meta name="description" content="Insurance Management System in PHP and MySQL">
    <meta name="author" content="Sarita Pandey">

    <title>Insurance Management System |   Policy History </title>

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
          <h2 class="az-content-title mg-b-5 mg-b-lg-8"> Policy History !</h2>
        </div>
       <!-- az-dashboard-header-right -->
      </div><!-- az-content-header -->
      <div class="az-content-body">
      

     <div class="az-content">
      <div class="container">
        <div class="az-content-body">
          <div class="az-content-breadcrumb">
            <span>Insurance </span>
            <span> Policy History</span>
          </div>
  

          <div class="az-content-label mg-b-5"> Policy History</div>
<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
          <div class="table-responsive">
            <table class="table table-bordered mg-b-0">
              <thead>
                <tr>
                  <th>S.NO</th>
                  <th>Policy Name</th>
                  <th>Policy Number</th>
                  <th>Category Name</th>
                   <th>SubCategory Name</th>
                   
                   <th>Sum Assured</th>
                   <th>Premium</th>
                   <th>Tenure</th>
                  <th>Apply Date</th>
                  <th>Status</th>
                </tr>
              </thead>
              <?php
           $uid=$_SESSION['uid'];
$ret=mysqli_query($con,"select category.CategoryName as catname,tblsubcategory.SubcategoryName as subcat, tblpolicy.PolicyName,tblpolicyholder.PolicyApplyDate as applydate,tblpolicyholder.PolicyNumber, tblpolicy.ID,tblpolicy.Sumassured,tblpolicy.Premium,tblpolicy.Tenure,tblpolicyholder.PolicyStatus,tblpolicyholder.ID as plyid  from tblpolicy inner join category on category.ID=tblpolicy.CategoryId inner join tblsubcategory on  tblsubcategory.id=tblpolicy.SubcategoryId  join tblpolicyholder on tblpolicyholder.PolicyId=tblpolicy.ID where  tblpolicyholder.UserId='$uid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
              <tbody>
                <tr>
                  <td><?php echo $cnt;?></td>
                       <td><?php  echo $row['PolicyName'];?></td>
                         <td><?php  echo $row['PolicyNumber'];?></td>
                  <td><?php  echo $row['catname'];?></td>
                  <td><?php  echo $row['subcat'];?></td>
         
                  <td><?php  echo $row['Sumassured'];?></td>
                  <td><?php  echo $row['Premium'];?></td>
                  <td><?php  echo $row['Tenure'];?></td>
                   <td><?php  echo $row['applydate'];?></td>
                  <td><?php 
                  if($row['PolicyStatus']=="0"){
echo "waiting for approval";
} 

 if($row['PolicyStatus']=="1"){
  echo "approved";
}
    
if($row['PolicyStatus']=="2"){
  echo "Disapproved";
}
                    ?>
                      
<?php if($row['PolicyStatus']=="1"){ ?>
<a href="download-policy.php?pid=<?php  echo $row['plyid'];?>" title="Download Policy"> Download </a>
<?php } ?>

                    </td>
                </tr>
                <?php 
$cnt=$cnt+1;
}?>
               
              </tbody>
            </table>
          </div>

            </div><!-- card-dashboard-five -->
          </div>
    
        </div><!-- row -->
      </div><!-- az-content-body -->
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
<?php }  ?>