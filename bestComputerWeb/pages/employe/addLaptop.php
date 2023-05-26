<?php
$title = "Titre";
include_once("../head.php");
include_once("validateAuth.php");
// require('..\..\bd\config.php');

/* 
 * Déclaration / initialisation de mes variables 
*/
$result = '';
$erreur = 0;
$id = 0;
$inventory = 0;
$model = "";
$brand = "";
$title = "";
$description = "";
$price = 0;
$serialnumber = "";
$releaseDate = "";
$processor = "";
$ram = "";
$storage = "";
$os = "";
$screenSize = "";
$img = "";
if (isset($_REQUEST['inventory'], $_REQUEST['model'], $_REQUEST['brand'], $_REQUEST['title'], $_REQUEST['description'], $_REQUEST['price'], $_REQUEST['serialnumber'], $_REQUEST['releaseDate'], $_REQUEST['processor'], $_REQUEST['ram'], $_REQUEST['storage'], $_REQUEST['os'], $_REQUEST['img'])) {
  /* 
    * Récupération des données
    * ID
    * INVENTORY
    * MODEL
    * BRAND
    * TITLE
    * DESCRIPTION
    * PRICE
    * SERIALNUMBER
    * RELEASE DATE
    * PROCESSOR
    * RAM
    * STORAGE
    * OS
    * SCREEN SIZE
    * IMAGE
    */
  $id = mysqli_real_escape_string($conn, stripslashes($_REQUEST['id']));
  $inventory = mysqli_real_escape_string($conn, stripslashes($_REQUEST['inventory']));
  $model = mysqli_real_escape_string($conn, stripslashes($_REQUEST['model']));
  $brand = mysqli_real_escape_string($conn, stripslashes($_REQUEST['brand']));
  $title = mysqli_real_escape_string($conn, stripslashes($_REQUEST['title']));
  $description = mysqli_real_escape_string($conn, stripslashes($_REQUEST['description']));
  $price = mysqli_real_escape_string($conn, stripslashes($_REQUEST['price']));
  $serialnumber = mysqli_real_escape_string($conn, stripslashes($_REQUEST['serialnumber']));
  $releaseDate = mysqli_real_escape_string($conn, stripslashes($_REQUEST['releaseDate']));
  $processor = mysqli_real_escape_string($conn, stripslashes($_REQUEST['processor']));
  $ram = mysqli_real_escape_string($conn, stripslashes($_REQUEST['ram']));
  $storage = mysqli_real_escape_string($conn, stripslashes($_REQUEST['storage']));
  $os = mysqli_real_escape_string($conn, stripslashes($_REQUEST['os']));
  $screenSize = mysqli_real_escape_string($conn, stripslashes($_REQUEST['screenSize']));
  $img = mysqli_real_escape_string($conn, stripslashes($_REQUEST['img']));

  //requéte SQL
  if ($id > 0) {
    $query = "UPDATE product 
              SET inventory='" . $inventory . "', 
                  model='" . $model . "', 
                  brand='" . $brand . "', 
                  title='" . $title . "', 
                  description='" . $description . "', 
                  price=" . $price . ", 
                  serialnumber='" . $serialnumber . "', 
                  releaseDate='" . $releaseDate . "', 
                  processor='" . $processor . "', 
                  ram='" . $ram . "', 
                  storage=" . $storage . ", 
                  os='" . $os . "', 
                  screenSize=" . $screenSize . ", 
                  img='" . $img . "' 
               WHERE id = " . $id;
  } else {
    $query = "INSERT into `product` (productType, inventory, model, brand, title, description, price, serialnumber, releaseDate, processor, ram, storage, os, screenSize, img) 
              VALUES ('laptop', $inventory, '$model', '$brand', '$title', '$description', $price, '$serialnumber', '$releaseDate', '$processor', $ram, $storage, '$os', $screenSize, '$img');";
  }

  // Exécute la requête sur la base de données
  try {
    $res = mysqli_query($conn, $query);
    $result = $res;
    if ($res) {
      $result = 'Ajout du produit réussi! ';
      header("Location: lstProduct.php");
    }
  } catch (Exception $err) {
    $result = $err;
  }
} else if (isset($_REQUEST["id"])) {
  $query = "SELECT id, inventory, brand, model, title, description, price, serialnumber, releaseDate, processor, ram, storage, os, screenSize, productType, img FROM product WHERE id = " . $_REQUEST["id"];
  $res = mysqli_query($conn, $query);
  $data = mysqli_fetch_assoc($res);
  if ($data) {
    $id = $data["id"];
    $inventory = $data["inventory"];
    $model = $data["model"];
    $brand = $data["brand"];
    $title = $data["title"];
    $description = $data["description"];
    $price = $data["price"];
    $serialnumber = $data["serialnumber"];
    $releaseDate = $data["releaseDate"];
    $processor = $data["processor"];
    $ram = $data["ram"];
    $storage = $data["storage"];
    $os = $data["os"];
    $screenSize = $data["screenSize"];
    $img = $data["img"];
  }
}
?>

<div class="container">
  <div class="row">
    <div class="col-2"></div>
    <div class="col-8" style="padding-bottom: 3em">
      <div class="p-4 p-md-4 mb-2">
        <?php if ($id == 0) { ?>
          <h1><i class="bi bi-laptop"></i>Ajout d'un nouvel ordinateur portable</h1>
        <?php } else { ?>
          <h1><i class="bi bi-laptop"></i>Modification d'un ordinateur portable</h1>
        <?php } ?>
      </div>
      <?php if (!empty($err)) { ?>
        <div class="alert alert-danger" role="alert">
          <i class="bi bi-exclamation-circle-fill" style="margin-right:10px"></i>
          <?php echo $erreur; ?>
        </div>
      <?php } elseif (!empty($result)) { ?>
        <div class="alert alert-success" role="alert">
          <i class="bi bi-check-lg"></i>
          <?php echo $result; ?>
        </div>
      <?php } ?>
      <form action="" method="post" class="grid">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="mb-4 row">
          <label for="brand" class="col-sm-4 col-form-label">Marque *:</label>
          <div class="col-sm-8">
            <input class="form-control" type="text" placeholder="Entrer la marque" id="brand" name="brand" required="true" aria-required="true" value="<?php echo $brand; ?>">
          </div>
        </div>
        <div class="mb-4 row">
          <label for="model" class="col-sm-4 col-form-label">Modèle *:</label>
          <div class="col-sm-8">
            <input class="form-control" type="text" placeholder="Entrer le modèle" id="model" name="model" required="true" aria-required="true" value="<?php echo $model; ?>">
          </div>
        </div>
        <div class="mb-4 row">
          <label for="title" class="col-sm-4 col-form-label">Désignation *:</label>
          <div class="col-sm-8">
            <input class="form-control" type="text" placeholder="Entrer le nom complet" id="title" name="title" required="true" aria-required="true" value="<?php echo $title; ?>">
          </div>
        </div>
        <div class="mb-4 row">
          <label for="serialnumber" class="col-sm-4 col-form-label">N° de série *:</label>
          <div class="col-sm-8">
            <input class="form-control" type="text" placeholder="Entrer le numéro de série" id="serialnumber" name="serialnumber" required="true" aria-required="true" value="<?php echo $serialnumber; ?>">
          </div>
        </div>
        <div class="mb-4 row">
          <label for="description" class="col-sm-4 col-form-label">Description *:</label>
          <div class="col-sm-8">
            <textarea class="form-control" placeholder="Entrer une description" id="description" name="description" rows="5" cols="20" required="true" aria-required="true"> <?php echo $description; ?> </textarea>
          </div>
        </div>
        <div class="mb-4 row">
          <label for="price" class="col-sm-4 col-form-label">Prix unitaire TTC *:</label>
          <div class="col-sm-8">
            <input class="form-control" type="number" id="price" name="price" min=0 step="0.01" required="true" aria-required="true" value="<?php echo $price; ?>">
          </div>
        </div>
        <div class="mb-4 row">
          <label for="inventory" class="col-sm-4 col-form-label">Stock disponible *:</label>
          <div class="col-sm-8">
            <input class="form-control" type="number" id="inventory" name="inventory" min=0 required="true" aria-required="true" value="<?php echo $inventory; ?>">
          </div>
        </div>
        <div class="mb-4 row">
          <label for="releaseDate" class="col-sm-4 col-form-label">Date de sortie *:</label>
          <div class="col-sm-8">
            <input class="form-control" type="date" id="releaseDate" name="releaseDate" select(en-US) required="true" aria-required="true" value="<?php echo $releaseDate; ?>">
          </div>
        </div>
        <div class="mb-4 row">
          <label for="processor" class="col-sm-4 col-form-label">Processeur *:</label>
          <div class="col-sm-8">
          <input class="form-control" type="text" placeholder="Entrer le nom complet du processeur" id="processor" name="processor" required="true" aria-required="true" value="<?php echo $processor; ?>">
          </div>
        </div>
        <div class="mb-4 row">
          <label for="ram" class="col-sm-4 col-form-label">RAM *:</label>
          <div class="col-sm-8">
          <input class="form-control" type="number" id="ram" name="ram" min=0 required="true" aria-required="true" value="<?php echo $ram; ?>">
          </div>
        </div>
        <div class="mb-4 row">
          <label for="storage" class="col-sm-4 col-form-label">Stockage *:</label>
          <div class="col-sm-8">
          <input class="form-control" type="number" id="storage" name="storage" min=128 required="true" aria-required="true" value="<?php echo $storage; ?>">
          </div>
        </div>
        <div class="mb-4 row">
          <label for="os" class="col-sm-4 col-form-label">Systhème d'exploitation *:</label>
          <div class="col-sm-8">
          <input class="form-control" type="text" placeholder="Systhème d'exploitation" id="os" name="os" required="true" aria-required="true" value="<?php echo $os; ?>">
          </div>
        </div>
        <div class="mb-4 row">
          <label for="screenSize" class="col-sm-4 col-form-label">Taille du produit en pouce *:</label>
          <div class="col-sm-8">
          <input class="form-control" type="number" id="screenSize" name="screenSize" min=11 step="0.1" required="true" aria-required="true" value="<?php echo $screenSize; ?>">
          </div>
        </div>
        <div class="mb-4 row">
          <label for="img" class="col-sm-4 col-form-label">Sélectionner l'image :</label>
          <div class="col-sm-8">
            <input class="form-control" type="file" id="img" name="img" value="<?php echo $img; ?>">
          </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
          <input type="reset" name="effacer" placeholder="effacer" class="btn btn-sm btn-outline-danger" />
          <input type="submit" name="valider" placeholder="Envoyer " class="btn btn-sm btn-success" />
        </div>
      </form>
    </div>
    <div class="col-2"></div>
  </div>
</div>

<?php include("../footer.php"); ?>