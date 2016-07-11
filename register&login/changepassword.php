<?php
include 'core/init.php' ;
 protect_page();ob_start();
 //if(logged_in()===true)
 //{ //echo $_SESSION['user_id'];
include 'includes/overall/overallheader.php'?>   
<h1>Changging password</h1>
<?php if ((isset($_GET['success']) && empty($_GET['success']))==false)
{ ?>
 <form action='' method='POST'>
  <ul>
     <li>Please enter your current password:<br>
     <input type='text' name='old_password' /></li>
     <li><input type='SUBMIT' name='submit' ></li>
  </ul>
</form>
<?php   
if (isset($_POST['submit']))
   {
	if (password_match($_SESSION['user_id'] ,$_POST['old_password'])===false)
	 {
		echo "Password is not correct";
	echo 	--$_SESSION['security'];
		if($_SESSION['security']<=0){header('Location:logout.php');}
     }
       else
        {
         header('Location:changepassword.php?success');
        }
    }
}
     else
     {?>
       <form action='' method='post'>
  <ul>
     <li>Please enter your new password:<br>
     <input type='text' name='new_password' /></li>
     <li>Please enter your new password again:<br>
     <input type='text' name='new_password_again' /></li>
     <li><input type='SUBMIT' name='enter' ></li>
  </ul>
</form>
     <?php
     if (isset($_POST['enter']))
          {
          	if (strlen($_POST['new_password'])<2 || strlen($_POST['new_password'])>15) 
 	    	         {
 	    	      	   echo 'Your password must be betwwen 2 till 15 characters';
 	    	         }
 	    	         else
 	    	           {
 	    	           	  if ($_POST['new_password'] !==$_POST['new_password_again']) 
 	    	               {
 	    	           	  echo	'Your password do not match';
 	    	                }
 	    	                else
 	    	                   {
 	    	                  	update_password($_SESSION['user_id'],$_POST['new_password']);
 	    	                     	echo "password changed";
 	    	                   }
          		
                        
                        }
          } }   

include 'includes/overall/overallfooter.php';
//}
//else header('Location:index.php');
?>  