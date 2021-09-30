<main role="main">
    <div>
        <h2 class="text-lowercase mb-3 mt-2">sports trading calculator</h3>
    </div>
    <div id="infoDiv">
        <table class="table table-dark infoTop table-bordered">
            <tbody>
                <tr>
                    <td>
                        <div class="form-group">
                            <label for='target'>Target:</label>
                            <input class="form-control" onkeyup='topFormData();' maxlength='5' id='target' />
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for='minStake'>Minimun Stake:</label>
                            <input class="form-control" id='minStake' disabled />
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for='idealBalance'>Ideal Balance:</label>
                            <input class="form-control" id='idealBalance' disabled />
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for='maxOdd'>Max. Odd:</label>
                            <input class="form-control" id='maxOdd' type='text' disabled />
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br />
    <div id="mainFormDiv">
        <table class="table table-hover table-dark table-bordered">
            <thead>
                <th>SerialNo</th>
                <th>Odd</th>
                <th>Stake</th>
                <th>Win/Lose</th>
                <th>Outcome</th>
            </thead>
            <tbody id="mainForm"></tbody>
        </table>
    </div>
</main>
