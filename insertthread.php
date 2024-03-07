<?php
include 'connectplan.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the POST request
    $comment = $_POST['comment'];
    $thread_id = $_POST['thread_id'];
    $userid = $_POST['userid'];
    $coursedeailid = $_POST['coursedeailid'];

    // Insert data into the thread_reply table
    $sql = "INSERT INTO thread_reply (thread_id, comment) VALUES ('$thread_id', '$comment')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Redirect to the community chat page
    header("Location: commnunitychat.php?userid=$userid&coursedeailid=$coursedeailid");
}
?>
