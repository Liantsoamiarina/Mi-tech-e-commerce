<?php
$cle = $_SERVER["REQUEST_URI"];

$routes = [
  // URL des Views
  [
    "cle"=>"/^\/$/",
    "page"=>"../Views/home.php",
    "label"=>"",
    "style"=>"home",
    "titlePage"=>"Mi-Tech",
  ],
  [
    "cle"=>"/^\/dashboard$/",
    "page"=>"../Views/dashboard.php",
    "label"=>"template",
    "style"=>"dasboard",
    "titlePage"=>"Mi-Tech | Admin-Dashboard",
  ],
  [
    "cle"=>"/^\/produits$/",
    "page"=>"../Views/produit.php",
    "label"=>"template",
    "style"=>"produits",
    "titlePage"=>"Mi-Tech | Admin-produits",
  ],
  [
    "cle"=>"/^\/login$/",
    "page"=>"../Views/login.php",
    "label"=>"",
    "style"=>"login",
    "titlePage"=>"Mi-Tech | Client",
  ],
  [
    "cle"=>"/^\/admin$/",
    "page"=>"../Views/admin.php",
    "label"=>"",
    "style"=>"login",
    "titlePage"=>"Mi-Tech | Admin",
  ],
  [
    "cle"=>"/^\/signin$/",
    "page"=>"../Views/signin.php",
    "label"=>"",
    "style"=>"login",
    "titlePage"=>"Mi-Tech | Welcome",
  ],
  [
    "cle" => "/^\/cartinfo(\?.*)?$/",
    "page" => "../Views/cart.php",
    "label" => "",
    "style" => "home",
    "titlePage" => "Mi-Tech | Madagascar",
  ],
  [
    "cle"=>"/^\/commande$/",
    "page"=>"../Views/commande.php",
    "label"=>"template",
    "style"=>"produits",
    "titlePage"=>"Mi-Tech | Admin-commande",
  ],
  [
    "cle"=>"/^\/clients$/",
    "page"=>"../Views/client.php",
    "label"=>"template",
    "style"=>"produits",
    "titlePage"=>"Mi-Tech | Admin-client",
  ],


  // URL des Controllers
  [
    "cle"=>"/^\/inscription$/",
    "page"=>"../Controller/client/signinControl.php",
    "label"=>"",
    "style"=>"",
    "titlePage"=>"Mi-Tech | Madagascar",
  ],
  [
    "cle"=>"/^\/userConnexion$/",
    "page"=>"../Controller/client/loginControl.php",
    "label"=>"",
    "style"=>"",
    "titlePage"=>"Mi-Tech | Madagascar",
  ],
  [
    "cle"=>"/^\/adminConnexion$/",
    "page"=>"../Controller/admin/loginControl.php",
    "label"=>"",
    "style"=>"",
    "titlePage"=>"Mi-Tech | Madagascar",
  ],
  [
    "cle"=>"/^\/addproduct$/",
    "page"=>"../Controller/produit/add.php",
    "label"=>"",
    "style"=>"",
    "titlePage"=>"Mi-Tech | Madagascar",
  ],
  [
    "cle"=>"/^\/deleteproduct$/",
    "page"=>"../Controller/produit/delete.php",
    "label"=>"",
    "style"=>"",
    "titlePage"=>"Mi-Tech | Madagascar",
  ],
  [
    "cle"=>"/^\/editproduct$/",
    "page"=>"../Controller/produit/edit.php",
    "label"=>"",
    "style"=>"",
    "titlePage"=>"Mi-Tech | Madagascar",
  ],
  [
    "cle"=>"/^\/addtocart$/",
    "page"=>"../Controller/panier/add.php",
    "label"=>"",
    "style"=>"",
    "titlePage"=>"Mi-Tech | Madagascar",
  ],
  [
    "cle"=>"/^\/passcommande$/",
    "page"=>"../Controller/commande/passer.php",
    "label"=>"",
    "style"=>"",
    "titlePage"=>"Mi-Tech | Madagascar",
  ],
  [
    "cle"=>"/^\/statut$/",
    "page"=>"../Controller/commande/statut.php",
    "label"=>"",
    "style"=>"",
    "titlePage"=>"Mi-Tech | Madagascar",
  ],
  [
    "cle"=>"/^\/deleteuser$/",
    "page"=>"../Controller/client/delete.php",
    "label"=>"",
    "style"=>"",
    "titlePage"=>"Mi-Tech | Madagascar",
  ],
  [
    "cle"=>"/^\/signout$/",
    "page"=>"../Controller/admin/signout.php",
    "label"=>"",
    "style"=>"",
    "titlePage"=>"Mi-Tech | Madagascar",
  ],
  [
    "cle"=>"/^\/signoutclient$/",
    "page"=>"../Controller/client/signout.php",
    "label"=>"",
    "style"=>"",
    "titlePage"=>"Mi-Tech | Madagascar",
  ],
];

$pageFound = false;

foreach ($routes as $r) {
    if(preg_match($r["cle"],$cle)){
      $_SESSION["label"] = $r["label"];
      $_SESSION["style"] = $r["style"];
      $_SESSION["titlePage"] = $r["titlePage"];
      require $r["page"];
      $pageFound = true;
      break;
    }
}

if (!$pageFound) {
  $_SESSION["label"] = "";
  $_SESSION["style"] = "";
  $_SESSION["titlePage"] = "Mi-Tech | Page Not Found";
  require "../Views/notFound.php";
}

