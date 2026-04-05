@extends('layouts.app')

@section('title', 'Tarefas')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h2 class="text-3xl font-bold">Tarefas</h2>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">+ Nova Tarefa</a>
</div>

{{-- Filtros --}}
<div class="card bg-base-100 shadow-sm mb-6">
    <div class="card-body py-4">
        <form method="GET" action="{{ route('tasks.index') }}" class="flex flex-wrap gap-3 items-end">
            <div class="form-control">
                <label class="label label-text">Status</label>
                <select name="status" class="select select-bordered select-sm w-40">
                    <option value="">Todos</option>
                    <option value="pending" @selected(request('status') === 'pending')>Pendente</option>
                    <option value="in_progress" @selected(request('status') === 'in_progress')>Em progresso</option>
                    <option value="done" @selected(request('status') === 'done')>Concluída</option>
                </select>
            </div>
            <div class="form-control">
                <label class="label label-text">Ordenar por</label>
                <select name="sort" class="select select-bordered select-sm w-44">
                    <option value="">Padrão</option>
                    <option value="due_date" @selected(request('sort') === 'due_date')>Prazo (crescente)</option>
                    <option value="-due_date" @selected(request('sort') === '-due_date')>Prazo (decrescente)</option>
                    <option value="title" @selected(request('sort') === 'title')>Título (A-Z)</option>
                    <option value="-title" @selected(request('sort') === '-title')>Título (Z-A)</option>
                </select>
            </div>
            <button type="submit" class="btn btn-neutral btn-sm">Filtrar</button>
            @if(request()->hasAny(['status', 'sort']))
                <a href="{{ route('tasks.index') }}" class="btn btn-ghost btn-sm">Limpar</a>
            @endif
        </form>
    </div>
</div>

{{-- Tabela --}}
@if($tasks->isEmpty())
    <div class="card bg-base-100 shadow-sm">
        <div class="card-body items-center py-16 text-center">
            <p class="text-base-content/50 text-lg">Nenhuma tarefa encontrada.</p>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-sm mt-4">Criar primeira tarefa</a>
        </div>
    </div>
@else
    <div class="card bg-base-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Status</th>
                        <th>Prazo</th>
                        <th class="text-right">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td>
                            <a href="{{ route('tasks.show', $task) }}" class="font-medium hover:underline">
                                {{ $task->title }}
                            </a>
                            @if($task->description)
                                <p class="text-sm text-base-content/50 truncate max-w-xs">{{ $task->description }}</p>
                            @endif
                        </td>
                        <td>
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
                            <span class="badge {{ $badge }}">{{ $label }}</span>
                        </td>
                        <td>
                            {{ $task->due_date ? $task->due_date->format('d/m/Y') : '—' }}
                        </td>
                        <td>
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('tasks.show', $task) }}" class="btn btn-ghost btn-xs">Ver</a>
                                @if($task->status !== 'done')
                                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-ghost btn-xs">Editar</a>
                                @endif
                                <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                                    onsubmit="return confirm('Excluir esta tarefa?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error btn-xs">Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6 flex justify-center">
        {{ $tasks->links() }}
    </div>
@endif

@endsection