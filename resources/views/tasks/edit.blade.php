@extends('layouts.app')

@section('title', 'Modifier ' . $task->title)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <a href="{{ route('tasks.show', $task) }}" class="btn btn-outline-secondary mb-4">← Retour</a>

            <h4 class="mb-3">Modifier la tâche</h4>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('tasks.update', $task) }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="title" class="form-label">Titre *</label>
                            <input type="text" name="title" id="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $task->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $task->description) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="status" class="form-label">Statut *</label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="à faire" {{ old('status', $task->status) === 'à faire' ? 'selected' : '' }}>À faire</option>
                                <option value="en cours" {{ old('status', $task->status) === 'en cours' ? 'selected' : '' }}>En cours</option>
                                <option value="terminée" {{ old('status', $task->status) === 'terminée' ? 'selected' : '' }}>Terminée</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                            <a href="{{ route('tasks.show', $task) }}" class="btn btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
