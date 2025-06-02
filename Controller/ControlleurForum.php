<?php
require_once('Model/modelBDD.php');
class ControlleurForum
{
        private $model;
    function __construct()
    {
        $this->model = new ModelBDD();
    }

    function getComm()
    {
        // Récupérer les commentaires triés par ordre décroissant de date de création
        $req = $this->model->execute_query("
    SELECT * 
    FROM commentaires 
    JOIN utilisateur ON commentaires.id_utilisateur = utilisateur.id
    ORDER BY commentaires.date_creation DESC
");

        $_SESSION['commentaires'] = $req->fetchAll(PDO::FETCH_ASSOC);
        $req = $this->model->execute_query("SELECT * FROM reponses , utilisateur Where reponses.id_utilisateur= utilisateur.id ");
        $_SESSION['reponse_utilisateur'] = $req->fetchAll(PDO::FETCH_ASSOC);
    }
    function getDiscussions()
    {
        $req = $this->model->execute_query("SELECT * FROM discussions");
        $_SESSION['discussions'] = $req->fetchAll(PDO::FETCH_ASSOC);
    }

    function AjoutComm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if (isset($_POST['discussion_id'])) {
                
                $discussion_id = intval($_POST['discussion_id']);
                $commentaire = $_POST['comment_box'];
                $id_utilisateur = $_SESSION['id'];
                $sql = "INSERT INTO commentaires (id_utilisateur, discussion_id, texte_commentaire) VALUES ('$id_utilisateur', '$discussion_id', '{$commentaire}')";

                echo "<pre>SQL DEBUG: $sql</pre>";

                $this->model->execute_query($sql);
                $this->getComm();
                return true;
            } else {
                
                return false;
            }
        } else {
            
            return false;
        }
    }

    function RepondreComm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $reponse = $_POST['reponse_box'];
            $id_utilisateur = $_SESSION['id'];
            $comment_id = $_POST['comment_id'];
            $sql = "INSERT INTO reponses (id_commentaire, id_utilisateur, texte_reponse) VALUES ('$comment_id', '$id_utilisateur', '$reponse')";
            echo "<pre>SQL DEBUG: $sql</pre>";

            $this->model->execute_query($sql);
            $req = $this->model->execute_query("SELECT * FROM reponses , utilisateur Where reponses.id_utilisateur= utilisateur.id ");
            $_SESSION['reponse_utilisateur'] = $req->fetchAll(PDO::FETCH_ASSOC);
            return true;
        } else {
            exit();
        }
    }
}
