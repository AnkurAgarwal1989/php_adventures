<html>
  <head>
    <title>Date and Time</title>
  </head>
  <body>
      <?php
      include './mySQL_datetime.php';
      echo time();
      echo "<br />";
      echo mktime(2, 30, 45, 10, 13, 1989);
      echo "<br />";
      echo checkdate(10, 138, 1989) ? 'true':'false';
      echo "<br />";
      echo strtotime('3 september 2009 00:00:12');
      echo "<br />";
      echo strtotime('3 september 2009 ');
      echo "<br />";
      echo "<hr />";
      echo "<p>Formatting timestamps</p>";
      echo strftime("%m/%d/%y");
      echo "<br />";
      echo strftime("%d");
      echo getmySQL_datatime(time());
      
      ?>
  </body>
</html>

