# 📚 FormaPro_Symfony

Projet open source de site de vente de formations vidéo, développé avec Symfony 7.

L’objectif est de proposer une base fonctionnelle, simple et extensible, pour un site e-commerce de type “formation en ligne”. Ce dépôt me permet aussi de publier du code Symfony de manière ouverte, et d'explorer des approches modulaires sur un projet structuré.

---

## 🎯 Objectifs

- Construire un projet complet en Symfony 7
- Appliquer les bonnes pratiques (routing, services, MVC, sécurité)
- Mettre en place une interface de gestion, un système de catalogue, et un panier
- Préparer un socle réutilisable pour un futur SaaS

---

## 🛠️ Stack technique

## Requirements

- PHP >= 8.2
- Symfony ^7.2
- Composer >= 2.5
- MySQL 8.0
- Twig
- Composer
- Doctrine ORM
- Bootstrap 5 (ou autre framework léger)
- Git / GitHub

---

## 🚀 Installation rapide

```bash
git clone git@github.com:MMajri/FormaPro_Symfony.git
cd FormaPro_Symfony
composer install
symfony serve
```## 🚀 Installation rapide

```bash
git clone git@github.com:MMajri/FormaPro_Symfony.git
cd FormaPro_Symfony

# Installer les dépendances
composer install

# Copier et personnaliser les variables d’environnement
cp .env .env.local
# Modifier .env.local si nécessaire (ex: DATABASE_URL)

# Créer la base de données
php bin/console doctrine:database:create

# Appliquer les migrations
php bin/console doctrine:migrations:migrate

# Lancer le serveur local
symfony server:start

---

## 👤 Auteur

**Mohamed Thelji**  
Développeur PHP / Symfony • Fondateur de Tsuki Dev  
🌐 [tsukidev.fr](https://tsukidev.fr)
