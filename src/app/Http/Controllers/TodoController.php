<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Models\Category;
use Illuminate\Http\Request;


class TodoController extends Controller
{
    public function index()
    {
        // Categoryデータも一緒に（with）取得する
        $todos = Todo::with('category')->latest('updated_at')->get();
        $categories = Category::all();

        return view('index', compact('todos', 'categories'));
    }


    public function store(TodoRequest $request)
    {
        $todo = $request->only(['category_id', 'content']);
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

    //ローカルスコープを使えるようにする
    public function search(Request $request)
    {
        $todos = Todo::with('category')->CategorySearch($request->category_id)->KeywordSearch($request->keyword)->get();
        $categories = Category::all();

        return view('index', compact('todos', 'categories'));
    }
}
