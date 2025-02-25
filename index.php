<?php
   session_start();
   require_once 'bootstrap.php';
   //   created token csrf
   Util::generateCsrfToken();
   $app = new App();
