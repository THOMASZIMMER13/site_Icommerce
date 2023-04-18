<?php
include ("validateAuth.php");
require('..\..\bd\config.php');
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
$processor= "";
$ram = "";
$storage= "";
$os= "";
$screenSize= "";

if (isset($_REQUEST['inventory'], $_REQUEST['model'], $_REQUEST['brand'], $_REQUEST['title'], $_REQUEST['description'], $_REQUEST['price'], $_REQUEST['serialnumber'], $_REQUEST['releaseDate'], $_REQUEST['processor'], $_REQUEST['ram'], $_REQUEST['storage'], $_REQUEST['os'])){
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

//le processeur
$processor= stripslashes($_REQUEST['processor']);
	$processor= mysqli_real_escape_string($conn, $processor); 

//la ram
$ram= stripslashes($_REQUEST['ram']);
	$ram= mysqli_real_escape_string($conn, $ram); 

//le stocage
$storage= stripslashes($_REQUEST['storage']);
	$storage= mysqli_real_escape_string($conn, $storage); 

//l'os
$os= stripslashes($_REQUEST['os']);
	$os= mysqli_real_escape_string($conn, $os); 

//la taille 
$screenSize= stripslashes($_REQUEST['screenSize']);
	$screenSize= mysqli_real_escape_string($conn, $screenSize); 

	//requéte SQL
if ($id > 0) {
  $query = "UPDATE product set inventory=".$inventory.", model='".$model."', brand='".$brand."', title='".$title."', 
  description='".$description."', price=".$price.", serialnumber='".$serialnumber."', releaseDate='".$releaseDate."', processor='".$processor."', ram=".$ram.", 
  storage=".$storage.", os='".$os."', screenSize=".$screenSize." WHERE id = ".$id;
} else {
  $query = "INSERT into `product` (productType, inventory, model, brand, title, description, price, serialnumber, releaseDate, processor, ram, storage, os, screenSize) VALUES 
('laptop', $inventory, '$model', '$brand', '$title', '$description', $price, '$serialnumber', '$releaseDate', '$processor', $ram, $storage, '$os', $screenSize);";
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
    $processor= $data["processor"];
    $ram = $data["ram"];
    $storage= $data["storage"];
    $os= $data["os"];
    $screenSize= $data["screenSize"];
  }

}
?>

<?php 
  include ("../head.php"); 
?>



<div class="container">
<div class="row">
<div class="col-2"></div>
<div class="col-8>">
<form class="box" action="" method="post">
<<?php
 
  if ($id == 0) {
    echo "<h1>Ajout d'un nouvel ordinateur portable.</h1>";
  } else {
    echo "<h1>Modification d'un ordinateur portable.</h1>";
  }
 ?>
 <p><?php  echo $result ?></p>
 <input type="hidden" name="id" value="<?php echo $id; ?>">
<div class="form-group">
 <label for="brand"><b>Marque de l'ordinateur portable*:</b></label>
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


<div class="form-group">
 <label for="processor"><b>Nom complet du processeur *:</b></label>
 <input type="text" placeholder="Entrer le nom complet du processeur" id="processor" name="processor" required="true" aria-required="true" value="<?php echo $processor; ?>">
</div>
<div class="form-group">
 <label for="ram"><b>RAM ?*: </b></label>
 <input type="number" id="ram" name="ram" min=0 required="true" aria-required="true" value="<?php echo $ram; ?>">
</div>
<div class="form-group">
 <label for="storage"><b>Stocage ?*: </b></label>
 <input type="number" id="storage" name="storage" min=128 required="true" aria-required="true" value="<?php echo $storage; ?>">
</div>
<div class="form-group">
 <label for="os"><b>Systhème d'exploitation? *:</b></label>
 <input type="text" placeholder="Systhème d'exploitation" id="os" name="os" required="true" aria-required="true" value="<?php echo $os; ?>">
</div>
<div class="form-group">
 <label for="screenSize"><b>Taille du produit en pouce*: </b></label>
 <input type="number" id="screenSize" name="screenSize" min=11 step="0.1" required="true" aria-required="true" value="<?php echo $screenSize; ?>">
</div>

<input type="submit" name="valider" placeholder="Envoyer  "/>
<input type="reset" name="effacer" placeholder="effacer"/>
 
 </form>
 </div>
 <div class="col-2"></div>
 </div>
 </div>

<?php include ("../footer.php"); ?>