<?php
// routes/web.php

$router = new AltoRouter();

// Définir les routes
// [Méthode HTTP, URL, Cible, Nom de la route]
$router->map('GET', '/', 'home', 'home');
$router->map('GET', '/contact', 'contact', 'contact');
$router->map('GET', '/database-test', 'db_test', 'db_test');

// Route avec paramètre dynamique (ex: /user/42)
$router->map('GET', '/user/[i:id]', 'user_profile', 'user_profile');

return $router;