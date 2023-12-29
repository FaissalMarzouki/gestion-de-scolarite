<?php

/* declaration des variable php avec  la connect  a la base de donnee*/
        $servername="localhost";
        $username="root";
        $password="Benoit@2001";
        $databasename="PHPPROJECT";

        $connection = new mysqli($servername, $username, $password, $databasename);



$identifiant="";
$matiere="";

$errorMessage="";
$sucessMessage="";

if($_SERVER['REQUEST_METHOD']=='POST')
{
    $identifiant=$_POST["identifiant"];
    $matiere=$_POST["matiere"];
    
}

do{
 if(empty($identifiant)||empty($matiere))
 {
    $errorMessage="Tous les champs sont obliigatoires";
    break;
 }
  
 // add new value to the data base;

 $sql= "INSERT INTO Departement VALUES ('$identifiant','$matiere');";
   $result=$connection->query($sql);
   if(!$result)
   {
    $errorMessage="Invalid query: " .$connection->error;
    break;
   }
    
 $identifiant="";
 $matiere="";
 
 

 $sucessMessage="Le  departement a ete ajouter avec sucess";
 
 header("location: /PHPPROJECT/CrudDispenser/indexdispenser.php");
  exit;

} while(false);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de dispeser</title>
    <link rel="Stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <scipt scr="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></scrip>
</head>
<body>
    <div  class="container my-5"> 
     <h2>nouveau dispenser</h2>

     <?php
     if(!empty($errorMessage)) 
     {
        echo"
           <div class='alert alert- warning alert-dismissible fade show' role='alert'> 
           <strong>$errorMessage</strong>
           <button type ='button' class='buton-close' data-bs-dismiss='alert' aria-label='Close'></button>
           </div>
        ";
     }
     ?>
      <from method="post"> 
        <div class="row mb-3"> 
           <label class="col-sm-3 col-form-label">numero de salle</label>
            <div class ="col-sm-6">
             <input type="text" class="form-control" name="identifiant" value="<?php echo $identifiant?>">        
        </div>
        </div>
        <div class="row mb-3"> 
           <label class="col-sm-3 col-form-label">numero de matiere</label>
            <div class ="col-sm-6">
             <input type="text" class="form-control" name="matiere" value="<?php echo $matiere?>">        
        </div>
        </div>

        <!--  display succes message-->
        <?php
     if(!empty($sucessMessage)) 
     {
        echo"
           <div class='alert alert- warning alert-dismissible fade show' role='alert'> 
           <strong>$sucessMessage</strong>
           <button type ='button' class='buton-close' data-bs-dismiss='alert' aria-label='close'></button>
           </div>
        ";
     }
     ?>

        <div class="row mb-3"> 
           
            <div class ="offset-sm-3 col-sm-3 d-grid">
             <button type="submit" class="btn btn-primary">Submit</button>        
            </div>
            <div class ="col-sm-3 d-grid">
             <a class ="btn btn-outline-primary" href="/PHPPROJECT/CrudDispenser/indexdispenser.php" role="button">Cancel</a>        
            </div>
        </div>
      </form>
    </div>
</body>
</html>