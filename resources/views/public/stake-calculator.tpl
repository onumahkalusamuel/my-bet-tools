<main role="main">
    {include file="public/components/page-title-component.tpl" title="stake calculator"}
    <div class="pt-3">
        <table class="table infoTop table-bordered">
            <tbody>
                <tr>
                    <th class="text-center">
                        <div class="form-group">
                            <label for='target'>Target</label>
                            <input class="form-control" onkeyup='topFormData();' maxlength='5' id='target' />
                        </div>
                    </th>
                    <th class="text-center">
                        <div class="form-group">
                            <label for='minStake'>Minimun Stake</label>
                            <input class="form-control" id='minStake' disabled />
                        </div>
                    </th>
                    <th class="text-center">
                        <div class="form-group">
                            <label for='idealBalance'>Ideal Balance</label>
                            <input class="form-control" id='idealBalance' disabled />
                        </div>
                    </th>
                    <th class="text-center">
                        <div class="form-group">
                            <label for='maxOdd'>Max. Odd</label>
                            <input class="form-control" id='maxOdd' type='text' disabled />
                        </div>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
    <br />
    <div id="mainFormDiv">
        <table class="table table-hover table-bordered">
            <thead>
                <th class="text-center">Serial No</th>
                <th class="text-center">Odds</th>
                <th class="text-center">Stake</th>
                <th class="text-center">Returns</th>
                <th class="text-center">Win/Lose</th>
            </thead>
            <tbody id="mainForm"></tbody>
        </table>
    </div>
</main>