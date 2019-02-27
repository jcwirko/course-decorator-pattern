<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use Styde\Image;

require_once __DIR__ . '/../vendor/autoload.php';

$image = new Image(assets_path('img/decorator.jpeg'), 1000, 666, true, 5);
$image->setWidth(1000);
$image->setHeight(666);
$image->setGrayscale(true);
$image->setFramed(5);

header('Content-Type: image/jpeg');
imagejpeg($image->draw());