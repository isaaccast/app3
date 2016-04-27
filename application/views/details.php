<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $user[0]['first_name'] ?>'s Page</title>
        <link rel=stylesheet href="/style.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <style type="text/css">
            *{
                margin: 10px;
                padding: 5px;
            }
            p{
                display: block;
                margin-bottom: 10px; 
                margin-left: 30px; 
                width: 503px;
            }
            #login{
                border: 1px solid black; 
            }
            #review p{
                margin-left: 35px;  
            }
            #recent a{
                display: block; 
            }
        </style>
        
    </head>
    <body>
        <a href="/trips/user_dashboard">Home</a><a href="/trips/logout">Log Off</a>
        <div id='recent'>
                <h3><?= $trip['place'] ?> </h3>
                <p>Planned By:<?= $trip['name'] ?></p>
                <p>Description:<?= $trip['plan'] ?></p>
                <p>Travel Date From:<?= $trip['start'] ?></p>
                <p>Travel Date To:<?= $trip['end'] ?></p>
                 
        </div>
        <div>
            <h4>Other users' joining this trip:</h4>
            <?php 
            // var_dump($companions); 
            foreach ($companions as $companion) { ?>
                <p><?= $companion['name'] ?></p>
            <?php }?>

        </div>
        
    </body>
</html>