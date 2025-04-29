function handleShowDeleteExpense(api,apiKey,action,expenseId = null){

	const errorMsg = document.getElementById('error-msg');

	errorMsg.textContent = '';

	const input = {
		action	
	}

	if(action == 'deleteExpense'){
		input['expenseId'] = expenseId;
	}

	fetch(api,{
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
			'Authorization': 'Bearer '+apiKey
		},
		body: JSON.stringify(input)
	})
	.then(response => response.json())
	.then(data => {
		if(data.status == 'success'){
			if(action == 'index'){
			const res = data.result;
			appendContent(res,api,apiKey);
			}
			else if(action == 'deleteExpense'){
				errorMsg.textContent = data.message;
				location.reload();
			}
		}
		else{
			errorMsg.textContent = data.message;
		}
		console.log(data);
	})
	.catch(error => {
		console.log(error);
		errorMsg.textContent = "something went wrong. please try again later";
	});
}

function appendContent(res, api, apiKey) {
	const expenseTable = document.getElementById('expense-table');

	for (var i = 0; i < res.length; i++) {
		const row = document.createElement('tr');

		// Create cells
		row.innerHTML =
			'<td>'+(i+1)+'</td>'+
			'<td>'+res[i].CATEGORY+'</td>'+
			'<td>'+res[i].TYPE+'</td>'+
			'<td>'+res[i].PAYMENT_METHOD+'</td>'+
			'<td>'+res[i].AMOUNT+'</td>'+
			'<td>'+res[i].DESCRIPTION+'</td>'+
			'<td>'+res[i].EXPENSE_DATE+'</td>';

		// Create delete button
		const deleteCell = document.createElement('td');
		const deleteButton = document.createElement('button');
		deleteButton.innerText = 'Delete';
		const expenseId = res[i].EXPENSE_ID;
		// Assign onclick function
		deleteButton.onclick = function() {
			handleShowDeleteExpense(api, apiKey, 'deleteExpense',expenseId);
		};

		deleteCell.appendChild(deleteButton);
		row.appendChild(deleteCell);

		expenseTable.appendChild(row);
	}
}
