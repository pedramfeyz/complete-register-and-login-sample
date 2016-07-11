<?php
 
function mail_users($subject,$body){
   $query=mysql_query("SELECT email,fname FROM users WHERE allow_email=1");
   while($row=mysql_fetch_assoc($query)){
       // $body="Hello" .$row['fname']. ",\n\n" .$body;
        email($row['email'],$subject,"Hello" .$row['fname']. ",\n\n" .$body);
    }
}


function is_admin($user_id){
    $user_id=(int)$user_id;//echo $user_id;
    return (mysql_result(mysql_query("SELECT COUNT(id) FROM users WHERE id='$user_id' AND type=1"),0)==1) ? true : false;
//echo mysql_result($query,0);

}

function recover($mode,$email){
$mode  =sanitize($mode);
$email =sanitize($email);
   $user_data=user_data(user_id_from_email($email),'id','fname','username');
//return $user_data['username'];
   if($mode=='username')
       {
        email($email,'Your username',"Helllo " .$user_data['fname']. ",\n\nYour username is: " .$user_data['username']. "  ");
    
       }else if($mode='password')
                   {
                    $generated_password=substr(md5(rand(999,999999)),0,8);
                    update_password($user_data['id'],$generated_password);
                    email($email,'Your password',"Helllo " .$user_data['fname']. ",\n\nYour password is: " .$generated_password. "  ");
                   }
}


function update_user($update_data){
global $session_user_id;
$update=array();
foreach($update_data as $field=>$data)
   {
     $update[]=''.$field.'=\''.$data.'\'';//print_r ($update);
   }
     echo implode(',',$update); 
    mysql_query("UPDATE users SET ".implode(',',$update)." WHERE id=$session_user_id") or die(mysql_error());
}


function activate($email,$email_code){
$email     =mysql_real_escape_string($email);
$email=strip_tags($email);
$email_code=mysql_real_escape_string($email_code);

if(mysql_result(mysql_query("SELECT COUNT('id') FROM users WHERE email='$email' AND email_code='$email_code' AND active=0"),0)==1){
mysql_query("UPDATE users SET active=1 WHERE email='$email'");
return true;
}else {  return false;}
}



function user_id_from_username($username){
$query=mysql_query("SELECT id FROM users WHERE username='$username'");
return mysql_result($query, 0);
}



function user_id_from_email($email){
$query=mysql_query("SELECT id FROM users WHERE email='$email'");
return mysql_result($query, 0);
}



function email($to,$subject,$body){
mail($to,$subject,$body,"From: webmaster@example.com");
}



function register_user($register_data){
	$register_data[1]=md5($register_data[1]);
    $data='\''.implode('\',\'', $register_data).'\'';
     //print_r($data);
	$query="INSERT INTO users (username,password,fname,lname,email_code,email) VALUES ($data)";
	mysql_query($query);
       $to=$register_data[5];
       $subject="Active your account";
       $body=
"Hello " .$register_data[2]. "\n\n You need to active your account,so please use the link below:\n\n  http://pedram-feyz.com/register&login/activate.php?email=" .$register_data[5]. "&email_code=" .$register_data[4]. "&e=" .$register_data[5]. " \n\n"
;

    email($to,$subject,$body);
}



function user_count(){
	$query=mysql_query('SELECT count(id) FROM users WHERE active=1');
	return mysql_result($query, 0);
}



function user_data($user_data){
     $data=array();
     $user_id=(int)$user_data;
    // echo $user_id .'<br>';
    $func_num_args=func_num_args();
     $func_get_args=func_get_args();
      if($func_num_args>1){
     	unset($func_get_args[0]);
     $fields=implode(',', $func_get_args);
     // echo $fields;
      $data=mysql_fetch_assoc(mysql_query("SELECT $fields FROM users WHERE      id=$user_id"));
      
      return $data;
// print_r($data);
      //die();
 /* while ($row=mysql_fetch_assoc($query)) 
        {
          $dbusername=$row['fname'];
          $dbpassword=$row['password'];
        }
        echo $dbusername;echo  $dbpassword;*/
     }
}



function logged_in(){
	return (isset($_SESSION['user_id'])) ? true : false;
}



function user_exists($username)
{
   $query=mysql_query("SELECT * FROM users WHERE username='$username'");
   $numrows=mysql_num_rows($query);
   //if ($numrows!=0)mysql_result($query, 0)==1
   return ($numrows!=0) ? true :false;
};



function email_exists($email)
{  
   $email=strip_tags($email);
   $query=mysql_query("SELECT * FROM users WHERE email='$email'");
   $numrows=mysql_num_rows($query);//echo $numrows;
   //if ($numrows!=0)mysql_result($query, 0)==1
   return ($numrows!=0) ? true :false;
};



function user_active($username){
$query=mysql_query("SELECT active FROM users WHERE username='$username'");
$record=mysql_fetch_assoc($query);
//echo '<br>'.$record['active'];
return ($record['active']==1) ? true :false;
}



function login($username,$password) {
$password=md5($password);
//echo $password;
$query=mysql_query("SELECT * FROM users WHERE (username='$username' AND password='$password')");
$numrows=mysql_num_rows($query);
$record=mysql_fetch_assoc($query);//echo $record['id'];
return ($numrows!=0) ? $record['id'] :false;
//echo $numrows;
}



function protect_page(){
	if(logged_in()===false){ header('Location:protected.php'); exit();}
}


function admin_protect(){
global $user_data;
    if(is_admin($user_data['id'])===false){
                              header('Location:index.php'); exit();
                             }

}


function logged_in_redirect(){
	if(logged_in()===true){ header('Location:index.php'); exit();}
}


function output_errors($errors)
{return '<ul><li>'.implode('</li><li>', $errors).'</ul></li>';}



function password_match($id,$password){
	$password=md5($password);
//echo $password;
$query=mysql_query("SELECT * FROM users WHERE (id='$id' AND password='$password')");
$numrows=mysql_num_rows($query);
return ($numrows!=0) ? true :false;}
function update_password($id,$new_password){
$new_password=md5($new_password);	
$query=mysql_query("UPDATE users SET password='$new_password'  WHERE id ='$id'"); 
}




function array_sanitize($item){
  $item=htmlentities(strip_tags(mysql_real_escape_string($item)));
}

function sanitize($data){
  return htmlentities(strip_tags(mysql_real_escape_string($data)));
}
?>