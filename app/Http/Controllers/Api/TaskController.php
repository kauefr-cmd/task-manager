<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();

        // filtro por status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // ordenação
        if ($request->has('sort')) {
            $sort = $request->sort;

            if (str_starts_with($sort, '-')) {
                $query->orderBy(substr($sort, 1), 'desc');
            } else {
                $query->orderBy($sort, 'asc');
            }
        }

        return $query->paginate(10);
    }

    public function store(StoreTaskRequest $request)
    {
        return Task::create($request->validated());
    }

    public function show($id)
    {
        return Task::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        // regra de negócio
        if ($task->status === 'done') {
            return response()->json([
                'message' => 'Não pode editar tarefa concluída'
            ], 400);
        }

        $task->update($request->all());

        return $task;
    }

    public function destroy($id)
    {
        Task::findOrFail($id)->delete();

        return response()->json([], 204);
    }
}
