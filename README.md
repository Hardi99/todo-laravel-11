# Todo App - Laravel 11

Application de gestion de tâches simple et moderne développée avec Laravel 11, SQLite et Bootstrap 5.

## Caractéristiques

- ✅ Ajouter une tâche (titre + description)
- ✅ Lister toutes les tâches
- ✅ Marquer une tâche comme terminée
- ✅ Supprimer une tâche
- ✅ Interface moderne avec Bootstrap 5
- ✅ Base de données SQLite

## Installation

\`\`\`bash
# Cloner le projet
git clone <url-du-repo>
cd todo-app

# Installer les dépendances
composer install

# Copier le fichier .env (déjà configuré pour SQLite)
cp .env.example .env

# Générer la clé d'application
php artisan key:generate

# Créer la base de données et exécuter les migrations
touch database/database.sqlite
php artisan migrate

# Lancer le serveur
php artisan serve
\`\`\`

Accédez à l'application sur \`http://localhost:8000\`

## Stack technique

- **Framework**: Laravel 11
- **Base de données**: SQLite
- **Frontend**: Blade + Bootstrap 5
- **PHP**: 8.2+

## Statuts des tâches

- 🔘 À faire (par défaut)
- 🟡 En cours
- ✅ Terminée
