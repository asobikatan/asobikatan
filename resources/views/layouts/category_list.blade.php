@extends($ua)
@section('title')
    カテゴリ一覧| 日常をちょっと楽しく。
@endsection

@section('contents')
    <h2>あそびカタのカテゴリ</h2>
    @foreach($list as $cat_num => $cat_name)
        <a class="list_item" href="/category/{{$cat_num}}">{{$cat_name}}</a>
    @endforeach
@endsection

@section('footer')
    @include('sp_objects.footer')
@endsection
