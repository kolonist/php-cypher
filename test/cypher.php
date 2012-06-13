#!/usr/bin/php
<?php
require_once '../cypher.class.php';

//no CL arguments
if (sizeof($argv) < 3) {
    echo <<<'TXT'
Use Twofish cypher in CBC mode to encrypt data.

Usage:
    cypher.php -e|-d key [ /path/to/inputfile /path/to/outputfile ]

Examples
    1. Encrypt file
    $ cypher.php -e key /path/to/inputfile /path/to/encryptedfile

    2. Decrypt file
    $ cypher.php -d key /path/to/inputfile /path/to/decryptedfile

    3. Encrypt inputstream to output stream
    $ echo "Hello World" | cypher.php -e key

    4. Decrypt inputstream to output stream
    $ echo "Owblm3fwEmUw3lflocDB9EsNX9lznmIzRro0iJWGC0I=" | base64 -d | cypher.php -d key


TXT;

//encrypt inputstream
} else if (sizeof($argv) == 3) {
    //read from STDIN
    $data = '';
    while (!feof(STDIN)) {
        $data .= fread(STDIN, 1024);
    }

    //encrypt string
    $cypher = new Cypher();
    $cypher->key = $argv[2];

    //encrypt
    if ($argv[1] === '-e') {
        $encrypted = $cypher->encrypt($data);

        //write base64 stream
        echo chunk_split(base64_encode($encrypted), 76, "\n"), "\n";

    //decrypt
    } else if ($argv[1] === '-d') {
        $decrypted = $cypher->decrypt($data);
        echo $decrypted, "\n";
    }

//encrypt or decrypt file
} else if (sizeof($argv) == 5) {
    $cypher = new Cypher();
    $cypher->key = $argv[2];

    //encrypt
    if ($argv[1] === '-e') {
        $cypher->encryptFile($argv[3], $argv[4]);

    //decrypt
    } else if ($argv[1] === '-d') {
        $cypher->decryptFile($argv[3], $argv[4]);
    }
}
