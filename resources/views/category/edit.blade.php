@extends('layouts.app')

@section('content')
    <div class="container mt-3" style="max-width: 720px;">
        <div class="text-right">
            <a href="{{ url('/brog/create') }}">＜ 戻る</a>
        </div>

        @if(session('message'))
            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
        @endif

        <form action="{{ route('category.update', [ 'category' => $category->id ]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="categoryAdd" class="font-weight-bold">カテゴリー編集</label>
                <input type="text" class="form-control @error('name') is-valid @enderror" id="categoryAdd" name="name" value="{{ $category->name }}" />
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">編集</button>
        </form>

        <div class="my-4">
            <a href="{{ url('/category/') }}">＞ 一覧・追加ページ</a>
        </div>
    </div>
@endsection
