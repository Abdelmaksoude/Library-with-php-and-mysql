<?php
    session_start();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $conn = mysqli_connect("localhost" , "root" , "" , "mysql");
        if(! $conn){
        echo mysqli_connect_error();
        exit;
        }
        $email = mysqli_escape_string($conn , $_POST['email']);
        $password = mysqli_escape_string($conn , $_POST['password']);
        $query = "SELECT * FROM abdelmaksoud WHERE `email` = '".$email."' and `password` = '".$password."' LIMIT 1 ";
        $result = mysqli_query($conn , $query);
        if($row = mysqli_fetch_assoc($result)){
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            header("Location: listbook.php");
            exit;
        }
        else{
            $error = 'Invalid email or password';
        }
        mysqli_free_result($result);
        mysqli_close($conn);
    }
?>
<html>
<head>
    <title>Login</title>
    <style>
        div 
        {
            margin: 120px auto; 
            text-align: center; 
            border: 2px solid rgb(161, 101, 101); 
            width: 50%; 
            border-radius: 10px; 
            background-color: rgb(163, 151, 151);
        }
        h1
        {
            margin-top: 60px;
            color: blue; 
            font-weight: bold; 
            font-size: 35px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            font-style: italic;
        }
        label
        {
            color: black; 
            font-weight: bold;
            font-size: 20px;
        }
        input 
        {
            border-radius: 10px; 
            border: 2px solid rgb(102, 92, 161); 
            margin-bottom: 15px; 
            text-align: center;
            height: 30px;
        }
        input:last-of-type
        {
            color: white; 
            background-color: blue; 
            width: 70px;
            margin-top: 20px;
            font-weight: bold;
            cursor: pointer; 
            border-radius: 7px;
            transition: 0.5s ease-in-out all;
        }
        input:last-of-type:hover
        {
            background-color: white;
            color: blue;
        }
    </style>
</head>
<body>
    <?php if(isset($error)) echo $error; ?>
    <div>
        <h1>Login Form</h1>
        <form method="post">
            <label>Email</label><br>
            <input type="email" name="email" id="email" value="<?= (isset($_POST['email'])) ? $_POST['email']:'' ?>" placeholder="Enter The Name !!"><br>
            <label>Password</label><br>
            <input type="password" name="password" id="password" placeholder="Enter The Password !!"><br>
            <input type="submit" name="submit" value="Login">
        </form>
    </div>
</body>
</html>