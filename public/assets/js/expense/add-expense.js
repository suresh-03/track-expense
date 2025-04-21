function handleAddExpense(api){

	const form = document.getElementById('add-expense-form');

	form.addEventListener('submit', (event) => {
		event.preventDefault();
	
		const amount = parseFloat(document.getElementById('amount').value.trim());
		const description = document.getElementById('description').value.trim();

		const errorMsg = document.getElementById('error-msg');

		errorMsg.textContent = ''; 

		if(!validAmount(amount)){
			errorMsg.textContent = 'entered amount is invalid';
			return;
		}

		if(description === ''){
			errorMsg.textContent = 'description should not be empty';
			return;
		}

		const formData = new FormData(form);
		formData.append('action','addExpense');


		fetch(api,{
			method: 'POST',
			body: formData
		})
		.then(response => response.json())
		.then(data => {
			if(data.status == 'success'){
				if(data.redirect){
					window.location.href = data.redirect;
				}
			}
			errorMsg.textContent = data.message;
		})
		.catch(error => console.log(error));

	});
}

function validAmount(amount){
	return !isNaN(amount) && amount > 0;
}