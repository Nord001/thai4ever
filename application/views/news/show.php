<h1><a href="/">Новости Таиланда</a> <small>→</small> <?=$news['title']?></h1>

<? if( empty($news) ) return; ?>

<div class="span16">
    <div class="row">
        <div class="span16">
            <blockquote
                <small><?= human_date( $news['added_at'] )?></small>                
            </blockquote>
            <p><?=nl2br( $news['content'] ) ?></p>
            <p>
                <small><a href="/" title="На главную">&larr; Назад</a> | <a href="<?=$_SERVER['REQUEST_URI']?>" title="<?=$news['title']?>">Ссылка на материал</a></small>
            </p>
            <p>
				<noindex>
					<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
					<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="button" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,lj,friendfeed,moikrug"></div> 
				</noindex>            
			</p>
        </div>
    </div>
</div>