//I really feel like i dont know what I'm doing right now
//So please allow me to flood here with comments.
//Hahahahahaha...

//this is gonna be the top form data

function loadForm(num) {
	//check for previous label tag value
	//appending one line
	formRow = "<tr><td><label>"+num+"</label></td>";
	formRow += "<td><input id='row"+num+"' type='text' maxlength='4' size='3' /></td>";
	formRow += "<td><input id='stake"+num+"' type='text' maxlength='9' size='3' disabled /></td>";
	formRow += "<td><input id='winOrLose"+num+"' type='text' size='3' maxlength='9' disabled /></td>";
	formRow += "<td><select class='outcome' data-row='row"+num+"'><option>--Select--</option><option>Win</option><option>Lose</option></select></td></tr>";
	$("#mainForm").append(formRow);
}

function loadFormTop() {
	//loading the top values
	$("#infoTop").append("<tr>");
	$("#infoTop").append("<td><span class='label'>Target:</span> <input onkeyup='topFormData();' size='4' maxlength='5' id='target' type='text'></td>");
	$("#infoTop").append("<td><span class='label'>Minimun Stake:</span> <input size='4' id='minStake' type='text' disabled ></td>");
	$("#infoTop").append("</tr>");
	$("#infoTop").append("<tr>");
	$("#infoTop").append("<td><span class='label'>Ideal Balance:</span> <input size='4' id='idealBalance' type='text' disabled ></td>");
	$("#infoTop").append("<td><span class='label'>Max. Odd:</span> <input size='4' id='maxOdd' type='text' disabled ></td>");
	$("#infoTop").append("</tr>");
}


function saveBtn() {
	$("#mainFormDiv").append("<button class='btn btn-primary' onclick='save();'>Save!</button>");
}