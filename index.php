<?php
require_once 'connectplan.php'; // Include the connection file

// SQL query to retrieve all data from the clipboard table
$sqldata = "SELECT * FROM course_details";
$resultdata = $conn->query($sqldata);

// Check if there are any rows returned
if ($resultdata->num_rows > 0) {
    // Initialize an empty array to store the data
    $cdata = [];

    // Loop through each row and store it in the data array
    while ($col = $resultdata->fetch_assoc()) {
        $cdata[] = $col;
    }
    $json_data = json_encode($cdata);
} else {
    echo "No data found";
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
    <title>Courses Details</title>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container pt-2">
        <div class="raw">
            <div class="col d-flex justify-content-end">
                <input type="text" class="mb-2 pb-1 border1" oninput="search()" id="search"
                    placeholder="Search by video">
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <div class="table-responsive d-none" id="tbl">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Titel</th>
                                    <th>Description</th>
                                    <th>See</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
<script>
const opn = () => {
    document.getElementById('tbl').classList.remove('d-none');
}
function search() {
    var value = document.getElementById('search').value.toLowerCase();
    var clipboardData = <?php echo $json_data; ?>;
    var filteredData = clipboardData.filter(function(item) {
        return item.description.toLowerCase().includes(value);
    });

    var tbody = document.getElementById("tbody");
    tbody.innerHTML = ""; // Clear previous search results

    if (value.trim() === "") {
        document.getElementById('tbl').classList.add('d-none');
    } else {
        opn();
        if (filteredData.length > 0) {
            filteredData.forEach(function(item) {
                var row = document.createElement("tr");
                var idCell = document.createElement("td");
                idCell.textContent = item.title;
                var nameCell = document.createElement("td");
                nameCell.textContent = item.description;
                row.appendChild(idCell);
                row.appendChild(nameCell);
                var link = document.createElement("td");
                link.innerHTML = `<a class="btn btn-outline-primary btn-sm" href="coursedetail.php?id=${item.id}">Watch</a>`;
                row.appendChild(link);
                tbody.appendChild(row);
            });
        } else {
            document.getElementById('tbl').classList.add('d-none');
        }
    }
}
</script>
<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>
