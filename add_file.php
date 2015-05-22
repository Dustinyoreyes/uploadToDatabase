<?php

//CREATE A CONNECTION using Procedural Style
$conn = mysqli_connect('localhost', 'root', '','forecast');

//CHECK CONNECTION 
if (!$conn) {
	die('Connection failed: ('.mysqli_connect_errno().')'. mysqli_connect_errno());
} 
echo 'Success in connecting to ' . mysqli_get_host_info($conn). "\n" ;
echo "<br>";

/********************
//SQL TO CREATE A TABLE
$sql = "CREATE TABLE customer (
	id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(30) NOT NULL,
	mime VARCHAR(50) Not Null Default 'text/plain',
	size INT(200) UNSIGNED Not Null,
	data BLOB Not Null,
	created DateTime Not Null
	)";
if ($conn->query($sql) === TRUE) {
	echo "Table customer created successfully";
} else {echo "Error creating table: ". $conn->error;
}
 $conn->close();
*********************/

// Check if a file has been uploaded
if(isset($_FILES['uploaded_file'])) {
echo "File is set for uploading"; }
echo "<br>";
// Gather all required data
        $name = mysqli_real_escape_string($conn, $_FILES['uploaded_file']['name']);
        $mime = mysqli_real_escape_string($conn, $_FILES['uploaded_file']['type']);
        $data = mysqli_real_escape_string($conn, file_get_contents($_FILES ['uploaded_file']['tmp_name']));
        $size = Intval($_FILES['uploaded_file']['size']);
 
        // Create the SQL query
        $query = "
            INSERT INTO customer (
                name, mime, size, data, created
            )
            VALUES (
                '{$name}', '{$mime}', {$size}, '{$data}', NOW()
            )";
 
        // Execute the query
        $result = $conn->query($query);
 
        // Check if it was successful
        if($result) {
            echo 'Your file was successfully added!';
        }
        else {
            echo 'Error! Failed to insert the file'
               . "<pre>{$conn->error}</pre>";
        } 

// Close the mysql connection
    $conn->close();

echo "<br>";

 














?>