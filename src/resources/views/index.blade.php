@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}
">
@endsection

@section('content')
    @if (session('success'))
        <div class="header__text">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="header__text--danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="content">
        {{-- <div class="todo"> --}}
        <div class="todo__title--new">新規作成</div>
        <form class="create-form" action="/todos" method="post">
            @csrf
            <div class="create-form__inner">
                <input class="create-form__input" type="text" name="content" value="{{ old('content') }}">
            </div>
            <div class="create-form__category">
                <select class="create-form__category-input" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="create-form__button">
                <button class="create-form__button-submit" type="submit">作成</button>
            </div>
        </form>
        {{-- </div> --}}
        {{-- <div class="todo"> --}}
        <div class="todo__title--new">Todo検索</div>
        <form class="create-form" action="/todos/search" method="get">
            @csrf
            <div class="create-form__inner">
                <input class="create-form__input" type="text" name="keyword" value="{{ old('keywoed') }}">
            </div>
            <div class="create-form__category">
                <select class="create-form__category-input" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="create-form__button">
                <button class="create-form__button-submit" type="submit">検索</button>
            </div>
        </form>
        {{-- </div> --}}
        <div class="todo-table">
            <table class="todo-table__inner">
                <tr class="todo-table__row">
                    <th class="todo-table-item">
                        Todo
                    </th>
                    <th class="todo-table-item">
                        カテゴリー
                    </th>
                    <th class="todo-table-item"></th>
                </tr>

                @foreach ($todos as $todo)
                    <tr class="todo-table__row">
                        <td class="todo-table-item">
                            <form action="/todos/update" class="update-form" method="post">
                                @method('patch')
                                @csrf
                                <div class="update-form__item">
                                    <input class="update-form__item-input" type="text" name="content"
                                        value={{ $todo->content }}>
                                    <input type="hidden" name='id' value="{{ $todo['id'] }}">
                                </div>
                        </td>
                        <td class="todo-table-item">
                            <div class="update-form__item">
                                <p class="update-form__item-category">
                                    {{ $todo['category']['name'] }}
                                </p>
                            </div>
                        </td>
                        <td class="todo-table-item">
                            <div class="update-form__button">
                                <button class="update-form__button-submit" type="submit">更新</button>
                            </div>
                            </form>
                            <form action="/todos/delete" class="delete-form" method="post">
                                @method('delete')
                                @csrf
                                <div class="delete-form__button">
                                    <button class="delete-form__button-submit" type="submit">削除</button>
                                    <input type="hidden" name='id' value="{{ $todo['id'] }}">
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
                {{-- <tr class="todo-table__row">
                    <td class="todo-table-item">
                        <form action="/todos/update" class="update-form" method="patch">
                            @csrf
                            <div class="update-form__item">
                                <input class="update-form__item-input" type="text" name="todo" method="post"
                                    value="test2">
                            </div>
                            <div class="update-form__button">
                                <button class="update-form__button-submit" type="submit">更新</button>
                            </div>
                        </form>
                    </td>
                    <td class="todo-table-item">
                        <form action="/todos/delete" class="delete-form" method="delete">
                            @csrf
                            <div class="delete-form__button">
                                <button class="delete-form__button-submit" type="submit">削除</button>
                            </div>
                        </form>
                    </td>
                </tr> --}}

            </table>
        </div>
    </div>
@endsection
