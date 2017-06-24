<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start = $_POST['start'];
    $destination = $_POST['destination'];
    $startTime = $_POST['startTime'];
    $price = $_POST['price'];
    $flightTime = $_POST['flightTime'];
    $passenger = generatePassenger();

    if (isset($tweet) && isset($destination) && isset($startTime) && isset($flightTime) && ($price > 0)) {
        echo "Dane wprowadzone"; //warunek równości musiał być na początku
    } else {
        echo "Wprodzono błędne lub niepełne dane!";
        return false;
    }

}
?>

<!Doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main page</title>
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<p></p>
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <h3>Drop me a line!</h3>
            <hr>
            <address>
                <strong>Email:</strong> <a href="mailto:#"> name@domain.com</a><br><br>
                <strong>Phone:</strong> (555)123-4567
            </address>
        </div>

        <div class="col-sm-8 contact-form">
            <form id="contact" method="post" class="form" role="form">
                <div class="row">
                    <div class="col-xs-6 col-md-6 form-group">
                        <input class="form-control" id="name" name="name" placeholder="Name" type="text" required
                               autofocus/>
                    </div>
                    <div class="col-xs-6 col-md-6 form-group">
                        <input class="form-control" id="email" name="email" placeholder="Email" type="email" required/>
                    </div>
                </div>
                <textarea class="form-control" id="message" name="tweet" placeholder="Message" rows="5"></textarea>
                <br/>
                <div class="row">
                    <div class="col-xs-12 col-md-12 form-group">
                        <button class="btn btn-primary pull-right" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>


</html>