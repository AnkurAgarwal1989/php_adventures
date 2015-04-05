<html>
  <head>
    <title>Array Function</title>
  </head>
  <body>
      <?php
      
      $numbers = array('ee',2,3,4,5,6);
      print_r($numbers);
      echo "<br />";
      
      echo "<hr />";
      
      $a = array_shift($numbers);
      echo $a . "<br />";
      print_r($numbers);
      echo "<br />";
      
      echo "<hr />";
      
      $b = array_unshift($numbers, 'first');
      echo $b . "<br />";
      print_r($numbers);
      echo "<br />";
      
      echo "<hr />";
      
      $c = array_push($numbers, 'last');
      echo $c . "<br />";
      print_r($numbers);
      echo "<br />";
      
      echo "<hr />";
      
      $d = array_pop($numbers);
      echo $d . "<br />";
      print_r($numbers);
      echo "<br />";
      
      ?>
  </body>
</html>
