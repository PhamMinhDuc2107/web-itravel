<?php
session_start();
require_once 'bootstrap.php';
Util::generateCsrfToken();
$app = new App();
