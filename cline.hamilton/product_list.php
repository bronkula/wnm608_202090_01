<?php

include_once "lib/php/functions.php";
include_once "parts/templates.php";
include_once "data/api.php";



setDefault('s','');
setDefault('t','products_all');
setDefault('orderby_direction','DESC');
setDefault('orderby','date_create');
setDefault('limit','12');




function makeSortOptions() {
   $options = [
      ["date_create","DESC","Latest Products"],
      ["date_create","ASC","Oldest Products"]
   ];
   foreach($options as [$orderby,$direction,$title]) {
      echo "
      <option data-orderby='$orderby' data-direction='$direction'
      ".($_GET['orderby']==$orderby && $_GET['orderby_direction']==$direction ? "selected" : "").">
      $title
      </option>
      ";
   }
}




if(isset($_GET['t'])) {


//    $filename = "data/api.php?".http_build_query($_GET);
// echo $filename;
   // $result = file_get_json($filename);



   $result = makeStatement($_GET['t']);
   $products = isset($result['error']) ? [] : $result;



   // print_p($result);
   // die;
} else {
   $result = makeStatement('products_all');
   $products = isset($result['error']) ? [] : $result;
}


?><!DOCTYPE html>
<html lang="en">
<head>
   <title>Product List</title>

   <?php include "parts/meta.php" ?>
</head>
<body>
   
   <?php include "parts/navbar.php" ?>

   <div class="container">

      <form action="product_list.php" method="get" class="hotdog stack">
         <input type="search" name="s" placeholder="Search for a product"
         value="<?= @$_GET['s'] ?>">

         <input type="hidden" name="orderby" value="<?=$_GET['orderby']?>">
         <input type="hidden" name="orderby_direction" value="<?=$_GET['orderby_direction']?>">
         <input type="hidden" name="limit" value="<?=$_GET['limit']?>">

         <input type="hidden" name="t" value="search">
         <button type="submit">Search</button>
      </form>

      <form action="product_list.php" method="get">
         <input type="hidden" name="s" value="<?=$_GET['s']?>">
         <input type="hidden" name="limit" value="<?=$_GET['limit']?>">
         <input type="hidden" name="orderby">
         <input type="hidden" name="orderby_direction">

         <div class="form-select">
            <select onchange="checkSort(this)">
               <?=makeSortOptions()?>
            </select>
         </div>
      </form>

      <h2>Product List</h2>

      <div class="grid gap">
        
         <?php

         echo array_reduce(
            $products,
            'makeProductList'
         );

         ?>
      </div>
   </div>

</body>
</html>