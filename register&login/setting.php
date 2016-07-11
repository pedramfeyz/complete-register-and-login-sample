<?php
include 'core/init.php' ;
protect_page();
ob_start();
include 'includes/overall/overallheader.php'; 

if(empty($_POST)===false) 
  {
    $required_fields=array('fname','email');
    foreach($_POST as $key=>$value)
    {
     if(empty($value) && in_array($key,$required_fields)===true)
      {
        $errors[]='fields marked with asterisk are requierd';
        break 1;
      }
    }
        if(empty($errors)===true)
          {
            if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)===false)
               {
                $errors[]='A valid email is requierd';
               } else if(email_exists($_POST['email'])===true && $user_data['email']!==$_POST['email'])
                         {
                          $errors[]='Sorry, the email \''.$_POST['email'].'\' is already in use';
                         }
          }

}
?> 
<h1>Setting</h1>

<?php
if(isset($_GET['success'])===true && empty($_GET['success'])===true)
{
echo 'Your datails have been updated!';
}else
{
if(empty($_POST)===false && empty($errors)===true)
{
/*$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];*/

$update_data=array(
'fname'       =>$_POST['fname'],
'lname'       =>$_POST['lname'],
'email'       =>$_POST['email'],
'allow_email' =>($_POST['allow_email']=='on') ? 1: 0
);
//print_r($update_data);
 update_user($update_data);
 header('Location:setting.php?success');
exit();
}else if(empty($errors)===false)
    {
     echo output_errors($errors);
    }
?>
<form action='' method='post'>
  <ul>
      <li>First name:*<br><input type='text' name='fname' value='<?php echo $user_data['fname']?>'></li>
      <li>Last name :<br><input type='text' name='lname' value='<?php echo $user_data['lname']?>'></li>
      <li>email     :*<br><input type='email' name='email' value='<?php echo $user_data['email']?>'></li>
      <li>           <input type='checkbox' name='allow_email' <?php if($user_data['allow_email']==1) {echo 'checked="checked"';} ?> > would you like to recieve email from us ?</li>
      <li><input type='submit' value='update'></li>
 </ul>

</form>
 
<?php
}
include 'includes/overall/overallfooter.php';
?>  