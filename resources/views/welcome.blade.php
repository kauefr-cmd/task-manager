@extends('layouts.app')

@section('title', 'Bem-vindo — Task Manager')

@section('content')
<div class="hero min-h-[60vh]">
    <div class="hero-content text-center">
        <div class="max-w-lg">
            <div class="text-6xl mb-6">✅</div>
            <h1 class="text-5xl font-bold">Task Manager</h1>
            <p class="py-6 text-base-content/70">
                Organize suas tarefas de forma simples e eficiente.
                Crie, acompanhe e conclua suas atividades em um só lugar.
            </p>
            <div class="flex gap-3 justify-center">
                <a href="{{ route('tasks.index') }}" class="btn btn-primary btn-lg">
                    Ver Tarefas
                </a>
                <a href="{{ route('tasks.create') }}" class="btn btn-outline btn-lg">
                    Criar Tarefa
                </a>
            </div>
        </div>
    </div>
</div>
@endsection