

function fetchData(api){

fetch(api)
.then(response => response.json())
.then(data => {
	if(data.status === 'sucess'){
		console.log(data);
	const userInfo = '<p>'+data[0].ID+'</p><br>'+
					 '<p>'+data[0].EMAIL+'</p><br>'+
					 '<p>'+data[0].USERNAME+'</p>';

	document.getElementById("user-info").innerHTML = userInfo;
	}
	else{
		document.getElementById('error').innerHTML = '<p>'+data.message+'</p>';
	}
})
.catch(error => {
	console.log(error);
	document.getElementById('user-info').innerHTML = '<p>Error while fetching user data</p>';
});

}