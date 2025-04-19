

function handleSignup(api){

	const form = document.getElementById('signup-form');

	form.addEventListener('submit', (event) => {

		event.preventDefault();

		const username = document.getElementById('username').value.trim();
		const email = document.getElementById('email').value.trim();
		const password = document.getElementById('password').value.trim();
		const errorMsg = document.getElementById('error-msg');


		errorMsg.textContent = '';

		if(username === ''){
			errorMsg.textContent = 'username required!';
			return;
		}

		if(!validEmail(email)){
			errorMsg.textContent = 'email is invalid';
			return;
		}

		if(!validPassword(password)){
			errorMsg.textContent = 'password is invalid';
			return;
		}

		const formData = new FormData(form);
		formData.append('action','signup');
		fetch(api,{
			method: 'POST',
			body: formData
		})
		.then(response => response.json())
		.then(data => {
			if(data.status === 'success'){
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


function validEmail(email){
	const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
	return emailPattern.test(email);
}

function validPassword(password){
	const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[^\s]{8,}$/;
	return passwordPattern.test(password);
}