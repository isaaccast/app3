<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Add New</title>
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
                display: inline-block;
                
            }
            #login{
                border: 1px solid black; 
            }
            #review p{
                margin-left: 35px;  
            }
            label{
                display: block;
                margin-right: 5px;  
                vertical-align: text-top; 
            }
            select{
                display: inline-block;
                margin-left: 10px; 
                width: 153px; 
            }
            input, textarea{
                margin-left: 10px; 
                vertical-align: top; 
            }
            #new_author{
                margin-left: 20px; 
            }
            #rating{
                vertical-align: middle;
            }
        </style>
        
    </head>
    <body>
        <a href="/">Home</a><a href="/books/logout">Logout</a>
        <h2>Add a New Book Title and a Review:</h2>
        <form action='/books/add_book_review' method='post' id='add_book_review'>
            <label>Book Title:<input type='text' name='title'></label>
            <label>Author:</label>
            <div id='new_author'>
                <p>Choose from the list:</p>
                <select name='author' form='add_book_review'>
                    <option></option>
                    <option value='Stephen King'>Stephen King</option>
                    <option value='J.K. Rowling'>J.K. Rowling</option>
                    <option value='Ernest Hemingway'>Ernest Hemingway</option>
                    <option value='Mark Twain'>Mark Twain</option>
                </select><br>
                <p>Or add a new author:<input type='text' name='author'></p>
            </div>
            <label>Review:<textarea type='text' name='comment'></textarea></label>
            <label >Rating:<input  id='rating' type="number" name="rating" value='1' min="1" max="5">  stars.</label>
            <input type='submit' value='Add Book and Review'>
        </form>
    </body>
</html>