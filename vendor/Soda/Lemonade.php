<?php
namespace Soda;

class Lemonade
{
    public function __construct($log = true)
    {
        if ($log) {
            echo "Soda\Lemonade\n";
        }
    }
}