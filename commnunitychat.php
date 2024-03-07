<?php
include 'connectplan.php';

if(isset($_GET['userid']) && isset($_GET['coursedeailid'])){
    $courses = $_GET['coursedeailid'];
    $sql = "SELECT * FROM course_details WHERE id = '$courses'";
    $result = $conn->query($sql);
    $id = $_GET['userid'];
    $sqlid = "SELECT username  FROM user_table WHERE id = '$id'";
    $resultid = $conn->query($sqlid);
    $threadid = "SELECT *  FROM thread WHERE course_detail_id = '$courses'";
    $threadresult = $conn->query($threadid);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $description = $row['description'];
    } 
    if ($resultid->num_rows > 0) {
        $rowusername = $resultid->fetch_assoc();
        $username = $rowusername['username'];
    }
    else {
        echo "No data found for ID: $id";
        exit;
    }
}

if(isset($_GET['userid'])){
    $id = $_GET['userid'];
    $sqlid = "SELECT * FROM course_details WHERE id = '$id'";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Community Chat</title>
</head>

<body>
    <div class="container">
        <div class="raw">
            <div class="card">
                <div class="card-header">
                    Community Chat
                </div> 
                <div class="card-body">
                    <h5 class="card-title"><?php echo $title; ?></h5>
                    <p class="card-text"><?php echo $description; ?></p>
                </div>
            </div>
        </div>
        <?php
        if ($threadresult->num_rows > 0) {
                        $thread = $threadresult->fetch_assoc();
                        $tid = $thread['id'];
                        $ttitle = $thread['title'];
                        $tdescription = $thread['description'];
                        $tdate = $thread['created_date'];
                        $tuser = $thread['user_id'];
                        $timage = $thread['image_path'];
                        $threadusername = "SELECT username FROM user_table WHERE id = '$tuser'";
                        $threaduserresult = $conn->query($threadusername);  
                        if ($threaduserresult->num_rows > 0) {
                            $threaduser = $threaduserresult->fetch_assoc();
                            $threadusername = $threaduser['username'];
                        }
            echo '<div class="raw mt-2">
            <div class="card">
                <div class="card-header text-success">
                <h3>    Open Thread </h3>
                </div> 
                <div class="card-body">
                    <h5 class="card-title">' . $ttitle . '</h5>
                    <p class="card-text">' . $tdescription . '</p>
                    <p class="card-text">created by - ' . $threadusername . '</p>
                    <p class="card-text">created at - ' . $tdate . '</p>
                    <button onclick="generateComment()" class="btn btn-outline-success">reply</button>
                    <div class="mt-2" id="comment">
                        
                    </div>
                    ';
                    $threadusername = "SELECT * FROM thread_reply WHERE thread_id = '$tid' ORDER BY created_at DESC";
                    $threaduserresult = $conn->query($threadusername);
                        if ($threaduserresult->num_rows > 0) {
    while ($threaduser = $threaduserresult->fetch_assoc()) {
        $comment = $threaduser['comment'];
        $created_at = $threaduser['created_at'];
        echo '
        <div class="input-group mb-3">
            <span class="input-group-text">@replay</span>
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInputGroup1" value="' . $comment . '" readonly>
                <label for="floatingInputGroup1">' . $created_at . '</label>
            </div>
        </div>';}
                        }}
                     else {
                        echo '<a href="#" class="btn btn-success mt-2">Generate New Issue</a>';
                        }
                    ?>      
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function generateComment() {
    var form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", "insertthread.php");

    var inputContainer = document.createElement("div");
    inputContainer.classList.add("mb-3");

    var input = document.createElement("input");
    input.setAttribute("type", "text");
    input.setAttribute("name", "comment");
    input.setAttribute("placeholder", "Enter your comment");
    var hiddenInput = document.createElement("input");
    hiddenInput.setAttribute("type", "hidden");
    hiddenInput.setAttribute("name", "thread_id");
    hiddenInput.setAttribute("value", "<?php echo $tid; ?>");
    form.appendChild(hiddenInput);
    var hiddenInput2 = document.createElement("input");
    hiddenInput2.setAttribute("type", "hidden");
    hiddenInput2.setAttribute("name", "userid");
    hiddenInput2.setAttribute("value", "<?php echo $tuser; ?>");
    form.appendChild(hiddenInput2);
    var hiddenInput3 = document.createElement("input");
    hiddenInput3.setAttribute("type", "hidden");
    hiddenInput3.setAttribute("name", "coursedeailid");
    hiddenInput3.setAttribute("value", "<?php echo $courses; ?>");
    form.appendChild(hiddenInput3);
    input.classList.add("form-control");

    inputContainer.appendChild(input);

    var buttonContainer = document.createElement("div");

    var submitButton = document.createElement("input");
    submitButton.setAttribute("type", "submit");
    submitButton.setAttribute("value", "Submit");
    submitButton.classList.add("btn", "btn-success");

    buttonContainer.appendChild(submitButton);

    form.appendChild(inputContainer);
    form.appendChild(buttonContainer);

    document.getElementById("comment").appendChild(form);
}
</script>
<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>
