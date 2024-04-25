var timer;

function startTimer(compareDate){
	timer = setInterval(function() {
	  timeBetweenDates(compareDate);
	}, 1000);
}
function timeBetweenDates(toDate) {
  var dateEntered = new Date(toDate);

  var now = new Date();
  var difference = dateEntered.getTime() - now.getTime();
  console.log(difference);
  if (dateEntered.toDateString() === now.toDateString()) {
	  if (difference <= 0) {

	    clearInterval(timer);
	    $('#btn_submit').click();
	    return true;
	  }else{
	  	var seconds = Math.floor(difference / 1000);
	    var minutes = Math.floor(seconds / 60);
	    var hours = Math.floor(minutes / 60);
	    var days = Math.floor(hours / 24);

	    hours %= 24;
	    minutes %= 60;
	    seconds %= 60;
	    $('#timer').html(hours+'Hrs : '+minutes+'Mins : '+seconds+'Sec');
	  }
  }else{
  	clearInterval(timer);
  	return true;
  }
  
}