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
        <h2>Welcome <?= $this->session->userdata['name']?>!</h2><a href="/trips/add_page">Add Travel Plan</a> <a href="/trips/logout">Log Off</a>
        <div id='container'>
            <h3>Your Trip Schedules:</h3>
            <div id='trips'>
                <table class="table table-bordered">
                    <thead>
                        <th>Destination</th>
                        <th>Travel Start Date</th>
                        <th>Travel End Date</th>
                        <th>Plan</th>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($trips as $trip) {?>
                            <tr>
                                 <td><a href="/trips/details/<?= $trip['des_id'] ?>"><?= $trip['place'] ?></a></td>
                                <td><?= $trip['start'] ?></td>
                                <td><?= $trip['end'] ?></td>
                                <td><?= $trip['plan'] ?></td>
                            </tr>    
                            <?php }
                         ?>
                    </tbody>
                </table>
            </div>
           
            <h3>Other User's Travel Plans:</h3>  
             <div id='others'>
                <table class="table table-bordered">
                    <thead>
                        <th>Name</th>
                        <th>Destination</th>
                        <th>Travel Start Date</th>
                        <th>Travel End Date</th>
                        <th>Do You Want to Join?</th>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($others as $other) {?>
                             
                             <tr>
                                <td><?= $other['planned_by'] ?></td>
                                <td><a href="/trips/details/<?= $other['des_id'] ?>"><?= $other['place'] ?></a></td>
                                <td><?= $other['start'] ?></td>
                                <td><?= $other['end'] ?></td>
                                <td><a href="/trips/add_des/<?= $other['des_id'] ?>">Join</a></td>
                            </tr>    
                            <?php }
                         ?>
                    </tbody>
                </table>    
            </div>
            
        </div>

        
    </body>
</html>