<?php
    $error_fields = array();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(! (isset ($_POST['name']) && !empty($_POST['name']))){
        $error_fields[] = "name";
    }
    
    if(! (isset ($_POST['price']) && strlen($_POST['price']) < 5)){
        $error_fields[] = "price";
    }
    if(!$error_fields){
        $conn = mysqli_connect("localhost" , "root" , "" , "mysql");
        if(! $conn){
        echo mysqli_connect_error();
        exit;
        }
        
    $name = mysqli_escape_string($conn, $_POST['name']);
    $price = mysqli_escape_string($conn, $_POST['price']);
    $query = "INSERT INTO books (`name` , `price`) VALUES ('".$name."' , '".$price."')";
    if(mysqli_query($conn , $query)){
        header("Location: listbook.php");
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
    <title>Admin :: List Books</title>
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
<h1 style="text-align: center; color: green;">Add Book</h1>
    <form method="post" enctype="multipart/form-data" style="text-align: center; background-color: beige; width: 250px; margin: 20px auto; padding: 10px;">
        <label>Name</label>
        <input type="text" name="name" id="name" value="<?= (isset($_POST['name'])) ? $_POST['name'] : '' ?>"><?php if(in_array("name", $error_fields)) echo "* please enter the name"; ?><br>
        <label>Price</label>
        <input class="second" type="text" name="price" id="price" value="<?= (isset($_POST['price'])) ? $_POST['price'] : '' ?>"><?php if(in_array("price", $error_fields)) echo "* please enter the price"; ?><br>
        <input type="submit" value="Add Book" name="submit">
    </form>
    </body>
</html>