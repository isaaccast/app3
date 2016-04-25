<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>All Reviews</title>
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
               
            }
            a{
                margin: 0px; 
            }
            form label{
                display: block;
            }
            textarea{
                width: 350px; 
            }
            #stars{
                color: gold; 
            }
            #login{
                border: 1px solid black; 
            }
            #review p {
                margin: 0px;

            }
            #review{
                width: 250px; 
                margin-left: 25px; 
                display: inline-block;
                border-bottom: 1px solid black;
                border-top: 1px solid black;
                vertical-align: text-top;
            }
            #sidebar{
                display: inline-block;
                margin-left: 100px; 
                vertical-align: top;   
            }
        </style>
        
    </head>
    <body>
        <a href="/books/user_dashboard">Home</a> <a href="/books/logout">Log Off</a>
            <h3><?=$book['title']?></h3>
            <p>Author: <?=$book['author']?></p>
        <div id='recent'>
            
        </div>
         <h3>Reviews: </h3>
            <div id='review'>
                <?php foreach ($reviews as $review) { ?>
                <p>Rating:
                <div id='stars'>
                    <?php for ($i=0; $i < $review['rating']; $i++) { 
                        echo "★";
                    }
                    $empty = 5-$review['rating'];  
                    for ($i=0; $i < $empty ; $i++) { 
                        echo "☆";
                    }
                    ?>
                </div></p>
                <p><a href="/books/show_user/<?=$review['user_id']?>"><?=$review['first_name']?></a>says: <?=$review['comment']?></p>
                <p>Posted on: <?=$review['created_at']?><?php if($this->session->userdata['first_name'] == $review['first_name']){
                    echo "<a href='/books/remove_review/".$review['id']."/".$book['book_id']. "'>Delete this Review</a>";
                } ?></p>
                <?php } ?>
            </div>
        
        <div id = 'sidebar'>
            <h4>Add a Review:</h4>
            <form action='/books/add_review/<?= $book['book_id'] ?>' method ='post'>
                <textarea type='text' name='comment'></textarea>
                <label >Rating:<input  id='rating' type="number" name="rating" value='1' min="1" max="5">  stars.</label>
                <input type='submit' value='Submit Review'>
            </form>
        </div>
        
    </body>
</html>