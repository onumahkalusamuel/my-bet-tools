<main role="main">
    {include file="public/components/page-title-component.tpl" title="picks history"}
    {if $dates}
        <div>
            <h4>List</h4>
            {foreach from=$dates item=date}
                <a class="btn btn-outline-primary" href="{$route->urlFor('picks-history', [], ['date' => $date.date])}">
                    {$date.date}
                </a>
            {/foreach}
        </div>
    {/if}

    {if $games}
        <a class="py-1" href="{$route->urlFor('picks-history')}">&larr;Back to List</a>
        <div class="mb-3">
            <h4 class="border-bottom border-dark py-2 mb-3">outright win</h4>
            {foreach from=$games.outright item=acc_group key=acc_key}
                {include file="public/components/accumulator-table-component.tpl" acc_key=$acc_key acc_group=$acc_group}
            {/foreach}
        </div>
        <div class="mb-3">
            <h4 class="border-bottom border-dark py-2 mb-3">double chance</h4>
            {foreach from=$games.double_chance item=acc_group key=acc_key}
                {include file="public/components/accumulator-table-component.tpl" acc_key=$acc_key acc_group=$acc_group}
            {/foreach}
        </div>
        <div class="mb-3">
            <a class="py-1" href="{$route->urlFor('picks-history')}">&larr;Back to List</a>
        </div>
    {/if}
</main>