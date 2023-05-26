<?php
$title="Mon panier";
// connection à la base de donné 
include_once("..\bd\Connect_Database.php");



function articlePanier()
{
  if (isset($_GET["panier"]))
  {
      $product_id = htmlspecialchars($_GET["panier"]);
      $panier = decomptePanier($product_id);
      $_SESSION['product_'.$_GET['panier']] += 1;

      return $_SESSION['product_'.$_GET['panier']];
  }
}



// function pour diminuer la quantité d'un produit

function removeArticle()
{
  if(isset($_GET['remove']))
  {
    $_SESSION['product_'.$_GET['remove']]--;

    if($_SESSION['product_'.$_GET['remove']] < 1)
    {
      echo "<p>votre produit n'est plus dans votre panier</p>";

    }

  }
}


function deleteDuPanier()
{
  $message = "";
  if(isset($_GET['delete']))
  {
    $_SESSION['product_'.$_GET['delete']] = '0';
      $message = "article supprimé du panier";
  }

}

/**
 * [displayInPanier permet d'afficher les produits et leurs caracterisque dans le panier
 *                   les functions substr et strlen permet de soustraire les caracteres pour en retirer l'id]
 * @return [type] [description]
 */


function displayInPanier($name)
{
  foreach ($_SESSION as $name => $value)
  {
    if ($value > 0)
    {
      if(substr($name, 0, 8) == "product_")
      {
        $length = strlen($name - 8);
        $id = substr($name, 8, $length);
        displayArticleInPanier($id);
        return displayArticleInPanier($id);
      }
    }
  }
}

  // function giveId($param)
  // {
  //   $length = strlen($param - 8);
  //   $id = substr($param, 8, $length);
  //   return $id;
  // }



function decomptePanier($product)
{

    $db = database();

    $request = $db->query('SELECT id, inventory, brand, title, model, price, productType  FROM produits WHERE product_id='.$product.'');

      return $request;

}

function displayArticleInPanier($prod_id)
{
  $bdd = database();
  $requestArticle = $bdd->prepare('SELECT id, inventory, brand, title, model, price, productType FROM produits WHERE product_id= :id');
  $requestArticle->execute(array(
    'id' => $prod_id
  ));
  return $requestArticle;
}


  $articles = articlePanier();
  if(is_array($articles) || is_object($articles))
  {
    foreach($articles as $article)
    {
      $article_qte = $article["product_quantite"];
      if ($article_qte < $_SESSION['product_'.$_GET['panier']])
      {
        echo "<p> les nombres de produit disponibles est pour cet article est de ".$article_qte."</p>";
        header("location: panier.php");
      }
      else
      {
        $_SESSION['product_'.$_GET['panier']] += 1;
      }
    }

  }




?>

<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Affichage de votre panier </title>
<meta name="language"  content="fr"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta name="author" content="Thomas Zimmer"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Crimson+Text" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css" />

</head>
<body>


<h1> PANIER </h1>
<div class="tableauPanier">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>produit</th>
        <th>prix</th>
        <th>quantité</th>
        <th>total</th>
        <th>actions</th>

      </tr>
    </thead>
    <tbody>
      <?php
      $totalArticle = 0;
      if (isset($_GET['panier'], $_SESSION['product_'.$_GET['panier']]))
      {
            $total = "";
            $id = $_SESSION['product_'.$_GET['panier']];
            $_SESSION['total_article'] =  $totalArticle += $id;
            $displayArticles = displayInPanier($id);

            if (is_array($displayArticles) || is_object($displayArticles))
            {
              foreach ($displayArticles as $displayArticle)
              {
                $product_titre = $displayArticle['product_titre'];
                $product_prix =  $displayArticle['product_prix'];
                $product_quantite =  $displayArticle['product_quantite'];
                $product_id =  $displayArticle['product_id'];

                $prixTotal = $product_prix * $_SESSION['product_'.$_GET['panier']];
                $_SESSION['total_items'] = $total += $prixTotal;
                echo "
                      <tr>
                        <td>".$product_titre."</td>
                        <td>".$product_prix." €</td>
                        <td>".$_SESSION['product_'.$_GET['panier']]."</td>
                        <td>".$prixTotal."€</td>
                        <td>
                            <a class='btn btn-warning' href='panier.php?remove=".$product_id."'><span class='glyphicon glyphicon-minus'></span></a>
                            <a class='btn btn-success' href='panier.php?panier=".$product_id."'><span class='glyphicon glyphicon-plus'></span></a>
                            <a class='btn btn-danger' href='panier.php?delete=".$product_id."'><span class='glyphicon glyphicon-remove'></span></a>
                        </td>
                      </tr>";
              }

            }
        }


      ?>


    </tbody>
  </table>


  <div class="col-xs-4 pull-right">
    <h2>totaux</h2>
    <table class="table table-bordered" cellspacing="0">
      <tr>
        <th>articles:</th>
        <td><span class="amount">
          <?php
          if (isset($_SESSION['total_article']))
            {
              echo $totalArticle;
            }

           ?>
        </span></td>
      </tr>
      <tr>
        <th>prix total:</th>
        <td><span class="amount">
          <?php if (isset($_SESSION['total_items']))
            {
              echo $_SESSION['total_items']. "€";
            }
          ?>
        </span></td>
<td> <button> valider votre panier </button> </td>
      </tr>
    </table>
  </div>
</div>
</body>
</html>