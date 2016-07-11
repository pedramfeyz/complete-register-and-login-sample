<?php
ini_set('session.save_path',getcwd().'/temp'); 
session_start();
session_destroy();
header('Location: index.php');
?>