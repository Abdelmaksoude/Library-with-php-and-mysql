<?php

    // echo "abdelmaksoud";
    // echo date('H:i, jS F Y');
    // echo '<br>';

    $errors_arr = array();
    if(isset($_GET['error_fields'])){
        $errors_arr = explode(",", $_GET['error_fields']);
    }
?>
<html>
    <body>
        <form method="post" action="process_db.php">
            <label>Name</label>
            <input type="text" name="name" id="name"><?php if(in_array("name", $errors_arr)) echo "* please enter your name"; ?><br>
            <label>Email</label>
            <input type="email" name="email" id="email"><?php if(in_array("email", $errors_arr)) echo "* please enter a valid email"; ?><br>
            <label>Password</label>
            <input type="password" name="password" id="password"><?php if(in_array("password", $errors_arr)) echo "* please enter your password not less than 6 characters"; ?><br>
            <label>Gender</label>
            <input type="radio" name="gender" value="male">Male
            <input type="radio" name="gender" value="female">Female
            <input type="submit" value="Register" name="submit">
        </form>
    </body>
</html>