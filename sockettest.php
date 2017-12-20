<?php

    $host = "122.176.55.17";
    $port = 25;
    $tval = 15;

    $smtp_conn = fsockopen($host, $port, $errno, $errstr, $tval);

    if (empty($smtp_conn))
    {
      print("Error connecting: ". $errno .": ". $errstr);
    } else {
      print("Connect seems good!\n");
      print_r($smtp_conn);
      fclose($smtp_conn);
    }



?>
