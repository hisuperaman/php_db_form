<?php
    $conn = mysqli_connect('localhost', 'root', '', 'newdb');
?>
<html>
<head>
    <title>Database Form</title>
</head>
<body>
    <center>
        <form action="home.php" method="post">
            Serial Number: <input type="text" name="serial"> <br> <br>
            Name: <input type="text" name="name"> <br> <br>
            City: <input type="text" name="city"> <br> <br>
            <input type="submit" value="Insert" name="insert">
            <input type="submit" value="Delete" name="delete">
            <input type="submit" value="Update" name="update">
            <input type="submit" value="Search" name="search">
            <input type="submit" value="Display" name="display">
        </form>
        <?php
            if (isset($_POST['insert']))
            {
                $query = "insert into userdata values('$_POST[serial]', '$_POST[name]', '$_POST[city]');";
                mysqli_query($conn, $query);
            }
            else if (isset($_POST['delete']))
            {
                $query = "delete from userdata where sno='$_POST[serial]' or name='$_POST[name]' or city='$_POST[city]';";
                mysqli_query($conn, $query);
            }
            else if (isset($_POST['update']))
            {
                $query = "update userdata set name='$_POST[name]', city='$_POST[city]' where sno='$_POST[serial]';";
                mysqli_query($conn, $query);
            }
            else if (isset($_POST['search']) || isset($_POST['display']))
            {
                if (isset($_POST['search']))
                    $query = "select * from userdata where sno='$_POST[serial]' or name='$_POST[name]' or city='$_POST[city]';";
                else
                    $query = "select * from userdata;";
                $result = mysqli_query($conn, $query);
                    
                echo "<center><table border=1>";
                echo "<tr>";
                echo "<th>sno</th>"."<th>name</th>"."<th>city</th>";
                echo "</tr>";
                while($row = mysqli_fetch_array($result))
                {
                    echo "<tr>";
                    echo "<td>".$row['sno']."</td>"."<td>".$row['name']."</td>"."<td>".$row['city']."</td>";
                    echo "</tr>";
                }
                echo "</table></center>";
            }
            mysqli_close($conn);
        ?>
    </center>
</body>
</html>
