@extends('layouts.app')

@section('content')
    <div class="container mt-3" style="max-width: 720px;">
        <div class="text-right">
            <a href="{{ url('/brog/create') }}">＜ 戻る</a>
        </div>

        @if(session('message'))
            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
        @endif

        <form action="{{ route('category.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="categoryAdd" class="font-weight-bold">新規カテゴリー追加</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="categoryAdd" name="name" />
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">追加</button>
        </form>

        <div class="my-4">
            <a href="{{ url('/category/') }}">＞ 一覧・追加ページ</a>
        </div>
    </div>
@endsection