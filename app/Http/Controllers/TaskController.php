<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Models\TaskUser;

class TaskController extends Controller
{
    public function create(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|unique:Tasks,title|min:4|max:255',
                'description' => 'required|string|min:5',
                'due_date' => 'required|date_format:Y-m-d',
                'assignee' => 'required|array',
                'assignee.*' => 'exists:users,id'
            ]);
            $task = new Tasks();
            $task->title = $request->title;
            $task->description = $request->description;
            $task->due_date = $request->due_date;
            $task->save();
            // Attach assignees to the task
            $assignees = $request->input('assignee', []); // Get array of assignee IDs from the request
            $task->users()->attach($assignees);
            return response()->json(['task' => $task], 201);
        } catch(\Exception $error) {
            return response()->json(['error' => $error->getMessage()], 500);
        }
    }

    public function getAll(Request $request)
    {
        // filter by status, date, assigned user
        $limit = is_numeric($request->limit) ? (int)$request->limit : 5;
        $page = is_numeric($request->page) ? (int)$request->page : 1;
        $tasks = Tasks::all();
        return response()->json(['tasks' => $tasks], 200);
    }
}
