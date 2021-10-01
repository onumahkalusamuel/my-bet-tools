<div class="mb-4">
    <h6>Group ID: {$acc_key} --- {$acc_group.date}</h6>
    <table class="table table-hover games">
        <thead>
            <tr class="">
                <th>Code</th>
                <th class="col">Details</th>
                <th class="text-center">Date/Time</th>
                <th class="text-center">Market&nbsp;/&nbsp;Pick</th>
                <th class="text-center">Odds</th>
                <th class="text-center">Result</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        {foreach from=$acc_group.games item=game}
            <tr class="text-{$game.status}">
                <td>{$game.code}</td>
                <td>
                    <strong>{$game.title}</strong><br />
                    <em>{$game.group}</em>
                </td>
                <td class="text-center">{$game.date}<br/>{$game.time}</td>
                <td class="text-center">{$game.market} / {$game.choice}</td>
                <td class="text-center">{$game.odds}</td>
                <td class="text-center">{$game.result}</td>
                <td class="text-center">{$game.status}</td>
            </tr>
        {/foreach}
        <tfoot>
            <tr class="bg-dark text-light text-right">
                <th colspan="7">Total Odds: {$acc_group.total_odds|round:"2"} ---- Stake: #500 ----- Expected
                    Return: #{($acc_group.total_odds * 500)|number_format:"2"} </th>
            </tr>
        </tfoot>
    </table>
</div>