<?php
include 'connectplan.php';

if(isset($_GET['course'])){
    $courses = $_GET['course'];
}

$sql = "SELECT * FROM course_details WHERE course_name = '$courses'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Document</title>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <div class="raw">
            <div class="col">
                <div class="custom-raw center-content">
                    <div id="videolink"></div>
                </div>
            </div>
        </div>
        <div class="raw">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Part</th>
                        <th scope="col">Titel</th>
                        <th scope="col">Description</th>
                        <th scope="col">See</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>
                                    <td>' . $row['id'] . '</td>
                                    <td>' . $row['title'] . '</td>
                                    <td>' . $row['description'] . '</td>
                                    <td><button onclick="videochange(\'' . $row['link'] . '\')" class="btn btn-primary btn-sm">Watch Video</button></td>
                                </tr>';
                        }
                    } else {
                        echo "<tr><td colspan='4'>0 results</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
        <?php include 'footer.php'; ?>
    </div>
</body>
<script>
    function getVideoId(link) {
    var videoId = '';
    var regExp = /^.*(youtu.be\/|v\/|e\/|u\/\w+\/|embed\/|v=)([^#\&\?]*).*/;
    var match = link.match(regExp);
    if (match && match[2].length === 11) {
        videoId = match[2];
    }
    return videoId;
}
    function videochange(link) {
    var videoId = getVideoId(link);
    if (videoId) {
        var playerDiv = document.getElementById('videolink');
        playerDiv.innerHTML = ''; // Clear any existing iframe

        var iframe = document.createElement('iframe');
        iframe.src = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1';
        iframe.width = '560';
        iframe.height = '315';
        iframe.style.maxWidth = '100%'; // Set maximum width to 100% of parent container
        iframe.style.maxHeight = '100%'; // Set maximum height to 100% of parent container
        iframe.frameborder = '0';
        iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
        iframe.allowfullscreen = true;

        playerDiv.appendChild(iframe);
    } else {
        console.error('Invalid YouTube video link:', link);
    }
}

</script>
<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>
