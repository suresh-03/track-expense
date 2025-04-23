
function handleSignout(api,apiKey){

	const form = document.getElementById('signout-form');
	form.addEventListener('submit',  (event) => {

		event.preventDefault();

		const formData = new FormData(form);
		formData.append('action','signout');

		const plainData = {};

		formData.forEach((value,key) => {
			plainData[key] = value;
		});

		fetch(api,{
			headers: {
				'Content-Type': 'application/json',
				'Authorization': 'Bearer '+apiKey
			},
			method: 'POST',
			body: JSON.stringify(plainData)
		})
		.then(response => response.json())
		.then(data => {
			console.log(data);
			if(data.status == 'success'){
				if(data.redirect){
					window.location.href = data.redirect;
				}
			}
		})
		.catch(error => console.log(error));
	});
}