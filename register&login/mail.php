<?php
include 'core/init.php';
protect_page();
admin_protect();
include 'includes/overall/overallheader.php'
?>
<h1>Email</h1>
<p>Email to all users.</p>

<?php
if(isset($_GET['success'])===true && empty($_GET['success'])===true)
  {
    echo 'Email has sent';
  }else
   {
     if(empty($_POST)===false)
        {
          if(empty($_POST['subject']) || empty($_POST['body'])){$errors[]='please fill the items';}
          if(empty($errors)===false){echo output_errors($errors);}
             else{
                  mail_users($_POST['subject'],$_POST['body']);  
                  header('Location:mail.php?success');
                  exit();
                 }
        }
?>

<form action='' method='post'>
   <ul>
         subject:*<br><li><input type='text' name='subject' ></li>
         body:*<br>   <li><textarea  name='body' ></textarea></li>
                      <li><input type='submit' value='send' ></li>
   </ul>
</form>

<?php
   }   
 include 'includes/overall/overallfooter.php'?>          
    