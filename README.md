# README - Projet LearnEnglish.com

## Informations sur la base de données (Backend)

Le projet utilise une base de données MySQL pour stocker toutes les informations relatives aux utilisateurs, cours, vidéos, certificats, quizs et progression.

Voici les informations d'accès à la base de données :

- **Hôte** : `localhost`
- **Nom d'utilisateur** : `root`
- **Mot de passe** : *(aucun, champ vide)*
- **Nom de la base de données** : `projet`

### Détails supplémentaires
- Le projet utilise **XAMPP** comme serveur local.
- Aucun mot de passe n'est requis pour l'accès MySQL sur l'environnement de développement.
- Les constantes de connexion à la base de données sont définies dans le fichier `Config/configBDD.php` :

```php
<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'projet');
?>
```


## Technologies utilisées
- PHP 8
- MySQL
- HTML5 / CSS3
- JavaScript
- XAMPP (Apache + MySQL)


- **Nom et prénoms des participants** : Oukach Hamza, Ait Jaakike Zakaria, El Aidoudi Youssef

