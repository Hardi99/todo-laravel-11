@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="mb-0">Mes tâches</h1>
                <a href="{{ route('tasks.create') }}" class="btn btn-primary">+ Nouvelle tâche</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @forelse($tasks as $task)
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <h5 class="card-title {{ $task->status === 'terminée' ? 'text-decoration-line-through text-muted' : '' }}">
                                    <a href="{{ route('tasks.show', $task) }}" class="text-decoration-none">
                                        {{ $task->title }}
                                    </a>
                                </h5>
                                @if($task->description)
                                    <p class="card-text text-muted small">{{ Str::limit($task->description, 100) }}</p>
                                @endif
                                <div>
                                    <span class="badge bg-{{ $task->status === 'terminée' ? 'success' : ($task->status === 'en cours' ? 'warning' : 'secondary') }}">
                                        {{ $task->status }}
                                    </span>
                                    <small class="text-muted ms-2">{{ $task->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-primary" title="Voir">
                                    <span>@svg('heroicon-o-eye')</span>
                                </a>
                                @if($task->status !== 'terminée')
                                    <form method="POST" action="{{ route('tasks.complete', $task) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" title="Marquer comme terminée">
                                            @svg('heroicon-o-check')
                                        </button>
                                    </form>
                                @endif
                                <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette tâche ?')" title="Supprimer">
                                        @svg('heroicon-o-trash')
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
@endsection
