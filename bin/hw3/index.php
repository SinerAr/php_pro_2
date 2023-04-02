<?php

use Sinerar\PhpPro\shorturl\DB;
use Sinerar\PhpPro\shorturl\ShortCode;
use Sinerar\PhpPro\shorturl\Url;

include_once __DIR__.'/../../src/autoload.php';

$yakaboo_ua = new Url('https://www.yakaboo.ua');
$yakaboo_code = new ShortCode($yakaboo_ua);
$yakaboo_code->saveToFile('my_short_codes.db');


$google_com_ua = new Url('https://www.google.com.ua');
$google_code = new ShortCode($google_com_ua);
$google_code->saveToFile('my_short_codes.db');

$dbConnect = new DB('my_short_codes.db');
echo $dbConnect->decode('2dfc0b68a8');

