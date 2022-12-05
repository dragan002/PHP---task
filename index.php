<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://use.fontawesome.com/bd34feb1e2.js"></script>
    <title>Document</title>
</head>

<?php 

    require('user_validator.php');


    if(isset($_POST['submit'])) {
       $validation = new UserValidator($_POST);
       $errors = $validation->validateForm();
       
    }
    
?>
    <!--=====================Tabela===============================-->
    <div>
        <table class="content_table">
            <thead>
            <tr >
                <th>Ime</th>
                <th>Prezime</th>
                <th>Broj telefona</th>
                <th>E-mail</th>
                <th>Izbrisi</th>
            </tr>
        </thead>

             <tbody>
            <tr>
                <td>Pero</td>
                <td>Peric</td>
                <td>065 342 345</td>
                <td>pero.peric@gmail.com</td>
                <td id="close"><span>&#10005;</span></td>
            </tr>
            

            <tr>
                <td>Marko</td>
                <td>Markovic</td>
                <td>066 432 193</td>
                <td>markovic2831@gmail.com</td>
                <td id="close"><span>&#10005;</span></td>
            </tr>
        </tbody>
        </table>
    </div>

    <?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "clients";

    $connection = new mysqli($servername, $username, $password, $database);

    if($connection -> connect_error) {
        die("Connectio failed: " . $connection->connect_error);
    }

    $sql = "SELECT * FROM clientlist";
    $result = $connection->query($sql);

    if(!$result) {
        die("Invalid query:" . $connection->error);
    }

    while($row = $result ->fetch_assoc()) {
        echo " 
        <tr>
        <td>$row[id]</td>
        <td>$row[ime]</td>
        <td>$row[prezime]</td>
        <td>$row[mobile]</td>
        <td>$row[email]</td>
        <td>
            <a class='btn btn-primary btn-sm' href = 'edit.php?id=$row[id]'>EDIT</a>
            <a class='btn btn-primary btn-sm' href = 'delete.php?id=$row[id]'>DELETE</a>
        </td>
    </tr>
        ";
    }
    ?>
    <!--==========================Information===============-->
    <div class="information">
        <div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
        <label for="name"></label>
        <input type="text" name="ime" id="" placeholder="Ime" require>
        <div class="error">
            <?php echo $errors['ime'] ?? ''?>
        </div>
        </div>
    
        <div>
        <label for="prezime"></label>
        <input type="text" name="prezime" id="" placeholder="Prezime" require>
        <div class="error">
            <?php echo $errors['prezime'] ?? ''?>
        </div>
        </div>

        <div>
        <label for="mobile"></label>
        <input type="text" name="mobile" placeholder="Broj telefona" require>
        <div class="error">
            <?php echo $errors['mobile'] ?? ''?>
        </div>
        </div>  

        <div>
        <label for="email"></label>
        <input type="text" name="email" placeholder="E-mail" require>
        <div class="error">
            <?php echo $errors['email'] ?? ''?>
        </div>
        </div>
  
        <div>
        <input type="submit" value="Submit" id="btn" name="submit">
        <input type="submit" value="Edit" id="btn" name="edit">
        <input type="submit" value="Delete" id="btn" name="delete">
        </form>
        </div>
    </div>
    
</body>

</html>