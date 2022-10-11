<?php
// start connection
$conn = mysqli_connect("localhost" , "root" , "" , "mysql");
if(! $conn){
    echo mysqli_connect_error();
    exit;
}
// the operation
$query = "SELECT * FROM abdelmaksoud";
$result = mysqli_query($conn , $query);
while($row = mysqli_fetch_assoc($result)){
    echo "Id: ".$row['id']."<br />"; 
    echo "Name: ".$row['name']."<br />"; 
    echo "Email: ".$row['email']."<br />"; 
    echo "Password: ".$row['password']."<br />"; 
    echo str_repeat("-", 50)."<br />"; 
}
// end connection
mysqli_free_result($result);
mysqli_close($conn);