<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WatchStore Admin</title>
    <link rel="stylesheet" href="adminhome.css">
    <link rel="stylesheet" href="users.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <h1>WatchStore Admin</h1>
        </div>
        <ul class="nav-links">
            <li><a href="adminhome.html">Dashboard</a></li>
            <li><a href="home.html">Logout</a></li>
        </ul>
    </nav>
<div class="main">
    <?php
        $con = mysqli_connect("localhost", "root", "", "watch_store");

        if (!$con) {
            die("DB not connected: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM `users`";
        $data = mysqli_query($con, $sql);

        if ($data) {
            if (mysqli_num_rows($data) > 0) {
                echo "<table border='1'>";
                echo "<tr>
                    <th>Name</th>
                    <th>Number</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>User ID</th>
                    <th>Actions</th>
                </tr>";

                while ($value = mysqli_fetch_assoc($data)) {
                    $id=$value['UserID'];
                    echo "<tr>";
                    echo "<td>" . $value['Name'] . "</td>";
                    echo "<td>" . $value['Number'] . "</td>";
                    echo "<td>" . $value['Email'] . "</td>";
                    echo "<td>" . $value['Address'] . "</td>";
                    echo "<td>" . $value['UserID'] . "</td>";
                    echo "<td><form method='post'><button style='background:transperent;' value='{$id}' name='deluser' type='submit'>DELETE</button></form></td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "No users found.";
            }
        } else {
            echo "Error: " . mysqli_error($con);
        }

    ?>
    </div>
</body>
</html>
<?php
if(isset($_POST['deluser'])){
    $id=$_POST['deluser'];
    if(!empty($_POST['deluser'])){
    $sql ="DELETE FROM `users` WHERE `UserID`='$id'";
    // echo "$sql";
    $data=mysqli_query($con,$sql);
        // echo "<script>alert('Officer deleted successfully')</script>";
        echo "<script>window.replace.location('../watchstore/users.php')</script>";
}
}
?>