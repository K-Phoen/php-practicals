<?php

include __DIR__ . '/vendor/autoload.php';
$log = true;

new Coffee\Bali($log);
new Coffee\BlueMontain($log);
new Coffee\Sumatra($log);
new Soda\Lemonade($log);
new Soda\Juice\Orange($log);
new Soda_Juice_Pineapple($log);
new Wine\Bordeaux($log);
new Wine\Chinon($log);
