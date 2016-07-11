<?php
include 'core/init.php';
ob_start();
logged_in_redirect();
include 'includes/overall/overallheader.php';
?>
<h1>Recover</h1>
<?php     
if(isset($_GET['success']) && empty($_GET['success']))
{
 echo '<h3>Thank you,  we\'ve emailed you </h3>';

}
else
{
$mode_allowed=array('username','password');
if(isset($_GET['mode'])===true && in_array($_GET['mode'],$mode_allowed)===true)
{
echo $_GET['mode']. "<br>";
           if(isset($_POST['email']) && empty($_POST['email'])===false)
              {
                if(email_exists($_POST['email']))
                 {
                       recover($_GET['mode'],$_POST['email']);
                       header('Location:recover.php?success');
                       exit(); 
                 }else 
                      {
                          echo '<p>Oops,we couldn\'t find email addree</p>';
                      }
              }
            ?>
            <form action='' method='post'>
             <ul>
                 <li>
                     PLease enter your your email address:<br><input type='email' name='email'>
                 </li>
                 <li><input type='submit' value='recover'></li>
             </ul>
            </form>
            <?php
}else
    {header('Location:index.php');
     exit();
    }
}
?>

<?php include 'includes/overall/overallfooter.php'?>   