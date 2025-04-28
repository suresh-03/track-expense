function handleShowExpense(api,apiKey){

	const errorMsg = document.getElementById('error-msg');

	errorMsg.textContent = '';

	const input = {
		action: 'index'
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
			const res = data.result;
			appendContent(res);
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

function appendContent(res){
	const expenseTable = document.getElementById('expense-table');
	for(var i = 0; i < res.length; i++){
		const row = document.createElement('tr');
		const content = '<td>'+(i+1)+'</td>'+
						'<td>'+res[i].CATEGORY+'</td>'+
						'<td>'+res[i].TYPE+'</td>'+
						'<td>'+res[i].PAYMENT_METHOD+'</td>'+
						'<td>'+res[i].AMOUNT+'</td>'+
						'<td>'+res[i].DESCRIPTION+'</td>'+
						'<td>'+res[i].EXPENSE_DATE+'</td>';
		row.innerHTML = content;
		expenseTable.appendChild(row);
	}
}