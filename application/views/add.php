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
            .error{
                color: red; 
                display: block;
            }
        </style>
        
    </head>
    <body>
        <a href="/">Home</a><a href="/trips/logout">Logout</a>
        <h2>Add a Trip</h2>
        <form action='/trips/add_trip' method='post'>
            <label>Destination:<input type='text' name='place'></label>
            <label>Description:<input type='text' name='plan'></label>
            <label>Travel Date From:<input type='date' name='start'></label>
            <label>Travel Date To:<input type='date' name='end'></label>
            <input type='submit' value="Add">
        </form>
        <div class='error'>
                   <?php 
                      if($this->session->flashdata("trip_error")) 
                      {
                        echo $this->session->flashdata("trip_error");
                      }
                    ?>
                </div>
    </body>
</html>