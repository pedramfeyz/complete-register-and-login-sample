<?php include 'core/init.php' ?>
<!--include 'includes/overall/overallheader.php' -->
<!DOCTYPE html>
<html>
<!-- include 'includes/head.php';?> -->
<head>
	<title>Website Title</title>
	<meta charset="utf-8">
	<link rel="stylesheet"  href="css/screen.css">
</head>


<body>
   <!-- include  'includes/header.php'; ?> -->
    <header>
     	<h1 class="logo">Logo</h1>
     	<!-- include 'includes/navmenu.php'?>-->
     	<nav>
     		<ul>
     			<li><a href="index.php">Home</a></li>
     			<li><a href="downloads.php">Downloads</a></li>
     			<li><a href="forum.php">Forum</a></li>
     			<li><a href="contact.php">Contact us</a></li>
     		</ul>
</nav>
      <div class="clear"></div>	
     </header>

    
     <div id="container">
      <!-- include    'includes/aside.php'; ?> -->
<aside>
<?php include 'includes/widgets/login.php'?>    		
</aside>

    
<h1>Home</h1>
<p>just a template.</p>
<?php
if(isset($_SESSION['user_id'])){
echo 'logged in';unset($_SESSION['user_id'])//session_destroy()
;}else{echo 'not logged in'.$_SESSION['user_id02'];}
?>
</div>
    <footer>
     	&copy;phpacademy.org 2011. All rights reserved
 </footer>
</body>
</html>