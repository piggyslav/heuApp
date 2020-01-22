{extends 'commonComponents/main.tpl'}
{block name='body'}
    <div class="row">
        {foreach $products as $product}

            <div class="card mb-4 w-100" >
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="{$product['imageUrl']}" class="card-img" alt="" style="max-height: 250px">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{$product['title']}</h5>
                            <p class="card-text">Cena od {$product['price']['min']} Kč do {$product['price']['max']} Kč</p>
                            <p class="card-text"><small class="text-muted">{$product['description']}</small></p>
                            <a href="/?page=product&productid={$product['productId']}" class="btn btn-primary">Porovnat ceny</a>
                        </div>
                    </div>
                </div>
            </div>
        {/foreach}
    </div>
    <div class="row">
        <div class="col d-flex align-items-center justify-content-center">
            Stranky:
           {for $i=1; $i<=ceil($productsCount/$productPerPage); $i++}
               {if $smarty.get.p == $i}
                   <span class="ml-3 active">{$i}</span>
                   {else}
                    <a class="ml-3" href="/?page=category&categoryid={$categoryId}&p={$i}">{$i}</a>
               {/if}

           {/for}
        </div>
    </div>
{/block}