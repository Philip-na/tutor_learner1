<?php

$objurl = new Router($dbc);

$x = $objurl->findAll();

$urls = [];

foreach($x as $y){
    $urls[] = $y->pretty_url;
}