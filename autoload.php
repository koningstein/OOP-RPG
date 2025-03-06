<?php

spl_autoload_register(function ($className) {
    // Haal alleen de class naam uit de namespace
    $parts = explode('\\', $className);
    $className = end($parts);
    
    require_once $className . '.php';
}); 