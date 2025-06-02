<?php
$titre = 'LearnEnglish.com';
$CSS = 'Style/Acceuil1.css'; 
$lienQcm = 'View/Qcm.php';
$lienCntct = 'View/Contact.php';
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="64x64" href="../Media/file (3).png">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?php echo $CSS; ?>">


    <title><?php echo $titre; ?></title>
</head>

<body>

    <nav>
        <div class="left">
            <div class="logo">
                <img src="Media/file (3).png">
            </div>
            <div class="links">
                <a href="#">Accueil</a>
                <a href="#cours">Cours</a>
                <a href="#podcasts" class="hide-on">Podcasts</a>
                <a href="#quiz" class="hide-on">Quiz</a>
                <a id="qcm" class='Home hide-on' href="<?php echo $lienQcm ?>" hidden>Qcm</a>
                <a href="#propos" class="hide-on">À propos de nous</a>
            </div>
        </div>

        <div class="buttons">
            <button id="cnx" class="hire-btn" onclick="connexion()">Se connecter</button>
            <button id="dcnx" class="hire-btn" onclick="deconnexion()" hidden>Se deconnecter</button>
            <?php
            if (isset($_SESSION['nom'])) {
                echo "<script>";
                echo "let cnx = document.getElementById('cnx');";
                echo "cnx.style.display = 'none';";
                echo "let dcnx = document.getElementById('dcnx');";
                echo "dcnx.style.display = 'block';";
                echo "dcnx.addEventListener('click', () => {
                document.location.href = 'index.php?action=deconnexion';
            });";
                echo "</script>";
            }
            ?>
        </div>

    </nav>

    <header>
        <div class="info">
            
            <h1>LearnEnglish.com</h1>
            <p>N'ayez plus peur de parler anglais!</p>
        </div>
        <div class="buttons">
            <button class="see-all" onclick="connexion()">Voir les cours</button>
        </div>
    </header>

    <div class="content">
        <section id="cours">
            <div class="separator">
                <h2>Cours populaires</h2>
                <a href="#" onclick="connexion()">Voir tous <i class='bx bx-chevron-right'></i></a>
            </div>
            <div class="courses">
                <div class="item">
                    <div class="top">
                        <img src="Media/cours1.png">
                        <div class="info">
                            <a href="#">Les bases de l’anglais pour débutants</a>
                            <p>Apprendre l’alphabet, les salutations, les phrases simples.</p>
                            <p>Durée : +3 heures</p>
                            <p>Support à vie</p>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="price">
                            <h5>Prix : 20 €</h5>
                            <p>Ancien prix : 40 €</p>
                        </div>
                        <h5 class="tag"><span>+600</span> Étudiants</h5>
                    </div>
                </div>
                <div class="item">
                    <div class="top">
                        <img src="Media/cours2.png">
                        <div class="info">
                            <a href="#">Anglais de la vie quotidienne</a>
                            <p>Dialogues courants, situations pratiques</p>
                            <p>Durée : +3 heures</p>
                            <p>Support à vie</p>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="price">
                            <h5>Prix : 25 €</h5>
                            <p>Ancien prix : 50 €</p>
                        </div>
                        <div class="discount">
                            <div class="time">
                                <p>Jusqu'à</p>
                                <h5>3 jours</h5>
                            </div>
                            <h5><span>20%</span>Remise</h5>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="top">
                        <img src="Media/cours3.png">
                        <div class="info">
                            <a href="#">Grammaire anglaise essentielle</a>
                            <p>Temps verbaux, structure des phrases, prépositions</p>
                            <p>Durée : +3 heures</p>
                            <p>Support à vie</p>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="price">
                            <h5>Prix : 25 €</h5>
                            <p>Ancien prix : 50 €</p>
                        </div>
                        <h5 class="tag"><span>+400</span> Étudiants</h5>
                    </div>
                </div>
                <div class="item">
                    <div class="top">
                        <img src="Media/cours4.png">
                        <div class="info">
                            <a href="#">Développement du vocabulaire</a>
                            <p>Thèmes variés : voyage, famille, travail, émotions...</p>
                            <p>Durée : +4h</p>
                            <p>Support à vie</p>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="price">
                            <h5>Prix : 30 €</h5>
                            <p>Ancien prix : 60 €</p>
                        </div>
                        <div class="discount">
                            <div class="time">
                                <p>Jusqu'à</p>
                                <h5>3 jours</h5>
                            </div>
                            <h5><span>30%</span> Remise</h5>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="top">
                        <img src="Media/cours5.png">
                        <div class="info">
                            <a href="#">Prononciation et accent en anglais</a>
                            <p>Améliorer la clarté orale et la compréhension phonétique</p>
                            <p>Durée : +5h</p>
                            <p>Support à vie</p>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="price">
                            <h5>Prix : 30 €</h5>
                            <p>Ancien prix : 60 €</p>
                        </div>
                        <h5 class="tag"><span>+1000</span> Étudiants</h5>
                    </div>
                </div>

                <div class="item">
                    <div class="top">
                        <img src="Media/cours6.png">
                        <div class="info">
                            <a href="#">Anglais professionnel et des affaires</a>
                            <p>Rédaction d’e-mails, entretiens, réunions, vocabulaire pro</p>
                            <p>Durée : +6h</p>
                            <p>Support à vie</p>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="price">
                            <h5>Prix : 40 €</h5>
                            <p>Ancien prix : 70 €</p>
                        </div>
                        <div class="discount">
                            <div class="time">
                                <p>Jusqu'à</p>
                                <h5>3 jours</h5>
                            </div>
                            <h5><span>30%</span> Remise</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="separator">
            <h2>Commentaires des étudiants</h2>
        </div>

        <div class="comments">
            <p>Avis d'anciens étudiants. Vous pouvez également nous contacter pour plus d'informations !</p>
            <div class="right">
                <div class="item">
                    <img src="Media/profil1.jpg">
                    <p>Cours bien structuré et organisé.</p>
                </div>
                <div class="item">
                    <img src="Media/profil2.jpg">
                    <p>Ces cours m'ont beaucoup aidé !</p>
                </div>
                <div class="item">
                    <img src="Media/emma.jpg">
                    <p>C'était exactement ce dont j'avais besoin.</p>
                </div>
                <div class="item">
                    <img src="Media/chloe.jpg">
                    <p>Excellent !</p>
                </div>
                <div class="item">
                    <img src="Media/profil3.jpg">
                    <p> Meilleur site pour apprendre l'anglais à mon avis.</p>

                </div>
                <div class="item">
                    <img src="Media/profil4.jpg">
                    <p>Très bien</p>
                </div>
            </div>
        </div>
        <section id="podcasts">
            <div class="separator">
                <h2>Podcasts</h2>
            </div>

            <div class="podcasts">
                <div class="item">
                    <div class="top">
                        <i class='bx bx-headphone'></i>
                        <div class="info">
                            <a href="#">La meilleur façon pour apprendre l'anglais</a>
                            <p>13 Février 2025</p>
                            <p>Écouté plus de 100 fois</p>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="duration">
                            <audio controls class="audio">
                                <source src="Media/Podcast1.m4a" type="audio/mp3">
                                Votre navigateur ne supporte pas l'élément <code>audio</code>.
                            </audio>
                        </div>
                        <h5 class="tag"><span>+300</span> Auditeurs</h5>
                    </div>

                </div>
                <div class="item">
                    <div class="top">
                        <i class='bx bx-headphone'></i>
                        <div class="info">
                            <a href="#">Comment apprendre l'anglais seul</a>
                            <p>5 Janvier 2025</p>
                            <p>Écouté plus de 500 fois</p>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="duration">
                            <audio controls class="audio">
                                <source src="Media/Podcast2.m4a" type="audio/mp3">
                                Votre navigateur ne supporte pas l'élément <code>audio</code>.
                            </audio>
                        </div>
                        <h5 class="tag"><span>+510</span> Auditeurs</h5>
                    </div>
                </div>
                <div class="item">
                    <div class="top">
                        <i class='bx bx-headphone'></i>
                        <div class="info">
                            <a href="#">La seule facon pour devenir fluent en anglais</a>
                            <p>17 Avril 2025</p>
                            <p>Écouté 100 fois</p>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="duration">
                            <audio controls class="audio">
                                <source src="Media/Podcast3.m4a" type="audio/mp3">
                                Votre navigateur ne supporte pas l'élément <code>audio</code>.
                            </audio>
                        </div>
                        <h5 class="tag"><span>+210</span> Auditeurs</h5>
                    </div>
                </div>
            </div>
        </section>
        <section id="quiz">
            <div class="separator">
                <h2>Quiz</h2>
                <a href="#" onclick="connexion()">Voir tous <i class='bx bx-chevron-right'></i></a>
            </div>

            <div class="articles">
                <div class="item">
                    <div class="top">
                        <img src="Media/quiz1.jpg">
                        <h5>Comment dit-on "Bonjour" en anglais ?</h5>
                    </div>
                    <div class="bottom">
                        <h5><span>+420</span> Vues</h5>
                        <a href="#" onclick="connexion()">Répondre au quiz<i class='bx bx-chevron-right'></i></a>
                    </div>
                </div>
                <div class="item">
                    <div class="top">
                        <img src="Media/quiz2.png">
                        <h5>Comment demande-t-on « Comment ça va ? » en anglais ?</h5>
                    </div>
                    <div class="bottom">
                        <h5><span>+520</span> Vues</h5>
                        <a href="#" onclick="connexion()">Répondre au quiz<i class='bx bx-chevron-right'></i></a>
                    </div>
                </div>
                <div class="item">
                    <div class="top">
                        <img src="Media/quiz3.png">
                        <h5>Quel est le pronom sujet dans la phrase « She is happy » ?</h5>
                    </div>
                    <div class="bottom">
                        <h5><span>+720</span> Vues</h5>
                        <a href="#" onclick="connexion()">Répondre au quiz<i class='bx bx-chevron-right'></i></a>
                    </div>
                </div>
                <div class="item">
                    <div class="top">
                        <img src="Media/quiz4.jpg">
                        <h5>Quel est le mot anglais pour « pomme » ?</h5>
                    </div>
                    <div class="bottom">
                        <h5><span>+820</span> Vues</h5>
                        <a href="#" onclick="connexion()">Répondre au quiz<i class='bx bx-chevron-right'></i></a>
                    </div>
                </div>
            </div>
        </section>
        <section id="propos">
            <footer>
                <div class="columns">
                    <div class="col last">
                        <h5>À propos de nous</h5>
                        <p>Nous sommes une équipe passionnée de spé cialistes de l'éducation en ligne, prête à vous offrir les meilleures ressources pour améliorer vos compétences.</p>
                        <div class="social-links">
                            <i class='bx bxl-instagram'></i>
                            <i class='bx bxl-dribbble'></i>
                            <i class='bx bxl-linkedin'></i>
                            <i class='bx bxl-twitter'></i>
                        </div>
                    </div>
                </div>
                <div class="copyright">
                    <p>Droits d'auteur © 2025 LearnEnglish.com, Tous droits réservés.</p>
                </div>
            </footer>
        </section>

        <script src="Assets/js/Acceuil.js"></script>


</body>

</html>
<?php
$contenu = ob_get_clean();
print $contenu;
?>