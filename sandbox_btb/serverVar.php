<html>
  <head>
    <title>Server Variables</title>
  </head>
  <body>
      <?php
      echo "Server details: " . "<br />";
      echo "SERVER NAME: " . $_SERVER['SERVER_NAME'] . "<br />";
      echo "SERVER ADDR: " . $_SERVER['SERVER_ADDR'] . "<br />";
      echo "SERVER PORT: " . $_SERVER['SERVER_PORT'] . "<br />";
      echo "Doc RooT: " . $_SERVER['DOCUMENT_ROOT'] . "<br />";
      echo "PHP info: " . $_SERVER['PHP_SELF'] . "<br />";
      echo "Script Fname: " . $_SERVER['SCRIPT_FILENAME'] . "<br />";
      
      echo "Req Details" . "<br />";
      echo "REMOTE ADDR: " . $_SERVER['REMOTE_ADDR'] . "<br />";
      echo "REMOTE PORT: " . $_SERVER['REMOTE_PORT'] . "<br />";
      echo "REQ URI: " . $_SERVER['REQUEST_URI'] . "<br />";
      echo "QUERY STRING: " . $_SERVER['QUERY_STRING'] . "<br />";
      echo "REQ METHOD: " . $_SERVER['REQUEST_METHOD'] . "<br />";
      echo "REQ TIME: " . $_SERVER['REQUEST_TIME'] . "<br />";
      echo "http ref: " . $_SERVER['HTTP_REFERER'] . "<br />";
      echo "http user agent: " . $_SERVER['HTTP_USER_AGENT'] . "<br />";
      
      
      ?>
  </body>
</html>
