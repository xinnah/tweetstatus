  var url = $("#base_url").val();
  $(document).ready(function() {
      App.init();
  });
  function confirmDelete(){
    return confirm("Do You Sure Want To Delete This Data ?");
  }

  function confirmSynchronous(){
    return confirm("Do You Sure Want To Update your data ?");
  }

  $(function () {
    $("[rel='tooltip']").tooltip();

    $('[data-toggle="popover"]').popover();
  });
  function toggleFullscreen(elem) {
    elem = elem || document.documentElement;
    if (!document.fullscreenElement && !document.mozFullScreenElement &&
      !document.webkitFullscreenElement && !document.msFullscreenElement) {
      if (elem.requestFullscreen) {
        elem.requestFullscreen();
      } else if (elem.msRequestFullscreen) {
        elem.msRequestFullscreen();
      } else if (elem.mozRequestFullScreen) {
        elem.mozRequestFullScreen();
      } else if (elem.webkitRequestFullscreen) {
        elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
      }
    } else {
      if (document.exitFullscreen) {
        document.exitFullscreen();
      } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
      } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
      } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
      }
    }
  }
  document.getElementById('btnFullscreen').addEventListener('click', function() {
    toggleFullscreen();
  });
  
  $(".cancel_modal").click(function() {
      $(".overlay-modal-delete, .show_travel_modal").fadeOut("slow", function() {
      /*Remove inline styles*/
      $(".overlay-modal, .travel_dialog").removeAttr("style");
    });
  });

  $(".close_show").click(function() {
      $(".pop-outer").fadeOut("slow");
  });

  /* schudela tweet post */
  $("#tweet-post").click(function() {
    //alert(id);
    var _token = $('input[name="_token"]').val();
    var datetime = $('input[name="datetime"]').val();
    var currentTime = $('input[name="currentTime"]').val();
    var currentDate = $('input[name="currentDate"]').val();
    var color = $('select[name="color"]').val();
    var content = $('textarea[name="content"]').val();
    if(content !== null && content != ''){
      $("#content-error").hide();
      $.ajax({
        url: url+'/twitter-tweets',
        type: "POST",
        data: { 
          _token : _token,
          datetime: datetime,
          currentDate: currentDate,
          currentTime: currentTime,
          color: color,
          content: content
          
        },
        success: function(response){
          //console.log(response);
          if(response.status == 'error'){
            $("#response-error").show();
            $("#response-error").html(response.msg);
          }else{
            window.location.href = url+'/twitter-schedule-tweets';
          }

        }
      }); 
    }else{
      $("#content-error").show();
      $("#content-error").html('Content is required');
    }
       
  });
  

