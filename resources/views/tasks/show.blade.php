@extends('layouts.app')

@section('title', $task->title)

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('tasks.index') }}" class="btn btn-ghost btn-sm">← Voltar</a>
        <h2 class="text-3xl font-bold">Detalhes da Tarefa</h2>
    </div>

    <div class="card bg-base-100 shadow-sm">
        <div class="card-body">

            <div class="flex items-start justify-between gap-4 mb-6">
                <h3 class="text-2xl font-semibold">{{ $task->title }}</h3>
                @php
                    $badge = match($task->status) {
                        'pending'     => 'badge-warning',
                        'in_progress' => 'badge-info',
                        'done'        => 'badge-success',
                        default       => 'badge-ghost',
                    };
                    $label = match($task->status) {
                        'pending'     => 'Pendente',
                        'in_progress' => 'Em progresso',
                        'done'        => 'Concluída',
                        default       => $task->status,
                    };
                @endphp
                <span class="badge {{ $badge }} badge-lg shrink-0">{{ $label }}</span>
            </div>

            @if($task->description)
                <div class="mb-6">
                    <p class="text-sm font-medium text-base-content/50 uppercase tracking-wide mb-1">Descrição</p>
                    <p class="text-base-content leading-relaxed">{{ $task->description }}</p>
                </div>
            @endif

            <div class="divider my-2"></div>

            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="font-medium text-base-content/50 uppercase tracking-wide mb-1">Prazo</p>
                    <p class="font-semibold">
                        {{ $task->due_date ? $task->due_date->format('d/m/Y') : 'Sem prazo' }}
                    </p>
                </div>
                <div>
                    <p class="font-medium text-base-content/50 uppercase tracking-wide mb-1">Criado em</p>
                    <p class="font-semibold">{{ $task->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <div class="divider my-2"></div>

            <div class="flex gap-3 justify-end">
                <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                    onsubmit="return confirm('Excluir esta tarefa permanentemente?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error btn-outline">Excluir</button>
                </form>

                @if($task->status !== 'done')
                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary">Editar</a>
                @else
                    <div class="tooltip" data-tip="Tarefas concluídas não podem ser editadas">
                        <button class="btn btn-primary btn-disabled" disabled>Editar</button>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

@endsection