<?php
include ("validateAuth.php");
require('../../bd/config.php');
$result = '';
$id = 0;
$inventory = 0;
$model = "";
$brand = "";
//récupérer title
$title = "";
$description= "";
$price= 0;
$serialnumber= "";
$releaseDate = "";


if (isset($_REQUEST['id'], $_REQUEST['inventory'], $_REQUEST['model'], $_REQUEST['brand'], $_REQUEST['title'], $_REQUEST['description'], $_REQUEST['price'], $_REQUEST['serialnumber'], $_REQUEST['releaseDate'])){

//récupérer id
$id = stripslashes($_REQUEST['id']);
	$id = mysqli_real_escape_string($conn, $id); 

//récupérer l'inventory
$inventory = stripslashes($_REQUEST['inventory']);
	$inventory = mysqli_real_escape_string($conn, $inventory); 

//récupérer  le modèle
$model = stripslashes($_REQUEST['model']);
	$model = mysqli_real_escape_string($conn, $model); 

//récupérer la marque 
$brand = stripslashes($_REQUEST['brand']);
	$brand= mysqli_real_escape_string($conn, $brand); 

//récupérer title
$title = stripslashes($_REQUEST['title']);
	$title= mysqli_real_escape_string($conn, $title); 

//récupérer la description
$description= stripslashes($_REQUEST['description']);
	$description= mysqli_real_escape_string($conn, $description); 

//récupérer le prix
$price= stripslashes($_REQUEST['price']);
	$price= mysqli_real_escape_string($conn, $price); 

//le numéro de série 
$serialnumber= stripslashes($_REQUEST['serialnumber']);
	$serialnumber= mysqli_real_escape_string($conn, $serialnumber); 

//la date de sortie
$releaseDate = stripslashes($_REQUEST['releaseDate']);
	$releaseDate= mysqli_real_escape_string($conn, $releaseDate); 

	//requéte SQL
if ($id > 0) {
  $query = "UPDATE product set inventory=".$inventory.", model='".$model."', brand='".$brand."', title='".$title."', 
  description='".$description."', price=".$price.", serialnumber='".$serialnumber."', releaseDate='".$releaseDate."' WHERE id = ".$id;
  
} else {
  $query = "INSERT into `product` (productType, inventory, model, brand, title, description, price, serialnumber, releaseDate) VALUES 
('accessory', $inventory, '$model', '$brand', '$title', '$description', $price, '$serialnumber', '$releaseDate');";
}


// Exécute la requête sur la base de données
try {
      $res = mysqli_query($conn, $query);
      $result = $res;
      if($res) {
         $result = 'Ajout du produit réussi! ';
         header("Location: lstProduct.php");
      }    
	} catch (Exception $err) {

      $result = $err;
    }
} else if (isset($_REQUEST["id"])) {
  $query = "SELECT * FROM product WHERE id = ".$_REQUEST["id"];
  $res = mysqli_query($conn, $query);
  $data = mysqli_fetch_assoc($res);
  if ($data) {
    $id = $data["id"];
    $inventory = $data["inventory"];
    $model = $data["model"];
    $brand = $data["brand"];
    $title = $data["title"];
    $description= $data["description"];
    $price= $data["price"];
    $serialnumber= $data["serialnumber"];
    $releaseDate = $data["releaseDate"];
  }

}
?>

<?php 
  include ("../head.php"); 
?>



 

<div class="container">
<div class="row">
<div class="col-2"></div>
<div class="col-8">
<form class="box" action="" method="post">
 <?php
 
  if ($id == 0) {
    echo "<h1>Ajout d'un nouvel accessoire ou périphérique.</h1>";
  } else {
    echo "<h1>Modification d'un accessoire ou périphérique.</h1>";
  }
 ?>
 <p><?php  echo $result ?></p>
 <input type="hidden" name="id" value="<?php echo $id; ?>">
<div class="form-group">
 <label for="brand"><b>Marque de l'accessoire *:</b></label>
 <input type="text" placeholder="Entrer la marque" id="brand" name="brand" required="true" aria-required="true" value="<?php echo $brand; ?>">
</div>
 <div class="form-group">
 <label for="model"><b>Modèle *:</b></label>
 <input type="text" placeholder="Entrer le modèle" id="model" name="model" required="true" aria-required="true" value="<?php echo $model; ?>">
</div>
<div class="form-group">
 <label for="title"><b>Nom complet *:</b></label>
 <input type="text" placeholder="Entrer le nom complet" id="title" name="title" required="true" aria-required="true" value="<?php echo $title; ?>">
</div>
<div class="form-group">
 <label for="serialnumber"><b>Entrez le numéro de série du produit *:</b></label>
 <input type="text" placeholder="Entrer le numéro de série" id="serialnumber" name="serialnumber" required="true" aria-required="true" value="<?php echo $serialnumber; ?>">
</div>
<div class="form-group">
 <label for="Description"><b>Entrez une description *:</b></label>
<textarea placeholder="Entrer une description" id="description" name="description" rows="5" cols="20" required="true" aria-required="true" > <?php echo $description; ?> </textarea>
</div>
<div class="form-group">
 <label for="price"><b>Prix du produit ?*: </b></label>
 <input type="number" id="price" name="price" min=0 step="0.01" required="true" aria-required="true" value="<?php echo $price; ?>">
</div>
 <div class="form-group">
 <label for="inventory"><b>Nombre de pièces ? *: </b></label>
 <input type="number" id="inventory" name="inventory" min=0 required="true" aria-required="true" value="<?php echo $inventory; ?>">
</div>
<div class="form-group">
 <label for="releaseDate"><b>Entrez la date de sortie du produit *:</b></label>
 <input type="date" id="releaseDate" name="releaseDate" select(en-US) required="true" aria-required="true" value="<?php echo $releaseDate; ?>">
</div>

<input type="submit" name="valider" placeholder="Envoyer "/>
<input type="reset" name="effacer" placeholder="effacer"/>
 
 </form>
 </div>
 <div class="col-2"></div>
 </div>
 </div>

<?php include ("../footer.php"); ?>