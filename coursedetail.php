<?php
if(isset($_GET['course'])){
    echo $_GET['course'];
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
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="raw">
            <h2 class="text-black text-center">Planner</h2>
        </div>
        <div class="raw">
            <div class="col">
                <div class="custom-raw">
                    <div id="videolink"></div>
                </div>
            </div>
        </div>
        <div class="raw">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td><button onclick="videochange('https://www.youtube.com/embed/Etkd-07gnxM')"
                                class="btn btn-primary btn-sm">click 1</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
    function videochange(id) {

        var videolink = id
        var autoplay = "?autoplay=1"; // Assuming autoplay should be added as a query parameter

        // Concatenate the videolink and autoplay variables
        var src = videolink + autoplay;
        console.log(src)
        document.getElementById('videolink').innerHTML = `<iframe class="custom-video" src="${src}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
    }
</script>
<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</html>