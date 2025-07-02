<?php
$filename = 'bdTravaux.txt';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'] ?? '';
    $numero = $_POST['numero'] ?? '';
    $famille = $_POST['famille'] ?? '';
    $precision = $_POST['precision'] ?? '';
    $dateselect = $_POST['date'] ?? '';
    $today = date('d-m-Y');

    // Lire le fichier et trouver le dernier ID
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $maxId = 0;

    foreach ($lines as $line) {
        $parts = explode(',', $line);
        if (is_numeric($parts[0])) {
            $maxId = max($maxId, (int)$parts[0]);
        }
    }

    $newId = $maxId + 1;

    // Format: id,date,type,numero,famille,precision,,,dateselect,
    $nouvelleLigne = "$newId,$today,$type,$numero,$famille,$precision,,,{$dateselect},\n";

    // Ajouter à la fin du fichier
    file_put_contents($filename, $nouvelleLigne, FILE_APPEND);

    echo "OK";
}
?>
