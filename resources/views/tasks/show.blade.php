@extends('layouts.app')

@section('title', $task->title)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary mb-4">← Retour</a>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <h4 class="mb-3">Détails de la tâche</h4>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">{{ $task->title }}</h5>

                    <div class="mb-3">
                        <span class="badge bg-{{ $task->status === 'terminée' ? 'success' : ($task->status === 'en cours' ? 'warning' : 'secondary') }} fs-6">
                            {{ ucfirst($task->status) }}
                        </span>
                    </div>

                    @if($task->description)
                        <div class="mb-4">
                            <h6 class="text-muted">Description</h6>
                            <p class="card-text">{{ $task->description }}</p>
                        </div>
                    @endif

                    <div class="row text-muted small mb-4">
                        <div class="col-md-6">
                            <strong>Créée le :</strong> {{ $task->created_at->format('d/m/Y à H:i') }}
                            <br>
                            <small>({{ $task->created_at->diffForHumans() }})</small>
                        </div>
                        <div class="col-md-6">
                            <strong>Modifiée le :</strong> {{ $task->updated_at->format('d/m/Y à H:i') }}
                            <br>
                            <small>({{ $task->updated_at->diffForHumans() }})</small>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary">Modifier</a>
                        <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Supprimer cette tâche ?')">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
