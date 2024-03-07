<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Courses Details</title>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container pt-2">
        <?php
        include 'connectplan.php';

        $sql = "SELECT * FROM courses";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '  <div class="row border border-dark rounded mb-2">
                            <div class="col-2 d-flex align-items-center">
                                <img src="' . $row['image_url'] . '" class="img-fluid rounded-circle" alt="Rounded Image" style="min-width: 50px;">
                            </div>
                            <div class="col-10 d-flex flex-column align-items-start">
                                <h3 class="m-0">' . $row['course_name'] . '</h3>
                                <div class="text-center">
                                    <a class="btn btn-primary btn-sm mt-2 mb-2 text-center" href="coursedetail.php?course=' . $row['course_name'] . '">Start Watching</a>
                                </div>
                            </div>
                        </div>';
            }
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
        <?php include 'footer.php'; ?>
    </div>
</body>
<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>
