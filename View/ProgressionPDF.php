<?php
session_start();
require_once('../Controller/ControlleurCours.php');

$id_utilisateur = $_SESSION['id'] ?? null;
$id_pdf = $_GET['id_pdf'] ?? null;
$id_cours = $_GET['id_cours'] ?? null;

if ($id_utilisateur && $id_pdf && $id_cours) {
    $controller = new ControlleurCours();
    $controller->enregistrerProgression($id_utilisateur, $id_cours, null, $id_pdf);
    
    $pdf = $controller->getPdf($id_pdf);

    if ($pdf && isset($pdf['path'])) {
        $path = "../" . $pdf['path'];
        header("Location: $path");
        exit;
    }
}

echo "PDF introuvable ou erreur de session.";
exit;
