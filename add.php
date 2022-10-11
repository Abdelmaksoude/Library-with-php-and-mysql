<?php
    $error_fields = array();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(! (isset ($_POST['name']) && !empty($_POST['name']))){
        $error_fields[] = "name";
    }

    if(! (isset ($_POST['email']) && filter_input(INPUT_POST , 'email', FILTER_VALIDATE_EMAIL))){
        $error_fields[] = "email";
    }
    
    if(! (isset ($_POST['password']) && strlen($_POST['password']) > 5)){
        $error_fields[] = "password";
    }
    if(!$error_fields){
        $conn = mysqli_connect("localhost" , "root" , "" , "mysql");
        if(! $conn){
        echo mysqli_connect_error();
        exit;
        }
        
    $name = mysqli_escape_string($conn, $_POST['name']);
    $email = mysqli_escape_string($conn, $_POST['email']);
    // $password = sha1($_POST['password']);
    $password = mysqli_escape_string($conn, $_POST['password']);
    $admin = (isset($_POST['admin'])) ? 1 : 0 ;
    // $uploads_dir = $_SERVER['DOCUMENT_ROOT'];
    // $avatar = '';
    // if($_FILES["avatar"]['error'] == UPLOAD_ERR_OK){
    //     $tmb_name = $_FILES["avatar"]["tmb_name"];
    //     $avatar = basename($_FILES["avatar"]["name"]);
    //     move_uploaded_file($tmb_name, "$uploads_dir/.$name.$avatar");
    // }
    // else{
    //     echo "File can't be uploaded";
    //     exit;
    // }
    $query = "INSERT INTO abdelmaksoud (`name` , `email` , `password` , `admin`) VALUES ('".$name."' , '".$email."' , '".$password."' , '".$admin."')";
    if(mysqli_query($conn , $query)){
        header("Location: list.php");
        exit;
    }
    else{
        echo mysqli_error($conn);
    }
    mysqli_close($conn);
    }
}
?>
<html>
<head>
    <title>Admin :: List Users</title>
    <style>
        label
        {
            color: blue;
            font-weight: bold;
        }
        input:first-of-type , .second
        {
            border-radius: 5px;
            border: 1px solid gray;
            margin-bottom: 5px;
        }
        input:last-of-type
        {
            margin-top: 5px; 
            color: white; 
            background-color: rgb(72, 69, 69); 
            cursor: pointer; 
            border: 1px solid gray; 
            border-radius: 5px; 
            width: 70px;
            padding: 5px;
            transition: 0.5s ease-in-out all;
        }
        input:last-of-type:hover
        {
            background-color: white;
            color: black;
        }
    </style>
</head>
<body>
<h1 style="text-align: center; color: green;">Add User</h1>
    <form method="post" enctype="multipart/form-data" style="text-align: center; background-color: beige; width: 250px; margin: 20px auto; padding: 10px;">
        <label>Name</label>
        <input type="text" name="name" id="name" value="<?= (isset($_POST['name'])) ? $_POST['name'] : '' ?>"><?php if(in_array("name", $error_fields)) echo "* please enter your name"; ?><br>
        <label>Email</label>
        <input class="second" type="text" name="email" id="email" value="<?= (isset($_POST['email'])) ? $_POST['email'] : '' ?>"><?php if(in_array("email", $error_fields)) echo "* please enter your email"; ?><br>
        <label>Password</label>
        <input class="second" type="text" name="password" id="password" value="<?= (isset($_POST['password'])) ? $_POST['password'] : '' ?>"><?php if(in_array("password", $error_fields)) echo "* please enter your password not less than 6 characters"; ?><br>
        <input class="second" type="checkbox" name="admin" <?= (isset($_POST['admin'])) ? 'checked':'' ?>>Admin <br>
        <!-- <label>Avater</label>
        <input type="file" id="avatar" name="avatar"><br> -->
        <input type="submit" value="Add User" name="submit">
    </form>
    </body>
</html>