# Burger Kebab — Module Gestion des Catégories

## Objectif

Le projet Burger Kebab est une application web développée avec le framework Laravel permettant la gestion d’un menu de restaurant.

Il permet d’administrer les catégories et les produits afin d’organiser efficacement l’offre du restaurant.

Ce projet a pour objectifs de :

- maîtriser le framework Laravel et le modèle MVC ;
- structurer une application web professionnelle ;
- gérer des relations entre entités (Catégories / Produits) ;
- appliquer des règles métier réelles ;
- produire un code propre, maintenable et évolutif ;
- documenter et expliquer les choix techniques.

## Fonctionnalités

Gestion des catégories

- Afficher la liste des catégories
- Créer une catégorie
- Modifier une catégorie
- Activer / désactiver une catégorie
- Supprimer une catégorie
- Recherche et pagination (bonus)

 Gestion des produits

- Afficher la liste des produits
- Créer un produit lié à une catégorie
- Modifier un produit
- Activer / désactiver un produit
- Supprimer un produit
- Filtrer par catégorie (bonus)
- Recherche et pagination (bonus)

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

## Prérequis

- PHP 8.2 ou supérieur
- Composer
- Laravel 12
- MySQL
- Git
- Node.js

## Installation

### 1. Cloner le projet

bash git clone https://github.com/soundous25/burger_kebab.git cd burger_kebab 

### 2. Installer les dépendances

bash composer install 

### 3. Configurer l'environnement

- bash cp .env.example .env 
- php artisan key:generate 

### 4. Configurer la base de données

Modifier les paramètres de connexion dans le fichier .env.

Puis exécuter :

- bash php artisan migrate 
- php artisan db:seed 

### 5. Lancer l'application

bash php artisan serve 

L'application sera accessible à l'adresse :

text http://127.0.0.1:8000 

## Structure du projet

### Modèle
- Category.php :* représente la table des catégories et permet les interactions avec la base de données.
- Product.php : représente la table des produits et gère les relations avec les catégories.

### Contrôleur
- CategoryController.php : gère les opérations CRUD (Créer, Lire, Modifier, Supprimer).
- ProductController.php : gère les opérations CRUD des produits et leur liaison avec les catégories

### Base de données
-  Migration categories : création de la table categories.
- Migration products : création de la table products avec clé étrangère category_id.
- Seeder CategorySeeder : insertion des catégories de test.
- Seeder ProductSeeder : insertion des produits de test.

### Vues
 Catégories

- index.blade.php : affichage de la liste des catégories.
- create.blade.php : formulaire d’ajout d’une catégorie.
- edit.blade.php : formulaire de modification d’une catégorie.

Produits

- index.blade.php : affichage de la liste des produits.
- create.blade.php : formulaire d’ajout d’un produit.
- edit.blade.php : formulaire de modification d’un produit.

### Layout
app.blade.php : template principal de l’application.

### Routes
- web.php : * définition des routes des modules catégories et produits (CRUD + activation/désactivation).

## Choix techniques

- Laravel : framework principal (architecture MVC)
- Blade : moteur de templates simple et intégré
- MySQL : base de données relationnelle
- Eloquent ORM : gestion des relations entre modèles
- Migrations & Seeders : structuration et initialisation de la base de données
- Validation Laravel : sécurisation des formulaires
- Git / GitHub : gestion de version et suivi du projet
