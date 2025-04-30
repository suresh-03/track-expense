function handleEditExpense(api,apiKey){
	const form = document.getElementById('edit-expense-form');

	form.addEventListener('submit',(event) => {
		event.preventDefault();


	});
}

function populateCategoryOptions(category){
	const categories = ['food','transportation','medical','education'];

	for(let i = 0; i < categories.length; i++){
		const option = document.createElement('option');
		option.value = categories[i];
		option.innerText = categories[i].charAt(0).toUpperCase()+categories[i].slice(1);
		if(category == categories[i]){
			option.selected = true;
		}
		document.getElementById('category').appendChild(option);
	}
}

function populatePaymentOptions(paymentMethod){
	const paymentMethods = ['cash','upi','credit card','debit card'];

	for(let i = 0; i < paymentMethods.length; i++){
		const option = document.createElement('option');
		option.value = paymentMethods[i];
		option.innerText = paymentMethods[i].charAt(0).toUpperCase()+paymentMethods[i].slice(1);
		if(paymentMethod == paymentMethods[i]){
			option.selected = true;
		}
		document.getElementById('payment-method').appendChild(option);
	}
}