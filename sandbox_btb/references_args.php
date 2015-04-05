<html>
  <head>
    <title>References as arguments</title>
  </head>
  <body>
      <?php

      //This works same as global variable
      //These 2 work same way
      //fr global, we need to access $x as a global var
      function reftest1(){
          global $x;
          $x = $x *2;
      }
      
      function reftest2(&$temp){
          $temp = $temp *2;
      }
      
      $x = 10;
      reftest1($x);
      echo $x. "<br />";      
      
      ?>
  </body>
</html>
