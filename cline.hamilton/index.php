<?php

include_once "lib/php/functions.php";
include_once "parts/templates.php";

?><!DOCTYPE html>
<html lang="en">
<head>
   <title>Store</title>

   <?php include "parts/meta.php" ?>
</head>
<body>
   
   <?php include "parts/navbar.php" ?>



   <div class="view-window" style="background-image:url(img/mountains001.jpg)">
      <h2>Food Stuffs</h2>
   </div>
   <div class="container">
      <div class="card soft">
         <h2>Welcome to the Store</h2>
      </div>
   </div>

   <div class="container">
      <h2>New Fruit</h2>

      <?php recommendCategory('fruit'); ?>
   </div>

   <div class="container">
      <h2>New Vegetables</h2>

      <?php recommendCategory('vegetable'); ?>
   </div>

</body>
</html>