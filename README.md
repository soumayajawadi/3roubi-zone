# 🌶️ 3roubi Zone

Site e-commerce de produits tunisiens authentiques (huiles, pâtisseries, épices...), développé avec **Laravel**, **Blade** et **Bootstrap 5**.

## Fonctionnalités

### Côté client
- Boutique avec recherche et filtre par catégorie
- Page produit avec avis et notes
- Panier, favoris (wishlist) et promotions
- Commandes avec suivi et facture PDF
- Chat avec l'administrateur
- Profil utilisateur, authentification
- Site bilingue (Français / English) et mode sombre

### Côté administrateur
- Gestion des produits : créer, modifier, archiver / restaurer, supprimer
- Upload d'images produits
- Gestion des commandes (statuts, livraison, annulation)
- Gestion des catégories
- Messagerie avec les clients

## Technologies
- PHP 8.x / Laravel 13
- Blade + Bootstrap 5
- SQLite
- Git / GitHub

## Installation

```bash
git clone https://github.com/soumayajawadi/3roubi-zone.git
cd 3roubi-zone

composer install
npm install

cp .env.example .env
php artisan key:generate

php artisan migrate --seed
php artisan storage:link

php artisan serve
```

Le site est accessible sur : http://127.0.0.1:8000

## Compte administrateur
Pour accéder à l'espace admin, l'utilisateur doit avoir `role = admin` dans la table `users`.

Espace produits admin : `/admin/produits`

## Auteur
Soumaya Jawadi