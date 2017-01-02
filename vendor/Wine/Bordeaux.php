<?php
namespace Wine;

class Bordeaux
{
    public function __construct($log = true)
    {
        if ($log) {
            echo "Wine\Bordeaux\n";
        }
    }
}