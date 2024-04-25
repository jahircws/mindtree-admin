var counter = 0;
var counterId = setInterval(function() {
	counter++;
	console.log(counter);
	if(counter === 59){
		standByUser();
	}
}, 1000);

function standByUser() {
	clearInterval(counterId);
	Swal.fire({
		title: 'Stand By',
		text: 'You have been stand by more than a minute.',
		icon: 'error'
	}).then(()=>{
		window.location.href = baseURL+'Exam/timeout_logout';
	});
}

function repondExam(etitle) {
	Swal.fire({
	  title: 'Are you ready?',
	  text: 'To start you exam: '+etitle,
	  icon: 'question',
	  showCancelButton: true,
	  confirmButtonText: 'Start',
	  showLoaderOnConfirm: true,
	  preConfirm: (respond) => {
	  	if(respond){
	  		return fetch(`${baseURL}Exam/start_exam`)
		      .then(response => {
		        if (!response.ok) {
		          throw new Error(response.statusText)
		        }
		        return response.json()
		      })
		      .catch(error => {
		        Swal.showValidationMessage(
		          `Request failed: ${error}`
		        )
		      })
	  	}
	  },
	  allowOutsideClick: () => !Swal.isLoading()
	}).then((result) => {
	  if (result.isConfirmed) {
	    if(result.value){
	    	window.location.href = baseURL+'Exam/live_exam';
	    }else{
	    	Swal.fire(
	    		'Error',
	    		'Something went wrong.',
	    		'error'
	    	);
	    }
	  }
	})
}