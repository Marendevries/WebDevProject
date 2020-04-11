<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="stylesheet.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<head>
    <title>Join game bestaande speler</title>
</head>
<body>
<div class="container">
    <div class="card-group">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Join game bestaande player</h5>
                <form class="edit2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <p>Voer hier uw eerder gebruikte naam in</p>
                    <input pattern="[a-zA-Z]+" name=playername type="text" required /><br>
                    <input class="back" value="Join" type="submit" />
                </form><br>
                <a href="spelermenu.php"><button class=back>Terug</button></a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
