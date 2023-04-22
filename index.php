<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['uname'])) {
        
        $username = $_POST['uname'];
	    $score=$_POST['Score'];
        
	    $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "sample-database";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT * FROM result";
            $Insert = "INSERT INTO result(uname,Score) values(?, ?)";

            $stmt = $conn->prepare($Select);
            $stmt->fetch();
            $rnum = $stmt->num_rows;

            if ($rnum == 0) {
                $stmt->close();

                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("si",$username, $score);
                if ($stmt->execute()) {
                    echo "New record inserted sucessfully.";
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "record is already existing";
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
}
?>