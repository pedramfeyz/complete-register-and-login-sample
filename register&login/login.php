<?php 
include 'core/init.php';

if (empty($_POST)===false) {
	$username=$_POST['username'];
	$password=$_POST['password'];
	//echo "username:".$username."<br>password:".$password." <br>";
	if (empty($username) || empty($password)) {
		$errors[]='You need to enter username and password';
		//echo "You need to enter username and password";
	                                          }
        else if (user_exists($username)===false){
		$errors[]='We can\'t find that username. Have you registerd?';
		
	                                        }
        else if (user_active($username)===false) {
           $errors[]='you haven\'t activated your account!';
                                                 }
               else {
                      $login=login($username,$password); 
                       if($login===false) {
               $errors[]='That username/password combination is incorrect';                           
                                          }
                          else{//echo $login;
                           $_SESSION['user_id']=$login;
                            $_SESSION['security']=(int)3;
                                       header('Location: index.php');
                              exit();
                              }                            
                     };
	       //print_r($errors);
                           }
     include 'includes/overall/overallheader.php';
     if(empty($errors)===false){
    ?>  <h2>we tried to log you in,but...</h2> 
    <?php
     echo "username:".$username."<br>password:".$password." <br>";
     echo output_errors($errors);     }                 
     include 'includes/overall/overallfooter.php';                         
?>