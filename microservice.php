<?php

// Port number
$port = 9876;

// Start listening on socket
$server = stream_socket_server("tcp://127.0.0.1:$port", $errno, $errstr);

if (!$server) {
    echo "Error starting server: $errstr\n";
} else {
    echo "Listening on port {$port}\n";
}

while ($client = stream_socket_accept($server)) {
    $command = fread($client, 256);
    if ($command = "pull") {
        main();
        fwrite($client, "Request executed");
    }
}

function main() {

    // Draw from database
    $mysqli = require __DIR__ . "/database.php";
    $sqlcount = "SELECT COUNT(*) FROM Course";
    $sqlquery = "SELECT * FROM Course";
    $result = $mysqli->query($sqlquery);

    // Select a random number from available courses
    $courseCount = $mysqli->query($sqlcount)->fetch_assoc()["COUNT(*)"];
    $courseIndex = rand(0, $courseCount - 1);

    // Format as object
    $courses = $result->fetch_all(MYSQLI_ASSOC);
    $course = $courses[$courseIndex];
    $courseInfo = array(
        "id" => $course["id"],
        "Course Name" => $course["name"],
        "Description" => $course["description"],
        "Instructor" => $course["instructor"],
        "Date" => $course["date"],
        "Price" => $course["price"]
    );

    //Save as JSON
    $jsonCourseInfo = json_encode($courseInfo);
    $filename = 'displaycourse.json';
    $file = fopen($filename, 'w');
    if ($file) {
        fwrite($file, $jsonCourseInfo);
        fclose($file);
    } else {
        echo "Error writing to file\n";
    }
}

?>
