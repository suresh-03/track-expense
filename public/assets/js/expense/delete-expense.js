
function handleDeleteExpense(api,apiKey){

	const errorMsg = document.getElementById('error-msg');

	errorMsg.textContent = '';

	const input = { 
		action: 'deleteExpense',
		expenseId: this.value
	};

	fetch(api,{
		method: 'POST',
		headers: {
			'Content-Type':'application/json',
			'Authorization': 'Bearer '+apiKey
		},
		body: JSON.stringify(input)
	})
	.then(response => response.json())
	.then(data => {
		errorMsg.textContent = data.message;
	})
	.catch(error => {
		console.log(error);
		errorMsg.textContent = "something went wrong. please try again later";
	});
}