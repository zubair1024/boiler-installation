(function ($) {
  $(document).ready(function() {
    $(window).on('resize', function(){
      window.screenWidth = $(window).width();
    }).resize();
    function getDuration() {
      if(screenWidth > 768){      
        return 4;
      }else{
        return 1;
      }
    }
    if($('#calendar').length > 0) {
      $('#calendar').fullCalendar({
        defaultView: 'agendaFourDays',
        startDate: new Date(),
        defaultDate: new Date(new Date().getTime()+(2*24*60*60*1000)),
        views: {
          agendaFourDays: {
            type: 'basicDay',
            duration: { 
              days: getDuration(),  
            },
            minTime: "10:00:00",
            maxTime: "22:00:00",
            dateIncrement: { days: 1 },
          }
        }, 
        nowIndicator : false,
        allDaySlot: false,
        displayEventTime : false,
        slotDuration: '02:00:00',
        columnHeaderFormat: 'dddd D MMMM',
        // weekends: false,
        height: 400,
        themeSystem: 'bootstrap4',
        events: {
          url: '/calendar-callbacks.php',
          type: 'POST',
          data: { type: 'getPeriods'},
          success: function(response) {
          },
          error: function() {
            alert('there was an error while fetching events!');
          },
        },
        eventColor: 'white',
        eventTextColor: '#231f1e',
        eventBorderColor: '#d9d9d9',
        eventClick: function(calEvent, jsEvent, view) {
          var startDate = calEvent.start.format('YYYY-MM-DD HH:mm:ss');
          var params = {type: 'bookAppointment', 'slot': startDate};
          jQuery.ajax({
            type: "POST",
            url: "/calendar-callbacks.php",
            data: params,
            dataType: 'json',
            success : function(response) {
              $('.book-appointment-btn').removeClass('disabled');
            }
          });
          $('.fc-event').css('border-color', '#d9d9d9');
          $(this).css('border-color', '#df1514');
        },
        eventRender: function (event, element, view) {
          $(element).css("margin", "0px 25px 5px 25px")
        }
      });
    }  
    // - Add class sticky on scroll
    $(window).on( 'scroll', function(){
      if ($(window).scrollTop() > 150) {
        $('body').addClass('sticky');
      } else {
        $('body').removeClass('sticky');
      }
    });
    // $('body').css({'min-height': $(window).height()+392+'px'});
    // - Menu 
    $('.menu-icon').click(function() {
       $('.main-nav ').slideToggle(400,"swing"); 
    });
    // - Quote page on load apply margin to allow scroll
    if($('.quote-page').height() > $(window).height()) {
      margin =  jQuery(window).height() - ($('.quote-page > div').last().height()+110+118);
      jQuery('html,body').animate({
        scrollTop: $('.quote-page > div').last().offset().top - 118
      }, 1000);
      jQuery('.quote-page').css({'margin-bottom': margin+'px'});
    }
    // - Book appointment disabled and enabled link
    $('.book-appointment-btn').click(function(e){
      if($(this).hasClass('disabled')){
        e.preventDefault();
      }
    });
    // - Add bootstrap classes to postcode lookup form
    if($('#opc_input').length > 0) {
      $('#opc_input').addClass('form-control');
      $('#opc_button').addClass('btn'); 
      $('#opc_button').click(function() {
        $('#opc_dropdown').addClass('form-control');
      });
    }
  });
})(jQuery);

function optSelect(num,opt,next,el) {
  jQuery(el).parent().find(jQuery('a')).removeClass("selected");
  jQuery(el).addClass("selected");
	jQuery.ajax({
    type: "POST",
    url: "/callbacks.php",
    data: { type: 'questions', quesNum: num, optSelected: opt, nxt: next },
    dataType: 'json',
    success : function(response) {
      display(response.html, response.divInfo)   
    }
  });
}

function serviceNotProvided(fuel) {
  swal({
    // animation: false,
    title: 'Sorry', 
    text: 'At this point in time we do not provide heating solution for '+fuel+' fuel.',
    confirmButtonText: 'Close'
  });
}
function display(html,divInfo) {
  currentDiv = divInfo.quesNumber;
  jQuery('#data-'+currentDiv).nextAll('.row').remove();
  jQuery('.main-container').append(html);
  if(jQuery(window).height() > (jQuery('#'+divInfo.next).height()+110+118)) {
    margin =  jQuery(window).height() - (jQuery('#'+divInfo.next).height()+110+118);
  }else{
    margin = 60
  }
  jQuery('html,body').animate({
    scrollTop: jQuery('#'+divInfo.next).offset().top - 118
  }, 600, 'swing');
  jQuery('.main-container').css({'margin-bottom': margin+'px'});
}

function getModel(el) {
  makeVal = jQuery(el).val();
  jQuery('#model').attr('disabled','disabled');
  if(makeVal == "") {
    jQuery('#make').addClass('error');
    return;
  }else{
    jQuery('#make').removeClass('error');
  }
  jQuery.ajax({
    type: "POST",
    url: "/callbacks.php",
    data: { type: 'getModel', make: makeVal},
    dataType: 'json',
    success : function(response) {
      // console.log(response.selectModel); 
      jQuery('.model-wrapper').replaceWith(response.selectModel);
    }
  });
}

function getQuote() {
  make = jQuery('#make').val();
  model = jQuery('#model').val();
  if(make != '' && model != ''){
    jQuery.ajax({
      type: "POST",
      url: "/callbacks.php",
      data: { type: 'saveMakeModel', make: make, model: model},
      dataType: 'json',
      success : function(response) {
        window.location.href = '/recommended-boilers';
      }
    }); 
  }else{
    if(make == "") {
      jQuery('#make').addClass('error');
    }
    if(model == "") {
      jQuery('#model').addClass('error');
    }
  }
}

function boilerSelected(id) {
  jQuery.ajax({
    type: "POST",
    url: "/callbacks.php",
    data: { type: 'boilerSelected', pid: id},
    dataType: 'json',
    success : function(response) {
      if(response.msg == 'success'){ 
        window.location.href = '/selected-boiler'; 
      }
    }
  });
}
