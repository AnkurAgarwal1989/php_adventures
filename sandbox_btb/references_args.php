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
      
      echo "<hr>";
      echo "  Return values as Reference   <br/>";
      
      function &ref_return() {
          global $a;
          $a = $a * 2;
          return $a;   
      }
      
      $a = 10;
      echo "a: {$a} <br/>";
      $b =& ref_return();
      $b = 10;
      //ref_return() = 20;
      
      echo "a: {$a} <br/>";
      
      ?>
  </body>
</html>
