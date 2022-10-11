<?php
    $error_fields = array();
    $conn = mysqli_connect("localhost" , "root" , "" , "mysql");
        if(! $conn){
        echo mysqli_connect_error();
        exit;
        }

        $id = filter_input(INPUT_GET , 'id' , FILTER_SANITIZE_NUMBER_INT);
        $select = "SELECT * FROM abdelmaksoud WHERE abdelmaksoud.`id`=" .$id. " LIMIT 1";
        $result = mysqli_query($conn , $select);
        $row = mysqli_fetch_assoc($result);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(! (isset ($_POST['name']) && !empty($_POST['name']))){
        $error_fields[] = "name";
    }

    if(! (isset ($_POST['email']) && filter_input(INPUT_POST , 'email', FILTER_VALIDATE_EMAIL))){
        $error_fields[] = "email";
    }
    
    // if(! (isset ($_POST['password']) && strlen($_POST['password']) > 5)){
    //     $error_fields[] = "password";
    // }
    if(!$error_fields){
    $id = filter_input(INPUT_GET , 'id' , FILTER_SANITIZE_NUMBER_INT);
    $name = mysqli_escape_string($conn, $_POST['name']);
    $email = mysqli_escape_string($conn, $_POST['email']);
    $password = (!empty($_POST['password'])) ? sha1($_POST['password']) : $row['password'];
    $admin = (isset($_POST['admin'])) ? 1 : 0 ;
    $query = "UPDATE abdelmaksoud SET `name` = '".$name."' , `email` = '".$email."' , `password` = '".$password."' , `admin` = " . $admin. "  WHERE abdelmaksoud.`id` = ". $id;
    if(mysqli_query($conn , $query)){
        header("Location: list.php");
        exit;
    }
    else{
        echo mysqli_error($conn);
        }
    }
}
mysqli_free_result($result);
mysqli_close($conn);
?>
<html>
<head>
    <title>Admin :: Edit Users</title>
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
<h1 style="text-align: center; color: Red;">Edit User</h1>
    <form method="post" style="text-align: center; background-color: beige; width: 250px; margin: 20px auto; padding: 10px;">
        <label>Name</label>
        <input type="hidden" name="id" value="<?= (isset($row['id'])) ? $row['id']: '' ?>">
        <input class="second" type="text" name="name" id="name" value="<?= (isset($row['name'])) ? $row['name'] : '' ?>"><?php if(in_array("name", $error_fields)) echo "* please enter your name"; ?><br>
        <label>Email</label>
        <input class="second" type="text" name="email" id="email" value="<?= (isset($row['email'])) ? $row['email'] : '' ?>"><?php if(in_array("email", $error_fields)) echo "* please enter your email"; ?><br>
        <label>Password</label>
        <input class="second" type="text" name="password" id="password" value="<?= (isset($row['password'])) ? $row['password'] : '' ?>"><?php if(in_array("password", $error_fields)) echo "* please enter your password not less than 6 characters"; ?><br>
        <input type="checkbox" name="admin" <?= (isset($row['admin'])) ? 'checked':'' ?>>Admin <br>
        <input type="submit" value="Edit User" name="submit">
    </form>
    </body>
</html>