<?php
$host="localhost";
$username="root";
$password= "";
$database="todo_list_db";
$conn= new mysqli($host,$username,$password,$database);
if($conn ->connect_error){
    die("error connecting to".$conn ->connect_error);
    
};
echo"connection successful";




?>