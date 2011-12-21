<? if( empty($news) ) return; ?>

<div class="span16">
    <div class="row">
        <div class="span16">
            <h2><?=$news['title']?></h2>
            <blockquote
                <small><?= human_date( $news['added_at'] )?></small>                
            </blockquote>
            <p><?=nl2br( $news['content'] ) ?></p>
            <p>
                <small><a href="/" title="На главную">&larr; Назад</a> | <a href="<?=$_SERVER['REQUEST_URI']?>" title="<?=$news['title']?>">Ссылка на материал</a></small>
            </p>
        </div>
    </div>
</div>