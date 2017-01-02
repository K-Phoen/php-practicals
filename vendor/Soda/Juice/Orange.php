<?php
namespace Soda\Juice;

class Orange
{
    public function __construct($log = true)
    {
        if ($log) {
            echo "Soda\Juice\Orange\n";
        }
    }
}