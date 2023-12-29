<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecole</title>
    <link rel="Stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>
<body>
    <div class="Container my -5">
     <h2> La liste des  departements</h2>
     <a class ="btn btn -primary btn-sm" href="/PHPPROJECT/CrudEnsignercreate.php" role="button">
        Ajouter 
         un nouveau enseiigner </a>
     </div>
     <br>
     <table class="table"> 
        <tr>
        <thead>
         <th>L'identifiant de l'enseigneer</th>
         <th>  L'identifiant de  matiere</th>

     </tr>
       </thead>

       <tbody>
        <?php 

        /* declaration des variable php avec  la connect  a la base de donnee*/
        $servername="localhost";
        $username="root";
        $password="Benoit@2001";
        $databasename="PHPPROJECT";

        $connection = new mysqli($servername, $username, $password, $databasename);

        //  Connection de  du php a la base de donnee
        if ($connection->connect_error)
         {
        die("Connection failed: " . $connection->connect_error);
         }
         // read all the row from database table
         $sql="SELECT * FROM Departement";
         $result=$connection->query($sql);

         // pour verifier si la lecture a ete efficace

         if(!$result)
         {
            die("Invalid query:" .$conn->connect_error);
         }
         //read data of each row
        
         while($row= $result->fetch_assoc())
         {
            echo"
            <tr> 
            <td>$row[ID_ENSEIGNER]</td>
            <td>$row[ID_MATIERE] </td>
            
            <td>
            <a  class ='btn btn-primary btn -sm' href ='/PHPPROJECT/edit.php?ID_DEPARTEMENT=$row[ID_ENSEIGNER]'>Modifier</a>
            <a  class ='btn btn-danger btn -sm' href ='/PHPPROJECT/delete.php?ID_DEPARTEMENT=$row[ID_ENSEISI]'>Supprimer</a>
             </td>  
        </tr>
            ";
         }

        ?>
       
        <!-- <tr> 
            <td>10 </td>
            <td>informatique </td>
            <td>ouibv</td>
            <td>
            <a  class ="btn btn-primary btn -sm" href ="/PHPPROJECT/edit.php">Edit</a>
            <a  class ="btn btn-danger btn -sm" href ="/PHPPROJECT/Deleate.php">Deleate</a>
            </td>  
        </tr>
        -->
         </tbody>
     </table>
</body>
</html>