<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Retrieve data</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <style>
          h1{
              color: purple;
          }
          .containingDIV{
              border: 1px solid #261cec;
              margin-top: 50px;
              border-radius: 15px;
          }
      </style>
  </head>
  <body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10 containingDIV">
                <h1>Retrieve data:</h1>
                <?php
                //mysqli_connect(host, username, password, dbname)
                $host = 'localhost';
                $username = 'root';
                $Password = '';
                $dbname = 'store';
                $link = new mysqli($host, $username, $Password,$dbname) or die("ERROR: Unable to connect: ").$link->connect_error;
                
                echo "<p>Connected successfully to the server.</p>";
                
                $sql = "SELECT * FROM users";
                if($result = mysqli_query($link, $sql)){
                    print_r($result);
                    if(mysqli_num_rows($result)>0){
                        //The below comment outed lines are for understanding mysqli_fetch_array
                        /*echo "<p>Call 1</p>";
                        print_r(mysqli_fetch_array($result, MYSQLI_ASSOC));
                        echo "<p>Call 2</p>";
                        print_r(mysqli_fetch_array($result, MYSQLI_ASSOC));
                        echo "<p>Call 3</p>";
                        print_r(mysqli_fetch_array($result, MYSQLI_ASSOC));
                        echo "<p>Call 4</p>";
                        print_r(mysqli_fetch_array($result, MYSQLI_ASSOC));
                        echo "<p>Call 5</p>";
                        print_r(mysqli_fetch_array($result, MYSQLI_ASSOC));
                        echo "<p>Call 6</p>";
                        print_r(gettype(mysqli_fetch_array($result, MYSQLI_ASSOC)));*/
                        
                        //the below lines are for showing in tabular form. Right now this code is in tabular form
                        echo "<table class='table table-stripped table-hover table-condensed table-bordered'>
                            <tr>
                            <th>ID</th>
                            <th>firstname</th>
                            <th>lastname</th>
                            <th>email</th>
                            <th>password</th>
                            </tr>
                        ";
                        
                        //count will be needed to show the output in the form of an array
                        //$count = 0;
                        //loop will stop when it gets the NULL value after the last row
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                            //the below line will show datas as an array form
                            /*$count++;
                            echo "<p>Row number: $count</p>";
                            print_r($row);*/
                            
                            //the below lines will show datas in a tabular form
                            echo "<tr>";
                                echo "<td>".$row["ID"]."</td>";
                                echo "<td>".$row["firstname"]."</td>";
                                echo "<td>".$row["lastname"]."</td>";
                                echo "<td>".$row["email"]."</td>";
                                echo "<td>".$row["password"]."</td>";
                            echo "</tr>";
                        }
                        echo "/table";
                        
                        //close the result set
                        mysqli_free_result($result);
                    }
                   else{
                       echo "<p>MySQL returned an empty result set.</p>";
                   } 
                }
                else{
                        echo "<p>Unable to execute: $sql. ".mysqli_error($link)."</p>";
                    }
                ?>
                
                
            </div>
        </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>