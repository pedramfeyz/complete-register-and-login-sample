<?php
 include 'core/init.php' ;
 ob_start();
 logged_in_redirect();
 include 'includes/overall/overallheader.php';
 if(empty($_POST)===false)
 {
 	//$required_fields=array('username', 'password','password_again','first_name','email');
 	//print_r($_POST);
 	if (empty($_POST['username']) ||empty($_POST['password'])||empty($_POST['password_again'])||empty($_POST['first_name'])||empty($_POST['email'])) 
 	{
 		$errors[]='fields marked with asterisk are requierd';
 	} else
 	    {
 	    	if(user_exists($_POST['username'])===true)
 	    	 {
 	    		$errors[]='Sorry, the username \''.$_POST['username'].'\' is already taken';
 	    	 }
 	    	else
 	    	{
 	    	 if (preg_match("/\\s/", $_POST['username'])==true)
 	    	    {
 	    		$errors[]='Your Username must not contain any space';
 	    	    }
 	    	    else
 	    	      { if (strlen($_POST['password'])<2 || strlen($_POST['password'])>15) 
 	    	         {
 	    	      	   $errors[]='Your password must be betwwen 6 till 15 characters';
 	    	         }
 	    	         else
 	    	           {
 	    	           	if ($_POST['password'] !==$_POST['password_again']) 
 	    	           	{
 	    	           		$errors[]='Your password do not match';
 	    	           	}
 	    	           	else
 	    	           	 {
                          if (!(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)))
                           {
                          	$errors[]='A valid email is requierd';
                           }
                          else
                            {
                            if (email_exists($_POST['email'])===true)
                              {
                            	$errors[]='Sorry, the email \''.$_POST['email'].'\' is already in use';
                              }
                            }
 	    	           	 }

 	    	           }

 	    	      }
 	        }

 	    }

 }
// print_r($errors);
 ?>
<h1>Register</h1>
<?php
if (isset($_GET['success']) && empty($_GET['success'])) 
{
	echo "You\'ve benn registered successfully!please check your email to active your account";
}

else
{	
if ((empty($_POST)===false)&&empty($errors)===true)
 {
	$username=$_POST['username'];
	$password=$_POST['password'];
	$first_name=$_POST['first_name'];
	$last_name=$_POST['last_name'];
	$email=$_POST['email'];
	$email_code=md5($_POST['username']+microtime());
	$register_data=array($username,$password,$first_name,$last_name,$email_code,$email);

    register_user($register_data);
    header('Location: register.php?success');
    exit();

 } 
 else 
    if (empty($errors)===false)
	# code...
    {
	echo output_errors($errors);
    }
?>

<form action="" method="post">
	<ul>
		<li>Username*:<br><input type="text" name="username"></input></li>
		<li>Password*:<br><input type="password" name="password"></input></li>
		<li>Password again*:<br><input type="password" name="password_again"></input></li>
		<li>Firs name*:<br><input type="text" name="first_name"></input></li>
		<li>Last name:<br><input type="text" name="last_name"></input></li>
		<li>Email*:<br><input type="email" name="email"></input></li>
		<li><input type="submit" name='submit' value="Register"></input></li>
	</ul>
</form>
<?php
}
 include 'includes/overall/overallfooter.php'?>          
    