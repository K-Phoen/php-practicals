<?php
namespace Coffee;

class Sumatra
{
    public function __construct($log = true)
    {
        if ($log) {
            echo "Coffee\Sumatra\n";
        }
    }
}