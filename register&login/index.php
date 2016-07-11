<?php include 'core/init.php' ?>
<?php include 'includes/overall/overallheader.php'?>
<h1>Home</h1>
<p>just a template.</p>
<?php
if(is_admin($session_user_id)===true)
{ echo 'Admin';}
?>

<?php include 'includes/overall/overallfooter.php'?>          
    