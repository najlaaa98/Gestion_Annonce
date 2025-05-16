Gestion Annonce
Une application complète de gestion d'annonces développée avec Laravel permettant de publier et gérer des annonces d'achat, de location, d'emploi et plus encore.
À propos de l'application
Gestion Annonce est une plateforme polyvalente qui permet aux utilisateurs de:

Publier des annonces de vente/achat de biens
Proposer des locations immobilières
Diffuser des offres d'emploi
Rechercher parmi les annonces avec filtres avancés
Communiquer entre acheteurs et vendeurs

Prérequis

PHP >= 8.1
Composer
MySQL ou MariaDB
Node.js et NPM
Git

Installation
Suivez ces étapes pour installer et configurer l'application Gestion Annonce.
1. Cloner le dépôt
bashgit clone https://github.com/najlaaa98/Gestion_Annonce.git
cd Gestion_Annonce
2. Installer les dépendances PHP
bashcomposer install
3. Installer les dépendances JavaScript
bashnpm install
4. Configurer l'environnement
Copiez le fichier .env.example en .env et configurez les variables d'environnement:
bashcp .env.example .env
Modifiez le fichier .env en renseignant les informations de votre base de données:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_annonce
DB_USERNAME=root
DB_PASSWORD=
5. Générer la clé d'application
bashphp artisan key:generate
6. Créer la base de données
Créez une base de données vide dans MySQL/MariaDB avec le nom spécifié dans votre fichier .env (par défaut gestion_annonce).
7. Exécuter les migrations et les seeders
bashphp artisan migrate --seed
Lancement de l'application
Démarrer le serveur de développement
bashphp artisan serve
L'application sera accessible à l'adresse http://localhost:8000.
Compiler les assets
En mode développement:
bashnpm run dev
Pour la production:
bashnpm run build
Fonctionnalités principales
Gestion des annonces

Annonces d'achat/vente: Publiez vos biens à vendre avec photos et descriptions détaillées
Annonces de location: Proposez des locations immobilières avec tarifs et disponibilités
Offres d'emploi: Publiez et consultez des offres d'emploi par secteur d'activité
Autres services: Proposez divers services aux utilisateurs de la plateforme

Fonctionnalités utilisateurs

Inscription et authentification sécurisée
Tableau de bord personnalisé
Gestion du profil utilisateur
Système de messagerie intégré
Favoris et historique de recherche
Notifications en temps réel

Recherche avancée

Filtres par catégorie, prix, localisation
Tri par pertinence, date ou prix
Recherche géolocalisée
Alertes et sauvegardes de recherche

Structure de l'application
Contrôleurs principaux

AnnonceController.php: Gestion des annonces
UserController.php: Gestion des utilisateurs
MessageController.php: Système de messagerie
CategorieController.php: Gestion des catégories d'annonces

Modèles

Annonce.php: Modèle pour les annonces
User.php: Modèle utilisateur étendu
Categorie.php: Catégories d'annonces
Message.php: Système de messagerie

Vues
Les vues de l'application sont situées dans le répertoire resources/views/ et sont organisées comme suit:

layouts/ - Contient les layouts principaux
annonces/ - Vues des annonces par catégorie
auth/ - Authentification
users/ - Profils et tableaux de bord
admin/ - Interface d'administration

Commandes utiles
Vider le cache
bashphp artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
Actualiser la base de données
bashphp artisan migrate:fresh --seed
Lancer les tests
bashphp artisan test
Déploiement en production

Configurez votre fichier .env pour la production:
APP_ENV=production
APP_DEBUG=false
APP_URL=https://votre-domaine.com

Optimisez l'application:
bashphp artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

Compilez les assets:
bashnpm run build



Contribution
Les contributions sont les bienvenues! N'hésitez pas à soumettre une Pull Request.
Licence
Ce projet est sous licence MIT.