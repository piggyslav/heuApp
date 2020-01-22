{extends 'commonComponents/main.tpl'}
{block name='body'}
    <div class="row">
        {foreach $categories as $category}
            <div class="col-4">
                <div class="card">
                    <img src="{$category['imageUrl']}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{$category['title']}</h5>
                        <a href="/?page=category&categoryid={$category['categoryId']}" class="btn btn-primary">Přejít na kategorii</a>
                    </div>
                </div>
            </div>
        {/foreach}
    </div>
{/block}