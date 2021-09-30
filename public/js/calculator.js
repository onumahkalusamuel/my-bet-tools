function loadForm(num) {
    //check for previous label tag value
    //appending one line
    formRow = "<td><label class='text-center d-block'>" + num + ".</label></td>";
    formRow += "<td><input class='form-control' id='row" + num + "' type='text' maxlength='4' size='3' /></td>";
    formRow += "<td><input class='form-control' id='stake" + num + "' type='text' maxlength='9' size='3' disabled /></td>";
    formRow += "<td><input class='form-control' id='winOrLose" + num + "' type='text' size='3' maxlength='9' disabled /></td>";
    formRow += "<td><select class='form-control outcome' data-row='row" + num + "'><option>--Select--</option><option>Win</option><option>Lose</option></select></td>";
    var child = document.createElement('tr');
    child.innerHTML = formRow
    document.getElementById("mainForm").appendChild(child);
    document.querySelectorAll('.outcome').forEach(function(ele) {
        ele.addEventListener('change', addRowOrExit);
    })
}

function saveBtn() {
    var child = document.createElement('span');
    child.innerHTML = "<button class='btn btn-primary' onclick='save();'>Save!</button>";
    document.getElementById("mainFormDiv").appendChild(child);
}

function calculateStake() {
    add = num - 1;

    if (add == 1) {
        $target = document.getElementById("target").value;
    } else {
        $target = document.getElementById("winOrLose" + (num - 2)).value;
    }

    $odd = document.getElementById("row" + add).value;
    if ($odd != "") {
        $stake = $target / ($odd - 1);
        $stake = round($stake);
        $winOrLose = round($stake * $odd);
        document.getElementById("stake" + add).value = $stake;
        document.getElementById("winOrLose" + add).value = $winOrLose;

    } else {
        document.getElementById("stake" + add).value = "";
        document.getElementById("winOrLose" + add).value = "";
    }

    function round(num) {
        return Math.round(num * 100) / 100;
    }
}

function topFormData() {
    $target = document.getElementById("target").value;
    if ($target != "") {
        document.getElementById("minStake").value = "50";
        $minStake = document.getElementById("minStake").value;

        document.getElementById("idealBalance").value = idealBalance($target);
        document.getElementById("maxOdd").value = maxOdd($target);
    } else {
        document.getElementById("idealBalance").value = "";
        document.getElementById("maxOdd").value = maxOdd("");
    }

    function idealBalance(target) {
        return target * 150;
    }

    function maxOdd(target) {
        return (target / $minStake) + 1;
    }
}

//serial number generator
function serialNo() {
    return num += 1;
}

function check() {
    return confirm('Are you Sure?');
}

function addRowOrExit(event) {
    var target = event.target;
    var myValue = target.value;
    var dataRow = target.getAttribute('data-row');
    if (myValue == "Win") {
        if (check()) {
            document.getElementById(dataRow).setAttribute('disabled', 'disabled');
            target.setAttribute('disabled', 'disabled');
            saveBtn();
        }
    } else if (myValue == "Lose") {
        if (check()) {
            loadForm(num);
            serialNo();
            document.getElementById(dataRow).setAttribute('disabled', 'disabled');
            target.setAttribute('disabled', 'disabled');
        }
    }
}