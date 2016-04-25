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
        <a href="/books/user_dashboard">Home</a><a href="/books/add_page">Add Book and Review</a> <a href="/books/logout">Log Off</a>
        <div id = 'user'>
            <h3>User Alias: <?=$user[0]['first_name'] ?></h3>
            <h3>Name: <?=$user[0]['first_name'].' '. $user[0]['last_name'] ?></h3>
            <h3>Email: <?=$user[0]['email'] ?></h3>
            <h3>Total Reviews: <?= count($user) ?></h3>
        </div>
        <div id='recent'>
            <h3>Posted Reviews on the following books:</h3>
            <?php foreach ($user as $entry) { ?>
                <a href="/books/get_book/<?= $entry['id'] ?>"><?= $entry['title'] ?></a>
            <?php } ?>
        </div>

        
    </body>
</html>