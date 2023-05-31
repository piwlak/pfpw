<?php
require '../vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorHTML;
include_once(__DIR__.'/controllers/alumno.php');

$generator = new Picqer\Barcode\BarcodeGeneratorHTML();

$data = $alumno->get();


echo $generator->getBarcode(json_encode($data), $generator::TYPE_CODE_128);
