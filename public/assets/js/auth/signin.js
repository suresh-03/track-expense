
function handleSignin(api,apiKey){

	const form = document.getElementById('signin-form');

	form.addEventListener('submit',(event) => {
		event.preventDefault();

		const email = document.getElementById('email').value.trim();
		const errorMsg = document.getElementById('error-msg');

		errorMsg.textContent = '';

		if(!validEmail(email)){
			errorMsg.textContent = 'invalid email';
			return;
		}

		const formData = new FormData(form);
		formData.append('action','signin');

		plainData = {};

		formData.forEach((value,key) => {
			plainData[key] = value;
		});

		fetch(api,{
			headers: {
				'Content-Type':'application/json',
				'Authorization': 'Bearer '+apiKey
			},
			method: 'POST',
			body: JSON.stringify(plainData)
			
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
		.catch(error => {
			console.log(error);
			errorMsg.textContent = "something went wrong. please try again later!";
		});

	});
}

function validEmail(email) {
	const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
	return emailPattern.test(email);
}