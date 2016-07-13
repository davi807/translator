<?php
require "ISMA.class.php";
$r = new ISMA("Մի բան գրեք այստեղ");
$r = $r->Analyse();

print_r($r);