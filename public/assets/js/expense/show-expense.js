function handleExpenseRequest(apis,apiKey,action,data = null){

	const errorMsg = document.getElementById('error-msg');

	errorMsg.textContent = '';

	let api = apis['API'];

	const input = {
		action	
	}

	if(action == 'deleteExpense'){
		if(!confirm("Are you want to delete this expense")){
			return;
		}
		input['expenseId'] = data['EXPENSE_ID'];
	}

	if(action == 'editExpense'){
		data['action'] = action;
		input = data;
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
			appendContent(res,apis,apiKey);
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

function appendContent(res, apis, apiKey) {
	const expenseTable = document.getElementById('expense-table');

	for (let i = 0; i < res.length; i++) {
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
		deleteButton.id = 'delete-expense-button';
		const expenseId = res[i].EXPENSE_ID;
		// Assign onclick function
		deleteButton.onclick = function() {
			handleExpenseRequest(apis['API'], apiKey, 'deleteExpense',res[i]);
		};

		deleteCell.appendChild(deleteButton);
		row.appendChild(deleteCell);

		//Create edit button
		const editCell = document.createElement('td');
		const editButton = document.createElement('button');
		editButton.innerText = 'Edit';

		editButton.onclick = function(){
			window.location.href = apis['EDIT_FORM_URL']+'/'+expenseId;
		}

		editCell.appendChild(editButton);
		row.appendChild(editCell);

		expenseTable.appendChild(row);
	}
}
