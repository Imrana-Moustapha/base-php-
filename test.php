<?php

// On inclut l'autoloader de Composer (si tu l'utilises)
require_once __DIR__ . '/../vendor/autoload.php';

use Imrana\Test\config\Database;

// 1. Instanciation de la classe (Appel du constructeur)
// Si tu ne passes rien, il prendra les valeurs par défaut ("localhost", "imrana", etc.)
$db = new Database();

// Optionnel : Tu peux modifier un paramètre avant la connexion grâce aux setters
$db->setDbName("biblio");

try {
    // 2. Récupération de l'objet PDO (MySQL)
    $pdo = $db->getConnectionMySql();

    // 3. Test d'une requête simple
    $query = $pdo->query("SELECT COUNT(*) as total FROM ouvrages");
    $result = $query->fetch();

    echo "Connexion réussie ! Nombre d'ouvrages : " . $result['total'];

} catch (Exception $e) {
    echo "Erreur lors du test : " . $e->getMessage();
}

// 4. Exemple si tu as une DEUXIÈME base de données différente
$dbDistante = new Database("192.168.1.50", "admin", "secret123", "archive_db");
$pdoDistant = $dbDistante->getConnectionPsql(); // Connexion PostgreSQL sur un autre serveur