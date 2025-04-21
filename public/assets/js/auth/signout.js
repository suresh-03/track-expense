
function handleSignout(api){

	const form = document.getElementById('signout-form');
	form.addEventListener('submit',  (event) => {

		event.preventDefault();

		const formData = new FormData(form);
		formData.append('action','signout');

		fetch(api,{
			method: 'POST',
			body: formData
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