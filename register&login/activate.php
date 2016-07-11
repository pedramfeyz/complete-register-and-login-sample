<?php 
include 'core/init.php' ; ob_start();
logged_in_redirect();
include 'includes/overall/overallheader.php';

if(isset($_GET['email'],$_GET['email']))
  {
     $email     =trim($_GET['email']);
     $email_code=trim($_GET['email_code']);//echo $email;echo $email_code;

     if(email_exists($email)===false)
        {
          $errors[]='Oops,we could\'nt find that email address';
        }
        else if(activate($email,$email_code)===false)
             {
              $errors[]='We had problems activating your account';
             }else {echo 'Your account has been activated successfully';}

  }   else
       {
         header('Location:index.php');
         exit();
       }

 if (empty($errors)===false)
	# code...
    {
	echo output_errors($errors);
    }
include 'includes/overall/overallfooter.php';
?>  