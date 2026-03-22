<?php
// serve.php à la racine du projet

$host = "localhost";
$port = 8000;
$root = __DIR__;
// On définit le dossier "public" comme racine du serveur Web
$publicDir = $root . '/public';
$autoload = $root . '/vendor/autoload.php';

echo "------------------------------------------\n";
echo "🚀 SERVEUR PHP (MODE PUBLIC) - IMRANA\n";
echo "🌍 URL    : http://$host:$port\n";
echo "📁 Public : $publicDir\n";
echo "------------------------------------------\n";

// 1. Mise à jour automatique de l'autoloader
shell_exec('composer dump-autoload');

// 2. Lancement magique :
// -t $publicDir : dit au serveur que l'index est dans /public
// -d auto_prepend_file : charge l'autoload SANS l'écrire dans index.php
passthru("php -S $host:$port -t $publicDir -d auto_prepend_file=$autoload");