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
        <div class="todo">
            <form class="create-form" action="/todos" method="post">
                @csrf
                <div class="create-form__inner">
                    <input class="create-form__input" type="text" name="content">
                </div>
                <div class="create-form__button">
                    <button class="create-form__button-submit" type="submit">作成</button>
                </div>
            </form>
        </div>
        <div class="todo-table">
            <table class="todo-table__inner">
                <tr class="todo-table__row">
                    <th class="todo-table__title">
                        Todo
                    </th>
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
                                <div class="update-form__button">
                                    <button class="update-form__button-submit" type="submit">更新</button>
                                </div>
                            </form>
                        </td>
                        <td class="todo-table-item">
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
