<html>
    <head>
        <style>
            .head
            {
                margin: 20px auto;
                text-align: center;
                color: blue;
            }
            p
            {
                font-weight: bold;
            }
            p a
            {
                display: block;
                color: red;
            }
            p a:hover
            {
                text-decoration: hover;
                opacity: 0.7;
            }
        </style>
    </head>
    <body>
        <h1 class="head">
            <?php
                session_start();
                if(isset($_SESSION['id'])){
                    echo ' <p> Welcome '.$_SESSION['email'].' <a href="logout.php">Logout</a></p>';
                }
                else{
                    header("Location: login.php");
                    exit;
                }
            ?>
        </h1>
    </body>
</html>
<?php
    $conn = mysqli_connect("localhost" , "root" , "" , "mysql");
    if(! $conn){
    echo mysqli_connect_error();
    exit;
    }

    $query = "SELECT * FROM abdelmaksoud";
    if (isset($_GET['search'])){
        $search = mysqli_escape_string($conn , $_GET['search']);
        $query .= " WHERE abdelmaksoud.`name` LIKE '%".$search."%' OR abdelmaksoud.`email` LIKE '%".$search."%'";
    }
    $result = mysqli_query($conn , $query);
?>
<html>
<head>
    <title>Admin :: List Users</title>
    <style>
        td 
        {
            padding: 5 15px;
        }
        a
        {
            text-decoration: none;
            color: blue;
        }
        a:hover
        {
            color: green;
        }
        h1
        {
            text-align: center;
            color: green;
        }
        .search 
        {
            cursor: pointer; 
            color: white; 
            background-color: rgb(59, 51, 51); 
            width: 70px; 
            border-radius: 5px;
            transition: 0.5s ease-in-out all;
        }
        .search:hover
        {
            background-color: white;
            color: black;
        }
        .inputsearch
        {
            width: 250px; 
            text-align: center; 
            border-radius: 5px; 
            border: 1px solid gray;
        }
    </style>
</head>
<body>
    <h1>List Users</h1>
    <form style="text-align: center;">
        <input class="inputsearch" type="text" name="search" placeholder="Enter {Name} or {Email} to search">
        <input class="search" type="submit" value="search" >
    </form>
    <table style="margin: 20px auto; background-color: rgb(181, 163, 163); border-radius: 10px; padding: 10px;">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Admin</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
                <?php
                    while($row = mysqli_fetch_assoc($result)){
                ?>
                        <tr>
                            <td><?= $row['id']?></td>
                            <td><?= $row['name']?></td>
                            <td><?= $row['email']?></td>
                            <td><?= ($row['admin']) ? 'yes' : 'no' ?></td>
                            <td><a href="edit.php?id=<?=$row['id']?>" >Edit</a> | <a href="delete.php?id=<?=$row['id']?>">Delete</a></td>
                        </tr>
                <?php
                    }
                ?>
        </tbody>
        <tfoot>
                <tr>
                    <td colspan="2" style="text-align: center"><?= mysqli_num_rows($result)?> &nbsp;Users</a></td>
                    <td colspan="3" style="text-align: center"><a href="add.php">Add User</a></td>
                </tr>
        </tfoot>
    </table>
</body>
</html>
<?php
mysqli_free_result($result);
mysqli_close($conn);