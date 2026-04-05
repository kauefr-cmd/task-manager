@extends('layouts.app')

@section('title', 'Editar Tarefa')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('tasks.show', $task) }}" class="btn btn-ghost btn-sm">← Voltar</a>
        <h2 class="text-3xl font-bold">Editar Tarefa</h2>
    </div>

    <div class="card bg-base-100 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('tasks.update', $task) }}">
                @csrf
                @method('PUT')

                <div class="form-control mb-4">
                    <label class="label" for="title">
                        <span class="label-text font-medium">Título <span class="text-error">*</span></span>
                    </label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $task->title) }}"
                        class="input input-bordered @error('title') input-error @enderror"
                        placeholder="Nome da tarefa"
                    >
                    @error('title')
                        <div class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="form-control mb-4">
                    <label class="label" for="description">
                        <span class="label-text font-medium">Descrição</span>
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="textarea textarea-bordered @error('description') textarea-error @enderror"
                        placeholder="Detalhes da tarefa (opcional)"
                    >{{ old('description', $task->description) }}</textarea>
                    @error('description')
                        <div class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    <div class="form-control">
                        <label class="label" for="status">
                            <span class="label-text font-medium">Status</span>
                        </label>
                        <select id="status" name="status" class="select select-bordered @error('status') select-error @enderror">
                            <option value="pending" @selected(old('status', $task->status) === 'pending')>Pendente</option>
                            <option value="in_progress" @selected(old('status', $task->status) === 'in_progress')>Em progresso</option>
                            <option value="done" @selected(old('status', $task->status) === 'done')>Concluída</option>
                        </select>
                        @error('status')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label class="label" for="due_date">
                            <span class="label-text font-medium">Prazo</span>
                        </label>
                        <input
                            type="date"
                            id="due_date"
                            name="due_date"
                            value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
                            class="input input-bordered @error('due_date') input-error @enderror"
                        >
                        @error('due_date')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="flex gap-3 justify-end">
                    <a href="{{ route('tasks.show', $task) }}" class="btn btn-ghost">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection