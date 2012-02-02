<h1>Новости Таиланда</h1>

<? if( empty($news) ) return; ?>

<div class="span16">
    <div class="row">
    <?
    $i=1;
    foreach( $news as $n ){
        ?>
        <div class="span8" style="height:180px">
            <h3><a href="<?=site_url( $n['id'].'/'.$n['alias'].'.html' )?>"><?=$n['title']?></a><? if( $i <= 5 ) {?> <span class="label success">Новое</span><? } ?></h3>
                
            <blockquote>
                <p><?=nl2br( mb_strcut($n['content'], 0, 200) ) ?></p>
                <small><?= human_date( $n['added_at'] )?></small>                
            </blockquote>
        </div>
        
        <? if( !($i%2) ) { ?><div class="clearfix"></div><? } ?>
            
        <?    
        $i++;
    }
    ?>
    </div>
</div>