@if ($asobikata->number_safe_min <= 1)
    <a href="/category/c1">1人のあそび</a>
@endif
@if ($asobikata->number_safe_max >= 10)
    <a href="/category/c2">大勢のあそび</a>
@endif
@if ($asobikata->price == 0 || $asobikata->price == null)
    <a href="/category/c3">0円でできるあそび</a>
@endif
@if ($asobikata->place_type %2 == 1)
    <a href="/category/c4">室内のあそび</a>
@endif
@if ($asobikata->one_time <= 10)
    <a href="/category/c5">すぐ終わるあそび</a>
@endif
@if ($asobikata->place_type %2 == 0)
    <a href="/category/c6">アウトドアのあそび</a>
@endif
@if ($asobikata->age_min < 20)
    <a href="/category/c7">こどもと遊べるあそび</a>
@endif
@if ($asobikata->detail_3_5 == 1)
    <a href="/category/c8">異性と盛り上がるあそび</a>
@endif
@if ($asobikata->place_type >= 3)
    <a href="/category/c9">車内のあそび</a>
@endif
