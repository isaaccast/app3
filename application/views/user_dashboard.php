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
                margin-left: auto;
            }
            #pokes{
                border: 1px solid black; 
            }
            h2{
                display: inline-block; 
            }
            .table{
                empty-cells: hide;
            }
            
        </style>
        
    </head>
    <body>
        <h2>Welcome <?= $this->session->userdata['name']?>!</h2><a href="/pokes/logout">Log Off</a>
        <div id='container'>
            <h3><?= count($pokes, 0) ?> user(s) have poked you!</h3>
            <div id='pokes'>
                <?php foreach ($pokes as $poke) { if($poke['poked_by'] != $this->session->userdata['id']){ ?>
                    <p><?= $poke['name'] ?> has poked you <?= $poke['count'] ?> times</p>
                <?php } } ?>
            </div>
           
            <h3>People you may want to poke:</h3>  
             <div id='new_pokes'>
                <table class="table table-bordered">
                    <thead>
                        <th>Name</th>
                        <th>Alias</th>
                        <th>Email Address</th>
                        <th>Poke History</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php  
                            foreach ($others as $other) {
                                if($other['user_id'] != $this->session->userdata['id']) { ?>
                             <tr>
                                <td><?= $other['name'] ?></td>
                                <td><?= $other['alias'] ?></td>
                                <td><?= $other['email'] ?></td>
                                <td><?php if(isset($other['count']) && isset($other['name']) && $other['user_id'] != $other['poked_by']){
                                            echo $other['count'];
                                            }
                                            elseif(isset($other['name']) && $other['count'] == 1 && $other['user_id'] == $other['poked_by'])
                                            {
                                                echo 0; 
                                            }
                                            else
                                            {
                                                echo $other['count'] -1; 
                                            } ?></td>
                                <?php if(isset($other['name'])){echo 
                                    "<td><button><a href='/pokes/add_poke/" .$other['user_id']. "'>Poke</a></button></td>"; } ?>
                            </tr>    
                            <?php } }
                         ?>
                    </tbody>
                </table>    
            </div>
            
        </div>

        
    </body>
</html>