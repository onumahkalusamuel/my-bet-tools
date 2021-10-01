<main role="main">
    {include file="public/components/page-title-component.tpl" title="daily picks"}
    <div class="mb-5">
        <h4 class="border-bottom border-dark py-2 mb-3">outright win</h4>
        {foreach from=$games.outright item=acc_group key=acc_key}
            {include file="public/components/accumulator-table-component.tpl" acc_key=$acc_key acc_group=$acc_group}
        {/foreach}
    </div>
    <div class="mb-5">
        <h4 class="border-bottom border-dark py-2 mb-3">double chance</h4>
        {foreach from=$games.double_chance item=acc_group key=acc_key}
            {include file="public/components/accumulator-table-component.tpl" acc_key=$acc_key acc_group=$acc_group}
        {/foreach}
    </div>
</main>