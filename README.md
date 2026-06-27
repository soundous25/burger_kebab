# Burger Kebab

## Objectif

Le projet Burger Kebab est une application web développée avec le framework Laravel.

Il permet d'administrer dynamiquement le contenu d'un menu de restaurant : catégories, produits, images, options de personnalisation (ex. choix de sauce, choix de cuisson) et suppléments tarifaires (ex. bacon, fromage supplémentaire), en respectant les bonnes pratiques Laravel (architecture MVC, migrations, validations, relations Eloquent).

Ce projet a pour objectifs de :

- maîtriser le framework Laravel et le modèle MVC ;
- structurer une application web professionnelle ;
- gérer des relations entre entités ;
- appliquer des règles métier réelles ;
- produire un code propre, maintenable et évolutif ;
- documenter et expliquer les choix techniques.

## Fonctionnalités

Authentification

- Création d'une interface de connexion moderne.
- Création d'une interface d'inscription moderne.
- Mise en place de l'authentification des administrateurs.
- Ajout de la déconnexion sécurisée.

Tableau de bord

- Ajout d'un tableau de bord d'administration moderne.
- Affichage des statistiques des catégories, produits, options et suppléments.
- Ajout d'une section **Dernières modifications** affichant automatiquement les éléments récemment créés ou modifiés.
- Ajout de raccourcis vers les principales fonctionnalités.

Gestion des catégories

- Lister, créer, modifier, activer/désactiver et supprimer une catégorie
- Validation de l'unicité du nom
- Recherche et pagination 

 Gestion des produits

- Lister (avec recherche, filtre par catégorie et pagination), créer, modifier, voir, activer/désactiver et supprimer un produit
- Upload, remplacement et suppression d'image produit (formats acceptés : JPG, JPEG, PNG, WEBP)
- Affichage d'une image par défaut en l'absence d'image
- Rattachement obligatoire à une catégorie existante

  Gestion des options

- Créer, modifier, activer/désactiver et supprimer une option
- Définir si une option est obligatoire ou facultative
- Définir un nombre minimum et maximum de sélections
- Association d'une option à plusieurs produits (relation Many-To-Many)  

  Gestion des Valeurs d'options

- Ajouter, modifier, activer/désactiver et supprimer une valeur d'option
- Chaque valeur appartient à une option existante
- Association d'une valeur d'option à un ou plusieurs suppléments (relation Many-To-Many)

   Gestion des Suppléments

- Créer, modifier, activer/désactiver et supprimer un supplément
- Définir un prix (un supplément peut être gratuit)
- Réutilisable sur plusieurs valeurs d'options   

## Règles métier

 Catégories

- Le nom est obligatoire
- Deux catégories ne peuvent pas avoir le même nom
- Une catégorie inactive n’est pas visible dans le menu client
- L’ordre d’affichage organise le menu
- Une catégorie peut être supprimée uniquement si cela ne casse pas l’intégrité des données

  Produits

- Le nom est obligatoire
- Le prix est obligatoire et doit être > 0
- Le prix est exprimé en CHF avec 2 décimales
- Un produit doit appartenir à une catégorie existante
- Un produit inactif n’est pas visible dans le menu client
- Un produit ne peut pas être créé sans catégorie
- Les doublons dans une même catégorie doivent être justifiés ou empêchés

- Suppression bloquée pour toute option ou supplément déjà utilisé, afin de préserver l'intégrité des données (l'administrateur doit désactiver plutôt que supprimer)
- Validation stricte des données (prix > 0, nom obligatoire, formats d'image autorisés, cohérence min/max des sélections)


## Prérequis

- PHP 8.2 ou supérieur
- Composer
- Laravel 12
- MySQL
- Git
- Node.js
- Un environnement local type XAMPP

## Installation

### 1. Cloner le projet

bash git clone https://github.com/soundous25/burger_kebab.git cd burger_kebab 

### 2. Installer les dépendances

bash composer install 

### 3. Configurer l'environnement

- bash cp .env.example .env 
- php artisan key:generate 

### 4. Configurer la base de données

Modifier les paramètres de connexion dans le fichier .env :

- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=burger_kebab
- DB_USERNAME=root
- DB_PASSWORD=

Puis exécuter :

- bash php artisan migrate 
- php artisan storage:link
- php artisan db:seed 

### 5. Lancer l'application

bash php artisan serve 

L'application sera accessible à l'adresse :

 http://127.0.0.1:8000 

 http://localhost:8000

## Structure du projet

app/
 ├── Models/
 │    ├── Category.php
 │    ├── Product.php
 │    ├── Option.php
 │    ├── OptionValue.php
 │    ├── Supplement.php
 │    └── User.php
 └── Http/Controllers/
      ├── AuthController.php
      ├── DashboardController.php
      ├── CategoryController.php
      ├── ProductController.php
      ├── OptionController.php
      ├── OptionValueController.php
      └── SupplementController.php

database/
 ├── migrations/      → création des tables et des tables pivot
 └── seeders/
      ├── CategorySeeder.php
      ├── ProductSeeder.php
      ├── DemoOptionsSeeder.php
      └── DatabaseSeeder.php

resources/views/
 ├── auth/             → login, register
 ├── layouts/
 ├── categories/
 ├── Products/
 ├── options/
 ├── option_values/
 └── supplements/

routes/
 └── web.php

## Choix techniques

- Laravel : Architecture MVC claire, ORM Eloquent,       migrations versionnées, validation intégrée
- Blade : Moteur de templates natif Laravel, intégration  simple avec les contrôleurs
- Bootstrap :Mise en place rapide d'une interface d'administration claire et responsive
- MySQL : base de données relationnelle adapté à la gestion de relations One-To-Many et Many-To-Many
- Eloquent ORM : gestion des relations entre modèles
- Migrations & Seeders : structuration et initialisation de la base de données
- Validation Laravel : sécurisation des formulaires
- Git / GitHub : gestion de version et suivi du projet
- Disque public Laravel : Permet un accès direct aux fichiers via storage:link, sans configuration supplémentaire
- belongsToMany(), sync() : Permet de gérer proprement les relations Many-To-Many via les tables pivot
- Laravel natif (sessions) : Protection des routes d'administration via le middleware auth

## Relations mises en place

### Relations One-To-Many
- Une Catégorie possède plusieurs Produits (Category hasMany Product)
- Une Option possède plusieurs Valeurs d'options (Option hasMany OptionValue)

### Relations Many-To-Many (avec tables pivot)
- Un Produit peut avoir plusieurs Options, et une Option peut être utilisée par plusieurs Produits
→ table pivot option_product (product_id, option_id)
- Une Valeur d'option peut avoir plusieurs Suppléments, et un Supplément peut être associé à plusieurs Valeurs d'options
→ table pivot option_value_supplement (option_value_id, supplement_id)

Category
   │ (1-N)
   ▼
Products ◄──── (N-N) ────► Options
                              │ (1-N)
                              ▼
                        OptionValues ◄──── (N-N) ────► Supplements