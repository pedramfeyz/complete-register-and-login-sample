<div class="widget">
     <h2>HELLO,<?PHP echo $user_data['fname']?>!</h2>
     <div class="inner">
     	<ul>
     		<li><a href="logout.php">log out</a></li>
                <li><a href="profile.php?username=<?php echo $user_data['username'];?>">Profile</a></li>
     		<li><a href="changepassword.php">change password</a></li>
                <li><a href="setting.php">setting</a></li>
                <form action='' method='post'>
                 <input type='file' name='profile'>
                </form>
                <?php
                   if(is_admin($user_data['id']))
                      {?>
                          <li><a href="mail.php">email</a></li> 
                       <?php
                      }
                ?>
     	</ul>
     </div>
</div>