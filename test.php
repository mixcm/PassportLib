<?php

require "vendor/autoload.php";

use \Mixcm\PassportLib as ba;

$p = new ba\Password;
$gen = new ba\Generate;

$s = $gen->salt();

$pwd = $p->encrypt('123456', $s);

var_dump( 
    $p->check('123456', $pwd)
);
