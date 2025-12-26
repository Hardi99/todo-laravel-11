# 📝 Todo App - Laravel 11

![Laravel](https://img.shields.io/badge/Laravel-11.47.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.8-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-3-003B57?style=for-the-badge&logo=sqlite&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-6.0-646CFF?style=for-the-badge&logo=vite&logoColor=white)

Application de gestion de tâches minimaliste développée avec Laravel 11 pour un test technique d'alternant. Met l'accent sur un code fonctionnel, moderne et concis, sans sur-ingénierie.

---

## 🎯 Objectif du test technique

Ce projet démontre :
- Code **fonctionnel et moderne** avec les dernières versions de Laravel et PHP
- Solutions **concises et efficaces** (pas de verbosité inutile)
- Choix techniques **justifiés et adaptés** au besoin
- Architecture Laravel **standard sans complexité superflue**

---

## ✨ Fonctionnalités

### Fonctionnalités principales (requis)
- ✅ **Lister les tâches** avec titre, description, statut, dates de création/modification
- ✅ **Ajouter une tâche** via formulaire dédié
- ✅ **Marquer comme terminée** en un clic
- ✅ **Supprimer une tâche** avec confirmation
- ✅ **Modifier une tâche** (édition complète)

### Fonctionnalités bonus
- 🌓 **Mode sombre/clair** avec persistance localStorage
- 👁️ **Icônes Heroicons** pour une meilleure UX
- 📱 **Interface responsive** adaptée mobile/desktop
- ⚡ **Feedback utilisateur** avec messages flash
- 🎨 **Design moderne** avec Bootstrap 5

---

## 🚀 Installation

### Prérequis
- PHP 8.2 ou supérieur
- Composer
- Node.js & npm

### Étapes d'installation

```bash
# Cloner le projet
git clone <votre-repo>
cd todo-app

# Installer les dépendances PHP
composer install

# Installer les dépendances JavaScript
npm install

# Copier le fichier .env (déjà configuré)
cp .env .env.backup  # optionnel : backup

# Générer la clé d'application (si nécessaire)
php artisan key:generate

# Créer la base de données SQLite
touch database/database.sqlite

# Exécuter les migrations
php artisan migrate

# Compiler les assets
npm run build

# Lancer le serveur de développement
php artisan serve
```

➜ Accédez à l'application sur **http://127.0.0.1:8000**

---

## 🏗️ Architecture

```
app/
├── Models/
│   └── Task.php                          # Modèle Eloquent (fillable)
└── Http/Controllers/
    └── TaskController.php                # CRUD complet (60 lignes)

database/
└── migrations/
    └── 2025_12_24_180927_create_tasks_table.php  # Schema avec enum status

resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php                 # Layout avec navbar + dark mode
│   └── tasks/
│       ├── index.blade.php               # Liste des tâches
│       ├── create.blade.php              # Formulaire création
│       ├── show.blade.php                # Détails tâche
│       └── edit.blade.php                # Formulaire édition
├── css/
│   └── app.css                           # Styles custom (16 lignes)
└── js/
    └── app.js                            # Import Bootstrap

routes/
└── web.php                               # 8 routes RESTful

public/build/                             # Assets compilés par Vite
```

---

## 💡 Choix techniques effectués

### Laravel 11 (LTS)
- **Pourquoi ?** Version LTS avec architecture moderne et support long terme
- **Avantages** : Eloquent ORM expressif, Blade intuitif, migrations pour versioning DB
- **Code concis** : `Task::latest()->get()` au lieu de SQL manuel

### SQLite
- **Pourquoi ?** Simplicité d'installation, fichier unique portable
- **Avantages** : Zero configuration, parfait pour démo/test technique
- **Alternative** : MySQL/PostgreSQL pour production

### Bootstrap 5 (via npm, pas CDN)
- **Pourquoi ?** Build optimisé, contrôle des versions, pas de dépendance externe
- **Avantages** : Composants éprouvés, responsive natif, gain de temps
- **Vite** : Build tool moderne pour compilation optimale

### Blade Icons + Heroicons
- **Pourquoi ?** Package officiel Blade UI Kit, SVG optimisés
- **Avantages** : Meilleure intégration que du SVG inline, maintenance facilitée
- **Alternative** : Font Awesome, mais Heroicons plus léger

### Architecture MVC standard (pas de Repository Pattern)
- **Pourquoi ?** YAGNI (You Ain't Gonna Need It) - pas de sur-ingénierie
- **Avantages** : Code simple et maintenable, Eloquent suffit pour un CRUD
- **Justification** : 2 lignes au lieu de 20+ avec Repository/Service layers

### Route Model Binding
- **Pourquoi ?** Laravel résout automatiquement `{task}` en instance
- **Avantages** : Plus propre que `Task::findOrFail($id)`, moins de code

### Timezone Europe/Paris
- **Pourquoi ?** Application française, utilisateurs en France
- **Avantages** : Affichage correct des dates/heures

### Validation côté serveur
- **Pourquoi ?** Sécurité - ne jamais faire confiance au client
- **Avantages** : Protection contre injections, données valides en DB

---

## 📦 Stack technique complète

| Technologie | Version | Rôle |
|------------|---------|------|
| **Laravel** | 11.47.0 | Framework PHP backend |
| **PHP** | 8.2+ | Langage serveur |
| **SQLite** | 3.39.2 | Base de données |
| **Bootstrap** | 5.3.8 | Framework CSS |
| **Vite** | 6.0 | Build tool frontend |
| **Blade** | - | Moteur de templates |
| **Blade Icons** | 1.8.0 | Gestion des icônes |
| **Heroicons** | 2.6.0 | Bibliothèque d'icônes |
| **Eloquent** | - | ORM Laravel |

---

## 🔧 Exemples de code

### Controller concis (méthode index)
```php
public function index()
{
    return view('tasks.index', ['tasks' => Task::latest()->get()]);
}
```

### Routes RESTful
```php
Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::post('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
```

### Validation inline
```php
$request->validate([
    'title' => 'required|max:255',
    'description' => 'nullable',
    'status' => 'required|in:à faire,en cours,terminée',
]);
```

### Enum dans migration
```php
$table->enum('status', ['à faire', 'en cours', 'terminée'])->default('à faire');
```

---

## 🎨 Fonctionnalités de l'interface

### Dark Mode
- Toggle persistant avec `localStorage`
- Icônes Heroicons (lune/soleil)
- Transition fluide

### Navigation
- Navbar responsive Bootstrap
- Liens actifs mis en évidence
- Fil d'Ariane sur les pages de détail

### Feedback utilisateur
- Messages flash de succès (création, modification, suppression)
- Badges de statut colorés
- Dates relatives ("il y a X minutes")

---

## 🚧 Améliorations possibles avec plus de temps

### Fonctionnalités
- [ ] **Authentification utilisateur** (Laravel Breeze)
- [ ] **Filtres et recherche** (par statut, date, titre)
- [ ] **Pagination** pour grandes listes
- [ ] **Tri des colonnes** (date, titre, statut)
- [ ] **Tags/catégories** pour organiser les tâches
- [ ] **Dates d'échéance** avec notifications
- [ ] **Pièces jointes** (upload de fichiers)
- [ ] **Historique des modifications**

### Technique
- [ ] **Tests automatisés** (PHPUnit, Pest)
- [ ] **API REST** pour frontend découplé (Vue.js, React)
- [ ] **Cache** (Redis) pour optimisation
- [ ] **Queue jobs** pour emails asynchrones
- [ ] **Soft deletes** pour corbeille
- [ ] **Seeders** pour données de démo
- [ ] **Docker** pour environnement reproductible
- [ ] **CI/CD** (GitHub Actions)

### UX/UI
- [ ] **Drag & Drop** pour réorganiser les tâches
- [ ] **Edition inline** (sans page dédiée)
- [ ] **Raccourcis clavier** (accessibilité)
- [ ] **Mode liste/grille** (affichage alternatif)
- [ ] **Animations** (transitions, loading states)
- [ ] **PWA** (installation sur mobile)

---

## 📝 Notes de développement

### Décisions notables
- **Formulaire séparé** : Meilleure UX et séparation des responsabilités (liste vs création)
- **Named routes** : Maintenance facilitée (changement d'URL sans toucher aux vues)
- **CSS minimal** : Bootstrap gère 99%, seulement 16 lignes custom pour les icônes
- **Pas de JavaScript framework** : Pas nécessaire pour une app simple
- **Eloquent timestamps** : Gestion automatique de `created_at` et `updated_at`

### Bugs corrigés pendant le développement
- Timezone UTC → Europe/Paris (décalage d'1 heure)
- Suppression de Tailwind (installé par défaut mais non utilisé)
- Optimisation CSS (élimination de duplications)

---

## 📄 License

MIT

---

## 👤 Auteur

Projet réalisé dans le cadre d'un test technique pour une alternance en développement web.

**Contact** : francois.lavieille@habitatpresto.com
