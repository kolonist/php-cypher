#!/usr/bin/php
<?php
require_once '../cypher.class.php';

$key   = "Паролька";
$input = "Привет, Васяндр!";

$cypher = new Cypher();
$cypher->key = $key;
$encrypted = $cypher->encrypt($input);
$decrypted = $cypher->decrypt($encrypted);

echo "Src: ", bin2hex($input), "\n";
echo "Key: ", bin2hex($key), "\n";
echo "Enc: ", bin2hex($encrypted), "\n";
echo "Dec: ", bin2hex($decrypted), "\n\n";

echo "Src: ", $input, "\n";
echo "Key: ", $key, "\n";
echo "Enc: ", bin2hex($encrypted), "\n";
echo "Dec: ", $decrypted, "\n";
