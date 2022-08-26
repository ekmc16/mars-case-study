<?php

$pdo = new PDO('mysql:host=us-cdbr-east-06.cleardb.net;port=3306;dbname=heroku_66aa9a40c1910f5','b959a8e2c39313', 'a9259e0c');

// $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=misc','postgres', 'new-password');

// See the "errors"
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

