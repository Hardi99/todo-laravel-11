@extends('layouts.app')

@section('title', 'Nouvelle tâche')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary mb-4">← Retour</a>

            <h4 class="mb-3">Nouvelle tâche</h4>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="{{ route('tasks.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre *</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                                   placeholder="Titre de la tâche" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4"
                                      placeholder="Description (optionnel)">{{ old('description') }}</textarea>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
