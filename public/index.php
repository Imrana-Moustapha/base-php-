<?php
// public/index.php

// L'autoloader est géré par serve.php (auto_prepend_file)
// On récupère l'instance du router
$router = require_once __DIR__ . '/../routes/web.php';

// On vérifie si l'URL correspond à une route
$match = $router->match();

if ($match) {
    // On extrait les paramètres pour qu'ils soient utilisables dans la vue
    $params = $match['params']; 
    
    // On cherche le fichier dans le dossier views/
    $viewFile = __DIR__ . '/../views/' . $match['target'] . '.php';

    if (file_exists($viewFile)) {
        require_once $viewFile;
    } else {
        echo "Erreur : Le fichier de vue " . $match['target'] . " est introuvable.";
    }
} else {
    // Aucune route ne correspond
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo "404 - Page non trouvée par AltoRouter";
}