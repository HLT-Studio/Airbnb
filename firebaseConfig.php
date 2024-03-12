<?php
  require __DIR__.'/vendor/autoload.php';

  use Kreait\Firebase\Factory;
  use Kreait\Firebase\Contract\Auth;

  $factory = (new Factory)
    ->withServiceAccount('airbnb-f0e1a-firebase-adminsdk-inlpg-24081dc1ba.json')
    ->withDatabaseUri('https://airbnb-f0e1a-default-rtdb.firebaseio.com/');

  $database = $factory->createDatabase();
  $auth = $factory->createAuth();
?>
