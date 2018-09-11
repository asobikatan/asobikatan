<link rel="stylesheet" href="/css/modai.css">
<div class="modal">
    <input id="modal-trigger" class="checkbox" type="checkbox" checked="checked">
    <div class="modal-overlay">
        <div align="center" class="modal-wrap">
            <div class="border_box">
                <div class="clearfix border_body">
                    @if($ua == 'objects.common')
                        <img class="floatLeft" src="/img/form/main01.png">
                    @endif
                    {{$msg}}
                    以下のルールを守って投稿してください。</br></br>
                    <ul><li>公序良俗に反する書き込みはやめましょう。</li>
                    <li>著作権を侵害することはやめましょう。</li>
                    <li>その他<a href="/kiyaku/" target="_blank">利用規約</a>に反する書き込みは削除することがあります。</li></ul>
                    </br><label for="modal-trigger"><img class="btn" src="/img/form/open.png" width="214" height="50" class="roll" /></label>
                </div>
            </div>
            </br><a href="/">TOPへ</a>
        </div>
    </div>
</div>
