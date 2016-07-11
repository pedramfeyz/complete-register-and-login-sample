<?php 
include 'core/init.php' ;
protect_page();
ob_start();
include 'includes/overall/overallheader.php';

if(isset($_GET['username'])===true && empty($_GET['username'])===false)
  {
    $username=$_GET['username'];
    //echo $username;
       if(user_exists($username))
            {
                 $id          =user_id_from_username($username);//echo $id;
                 $profile_data=user_data($id,'fname','lname','email');//print_r($profile_data);
                   
                ?>
                    <h1><?php echo $profile_data['fname'];?>'s Profile</h1>
                     <p><?php echo $profile_data['email'];?></p>
                <?php
            }else
                  {echo 'Sorry, that user dosen\'t exits';}
  } else
     {echo 'aa';
       header('Location:index.php');
       exit();
     }
   
include 'includes/overall/overallfooter.php'?>          
    
