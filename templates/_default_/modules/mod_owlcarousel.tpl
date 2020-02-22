{*Слайдер галлерея coin slider https://code.google.com/p/coin-slider/downloads/list *}

{if $is_photo}
<link rel="stylesheet" type="text/css" href="/modules/mod_coinslider/css/coin-slider-styles.css" />
<script type="text/javascript" src="/modules/mod_coinslider/js/coin-slider.min.js"></script>
<div class="sliderContainer">
    <div id="coin-slider">
        {foreach key=tid item=con from=$photos}
            <img src="/images/photos/medium/{$con.file}" alt="{$con.title|escape:'html'}" width="{$cfg.width}" height="{$cfg.height}" />
            <span>{$con.title|escape:'html'}</span>
        {/foreach}
    </div>
</div>
{literal}
<script>
jQuery("#coin-slider").coinslider({{/literal}
    width: {$cfg.width},
    height: {$cfg.height},
    {if !$cfg.shownav}navigation: false,{/if}
    {if $cfg.effect!="random"}effect: '{$cfg.effect}',{/if}
    {literal}
    spw: 5,
    sph: 4
});
</script>
<style>.cs-title { width:{/literal}{$cfg.width}px; {if !$cfg.showtitle}display:none;{/if}{literal}}{/literal}
</style>
{else}
<p>Нет фотографий</p>
{/if}