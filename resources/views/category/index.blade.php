@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 720px">

    <div class="text-right">
        <a href="{{ url('/brog/create') }}">＜ 戻る</a>
    </div>

    @if(session('message'))
        <div class="alert alert-success" role="alert">{{ session('message') }}</div>
    @endif

    <table class="table table-bordered mt-2">
        <thead class="table-dark">
            <tr>
                <th scope="col">
                    #
                </th>
                <th scope="col">
                    作成日
                </th>
                <th scope="col">
                    カテゴリー
                </th>
                <th scope="col">
                    編集
                </th>
                <th scope="col">
                    削除
                </th>
            </tr>
        </thead>
        <tbody>
            @if(count($categories) > 0)
                @foreach($categories as $key=>$category)
                <tr>
                    <th scope="row">
                        {{ $key+1 }}
                    </th>
                    <td>
                        {{ $category->created_at->format('Y/m/d') }}
                    </td>
                    <td>
                        {{ $category->name}}
                    </td>
                    <td>
                        <a href="{{ route('category.edit', ['category' => $category->id ]) }}">
                            <button type="button" class="btn btn-outline-primary">編集</button>
                        </a>
                    </td>
                    <td>
                        <form method="post" action="{{ route('category.destroy', $category)}}" class="float-right">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-outline-danger" onClick="return confirm('削除しますか?');">削除</button>
                    </td>
                </tr>
                @endforeach

                @else
                <tr>
                    <td colspan="5">追加されたカテゴリーはありません。</td>
                </tr>

            @endif
        </tbody>
    </table>

    <div class="my-4">
        <a href="{{ url('/category/create') }}">＞ カテゴリー追加ページへ</a>
    </div>

</div>
@endsection