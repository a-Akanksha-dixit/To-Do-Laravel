<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tasks;

class TaskController extends Controller
{
    public function create(Request $request) {
        try {
            $request->validate([
                'title' => 'required|string|unique:Tasks,title|min:4|max:255',
                'description' => 'required|string|min:5',
                'due_date' => 'required|date_format:Y-m-d'
            ]);
            $task = new Tasks();
            $task->title = $request->title;
            $task->description = $request->description;
            $task->due_date = $request->due_date;
            $task->save();
            return response()->json(['task' => $task], 201);
        } catch(\Exception $error) {
            return response()->json(['error' => $error->getMessage()], 500);
        }
    }
}
