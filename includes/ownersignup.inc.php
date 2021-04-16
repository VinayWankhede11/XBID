<?php

// Checking that someone just try to register in appropiate way 
if(isset($_POST['submit'])){
    
    $name = $_POST["name"];
    $teamname = $_POST["teamname"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    // Different errors that can be possible
    if(emptyInputOwnerSignup($name,$teamname,$email,$contact,$password,$confirm_password) !== false){
    header("location: ../owenrsignup.php?error=emptyinput");
    exit();
    }
    if(invalidOwnerUid($teamname) !== false){
    header("location: ../owenrsignup.php?error=invaliduid");
    exit();
    }
    if(invalidOwnerEmail($email) !== false){
    header("location: ../owenrsignup.php?error=invalidemail");
    exit();
    }
    if(OwnerpwdMatch($password, $confirm_password) !== false){
    header("location: ../owenrsignup.php?error=passwordsdontmatch");
    exit();
    }
    // conn variable is used bcauz we find username is taken or not from database, so it requires connection
    if(OwneruidExists($conn, $teamname, $email) !== false){
    header("location: ../owenrsignup.php?error=usernametaken");
    exit();
    }

    createOwner($conn,$name,$teamname,$email,$contact,$password); 

}
else{
    // if it not works then we redirect to certain location
    header("location: ../owenrsignup.php");
    exit();
}