<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;


class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();

        return view('index', compact('todos'));
    }


    public function store(TodoRequest $request)
    {
        $todo = $request->only(['content']);
        Todo::create($todo);

        return redirect('/')->with('success', 'Todoを作成しました');
    }

    public function update(TodoRequest $request)
    {
        $todo = $request->only(['content']);
        // unset($form['_token']);
        Todo::find($request->id)->update($todo);
        return redirect('/')->with('success', 'Todoを更新しました');
    }
    public function destroy(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect('/')->with('success', 'Todoを削除しました');
    }
}
