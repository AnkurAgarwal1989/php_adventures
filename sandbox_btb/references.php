<html>
  <head>
    <title>References</title>
  </head>
  <body>
      <?php
      
      $a = 1;
      $b = $a;
      $b = 2;
      
      echo "a: " . $a;
      echo "<br />";
      echo "b: " . $b;
      
      echo "<hr />";
      
      //b is now a reference to a
      $b =& $a;
      $b = 2;
      echo "a: " . $a;
      echo "<br />";
      echo "b: " . $b;
      
      //remove reference
      unset($b);
      
      ?>
  </body>
</html>
