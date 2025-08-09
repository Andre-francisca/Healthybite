# Healthybite
HealthyBiteGH est une plateforme web qui aide les utilisateurs à trouver rapidement des repas adaptés à leurs besoins de santé, comme le diabète, l’ulcère ou l’hypertension. Elle regroupe plusieurs restaurants, permet de consulter leurs menus et utilise Google Maps pour localiser facilement les établissements. 
HealthyBite
HealthyBite est une application web multi-vendeur de restauration qui recommande des plats adaptés aux besoins spécifiques de santé (diabète, ulcère, hypertension, etc.).

Prérequis
XAMPP installé (Apache + MySQL)

PHP (inclus avec XAMPP)

Navigateur web

Installation et lancement
Cloner ou copier le projet

Place le dossier du projet HealthyBite dans le dossier htdocs de XAMPP, par exemple :
C:\xampp\htdocs\HealthyBite

Démarrer les services XAMPP

Ouvre le panneau de contrôle XAMPP et démarre :

Apache

MySQL

Configurer la base de données

Ouvre phpMyAdmin en allant sur http://localhost/phpmyadmin

Crée une base de données nommée (exemple) healthybite_db

Importe le fichier SQL fourni (ex : database.sql) si tu en as un pour créer les tables et les données

Configurer la connexion à la base de données

Ouvre le fichier de configuration PHP (ex : config.php ou équivalent)

Vérifie que les paramètres de connexion MySQL correspondent à ta configuration :

php
Copy
Edit
$host = 'localhost';
$dbname = 'healthybite_db';
$username = 'root';
$password = ''; // par défaut sous XAMPP, le mot de passe root est vide
Accéder à l’application

Ouvre un navigateur et rends-toi à l’adresse :
http://localhost/HealthyBite
