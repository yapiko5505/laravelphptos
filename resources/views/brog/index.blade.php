@extends('layouts.app')

@section('content')
<div class="container-fluid my-2">
    <div class="row m-2">
        <div class="col">
            <h3 class="font-weight-bold">ブログ</h3>
        </div>
        <div class="col text-right">
            <a type="button" href="{{ url('/brog/create/') }}" class="btn btn-primary text-right" role="button">新規追加</a>
        </div>
    </div>

    @if( session('message') )
        <div class="alert alert-success" role="alert">{{ session('message') }}</div>
    @endif

    <table class="table table-bordred">
        <thead class="table-dark">
            <tr>
                <th scope="col">
                    id
                </th>
                <th scope="col">
                    画像
                </th>
                <th scope="col">
                    タイトル
                </th>
                <th scope="col">
                    詳細
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
            @if(count($brogs) > 0)
            @foreach($brogs as $key=>$brog)
            <tr>
                <th scope="row">
                    {{ $key+1 }}
                </th>
                <td style="max-width: 200px;">
                    <img src="{{ asset('images')}}/{{$brog->image}}" class="img-fluid" />
                </td>
                <td>
                    {{$brog->title}}
                </td>
                <td style="max-width: 300px;">
                    {{$brog->memo}}
                </td>
                <td>
                    {{$brog->category->name}}
                </td>
                <td>
                    <a href="{{ route('brog.edit',[$brog->id])}}">
                        <button type="button" class="btn btn-outline-primary">編集</button>
                    </a>
                </td>
                <td>
                    <form method="post" action="{{route('brog.destroy', $brog)}}" class="float-right">
                    @csrf
                    @method('delete')
                        <button type="submit" class="btn btn-outline-danger" onClick="return confirm('削除しますか。');">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="7">追加された詳細はありません。</td>
            </tr>
            @endif
        </tbody>
    </table>

    <div class="mx-auto">
        {{$brogs->links("pagination::bootstrap-4")}}
    </div>

</div>
@endsection