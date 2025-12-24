<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App - Laravel 11</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="mb-4">📝 Gestionnaire de Tâches</h1>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Nouvelle tâche</h5>
                        <form method="POST" action="/tasks">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                       placeholder="Titre de la tâche" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <textarea name="description" class="form-control" rows="2"
                                          placeholder="Description (optionnel)">{{ old('description') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
                    </div>
                </div>

                @forelse($tasks as $task)
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <h5 class="card-title {{ $task->status === 'terminée' ? 'text-decoration-line-through text-muted' : '' }}">
                                        {{ $task->title }}
                                    </h5>
                                    @if($task->description)
                                        <p class="card-text text-muted">{{ $task->description }}</p>
                                    @endif
                                    <div>
                                        <span class="badge bg-{{ $task->status === 'terminée' ? 'success' : ($task->status === 'en cours' ? 'warning' : 'secondary') }}">
                                            {{ $task->status }}
                                        </span>
                                        <small class="text-muted ms-2">{{ $task->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    @if($task->status !== 'terminée')
                                        <form method="POST" action="/tasks/{{ $task->id }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success" title="Marquer comme terminée">
                                                ✓
                                            </button>
                                        </form>
                                    @endif
                                    <form method="POST" action="/tasks/{{ $task->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Supprimer cette tâche ?')" title="Supprimer">
                                            ×
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-muted py-5">
                        <p>Aucune tâche pour le moment. Commencez par en ajouter une !</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
