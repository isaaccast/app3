<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard</title>
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
            a{
                display: inline-block;
                margin: 0px;
            }
            #login{
                border: 1px solid black; 
            }
            #review{
                display: inline-block;
                width: 300px; 
            }
            #review p{
                margin-left: 35px;  
                
            }
            #side_bar{
                display: inline-block;
                float: right;
            }
            #all_reviews{
                border: 1px solid black; 
                width: 190px;
                height: auto; 
                display: block;
            }
            #all_reviews a{
                display: block;
                margin: 3px; 
            }
        </style>
        
    </head>
    <body>
        <h2>Welcome <?= $this->session->userdata['first_name']?>!</h2><a href="/books/add_page">Add Book and Review</a> <a href="/books/logout">Log Off</a>
               <div id='recent'>
            <h3>Recent Book Reviews:</h3>
            <div id='review'>
                <?php for ($i=1; $i <4 ; $i++) { ?> 
                <h4><a href="/books/get_book/<?= $books[count($books)-$i]['book_id'] ?>"><?= $books[count($books)-$i]['title'] ?></a></h4>
                <p>Rating:</p>
                <p><a href="/books/show_user/<?= $books[count($books)-$i]['id'] ?>"><?= $books[count($books)-$i]['first_name'] ?></a>says: <?= $books[count($books)-$i]['comment'] ?></p>
                <p>Posted on:<?= $books[count($books)-$i]['created_at'] ?></p>
               <?php } ?>
            </div>
            <div id='side_bar'>
                <h3>Other Books with Reviews:</h3>
                <div id='all_reviews'>
                    <?php foreach ($books as $book) {
                        ?><a href="/books/get_book/<?=$book['book_id']?>"><?=$book['title'] ?></a>
                   <?php } ?>
                </div>
            </div>
        </div>

        
    </body>
</html>