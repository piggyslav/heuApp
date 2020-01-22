{extends 'commonComponents/main.tpl'}
{block name='body'}
    <div class="row">
        <div class="card mb-4 w-100">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="{$product['imageUrl']}" class="card-img" alt="" style="max-height: 250px">
                    <div class="row">
                        {foreach $product['gallery'] as $img}
                            <div class="col-4">
                                <img src="{$img}" class="card-img" alt="" style="max-height: 250px">
                            </div>
                        {/foreach}
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{$product['title']}</h5>
                        <p class="card-text"><small><a href="/?page=category&categoryid={$productCategory['categoryId']}">{$productCategory['title']}</a> > </small><small class="text-muted">{$product['title']}</small></p>
                        <p class="card-text">Cena od {$product['price']['min']|number_format:0} Kč do {$product['price']['max']|number_format:0} Kč</p>
                        <p class="card-text"><small class="text-muted">{$product['description']}</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {assign var=i value=1}
    {foreach $offers as $offer}
        <div class=" offer row border-bottom mb-3 {if $i>3}d-none{/if}">
            {assign var='niceUrl' value='//'|explode:$offer['url']}
            {assign var='niceUrl' value='/'|explode:$niceUrl[1]}
            <div class="col-8"><p>{$offer['title']}</p><p><small class="text-muted">{$niceUrl[0]}</small></p></div>
            <div class="col-2"><a href="{$offer['url']}">Koupit</a></div>
            <div class="col-2">{$offer['price']|number_format:0} Kč</div>
        </div>
        {assign var=i value=$i+1}
    {/foreach}
    <div class="row">
        <div class="col d-flex align-items-center justify-content-center">
            <a href="#" id="showAllOffers">Zobrazit vsechny nabidky</a>
        </div>
    </div>
    <script>
        $('body').on('click','#showAllOffers',function (e) {
            e.preventDefault();
            $('.offer.d-none').removeClass('d-none');
            $(this).hide();
        })
    </script>

{/block}