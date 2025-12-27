@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/category.css') }}
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
        <div class="category">
            <form class="create-category-form" action="/categories" method="post">
                @csrf
                <div class="create-category-form__inner">
                    <input class="create-category-form__input" type="text" name="name">
                </div>
                <div class="create-category-form__button">
                    <button class="create-category-form__button-submit" type="submit">作成</button>
                </div>
            </form>
        </div>

        <div class="category-table">
            <table class="category-table__inner">
                <tr class="category-table__row">
                    <th class="category-table__title">
                        Category
                    </th>
                </tr>

                @foreach ($categories as $category)
                    <tr class="category-table__row">
                        <td class="category-table-item">
                            <form action="/categories/update" class="update-form" method="post">
                                @method('patch')
                                @csrf
                                <div class="update-form__item">
                                    <input class="update-form__item-input" type="text" name="name"
                                        value={{ $category->name }}>
                                    <input type="hidden" name='id' value="{{ $category['id'] }}">
                                </div>
                                <div class="update-form__button">
                                    <button class="update-form__button-submit" type="submit">更新</button>
                                </div>
                            </form>
                        </td>
                        <td class="category-table-item">
                            <form action="/categories/delete" class="delete-form" method="post">
                                @method('delete')
                                @csrf
                                <div class="delete-form__button">
                                    <button class="delete-form__button-submit" type="submit">削除</button>
                                    <input type="hidden" name='id' value="{{ $category['id'] }}">
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
