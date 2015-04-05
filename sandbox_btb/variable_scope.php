<html>
  <head>
    <title>Variable Scope</title>
  </head>
  <body>
      <?php
      
      //global scope
      $var = 1;
      echo $var."<br />";
      function test1(){
          //local scope
          $var = 2;
          echo $var."<br />";
      }
      test1();
      
      function test2(){
          //use the global var
          global $var;
          //local scope
          $var = 2;
          echo $var."<br />";
      }
      
      test2();
      echo $var."<br />";
      
      ?>
  </body>
</html>
