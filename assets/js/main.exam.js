var timer;

var compareDate = new Date(exam_endtime);

timer = setInterval(function() {
  timeBetweenDates(compareDate);
}, 1000);
function timeBetweenDates(toDate) {
  var dateEntered = toDate;
  var now = new Date();
  var difference = dateEntered.getTime() - now.getTime();

  if (difference <= 0) {

    // Timer done
    submitFinalExam('timer')
  } else {
    
    var seconds = Math.floor(difference / 1000);
    var minutes = Math.floor(seconds / 60);
    var hours = Math.floor(minutes / 60);
    var days = Math.floor(hours / 24);

    hours %= 24;
    minutes %= 60;
    seconds %= 60;

    $("#hours").text(hours);
    $("#minutes").text(minutes);
    $("#seconds").text(seconds);
  }
}

function submitFinalExam(action_by) {
  var title = '';
  var info = '';
  if(action_by === 'user'){
    title = 'Are you sure?';
    info = 'You want to submit. You have time to review your answers.';
  }else if(action_by === 'timer'){
    title = 'Time\'s Up';
    info = 'Submit your answers now.';
  }
  $('.err_msg').html("");
  $('.modal-title').html(title);
  $('.modal-desc').html(info);
  $('#myModal').modal('show');
}
$(document).bind("contextmenu",function(e){
 return false;
});
$(function(){

  $('body').bind('cut copy paste', function(event) {
   event.preventDefault();
  });

  $('#btn_finalsave').on('click', ()=>{
    var frmData = new FormData($('#frmExam')[0]);
    $.ajax({
      beforeSend: ()=>{
        $('.err_msg').html("Do not close or refresh the window, else all your progress will be lost.");
        $('#btn_finalsave').addClass('btn-progress');
        $('#btn_finalsave').attr('disabled', 'disabled');
      },
      url: baseURL+'Exam/save_candidate_exam_answers',
      type: 'POST',
      data: frmData,
      dataType: 'json',
      contentType: false,
      processData: false,
      success: (resp)=>{
        if(resp.status){
          clearInterval(timer);
          $('#myModal').modal('hide');
          Swal.fire({
            title: 'Success',
            text: 'All your answers have been saved successfully.',
            icon: 'success',
          }).then(()=>{
            window.location.href=baseURL+'Exam/conclusion?exam='+btoa(resp.exam_id)+'&user='+btoa(resp.user_id);
          });
        }else{
          $('.err_msg').html("Unable to connect server due to slow internet. Please try again.");
          $('#btn_finalsave').removeClass('btn-progress');
          $('#btn_finalsave').removeAttr('disabled');
        }
      },
      error: (err)=>{
        $('.err_msg').html("Slow server connection. Please try again.");
        $('#btn_finalsave').removeClass('btn-progress');
        $('#btn_finalsave').removeAttr('disabled');
      }
    });
  });
});