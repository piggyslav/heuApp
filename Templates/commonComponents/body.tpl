<body>
<div class="container">
    <div class="col">
        <h1>Super heureka app</h1>
    </div>
    <div class="w100"></div>
    <div class="row">
        <div class="col-3">
            <ul class="nav flex-column">

                {foreach $categories as $category}
                    <li class="nav-item">
                        <a class="nav-link active" href="/?category={$category['categoryId']}">{$category['title']}</a>
                    </li>
                {/foreach}

            </ul>
        </div>
        <div class="col-9">
            {block name='body'}
                <p>Hello, world!</p>
            {/block}
        </div>
    </div>

</div>
</body>