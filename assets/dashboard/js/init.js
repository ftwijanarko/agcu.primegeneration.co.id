  $.Window = $(window);
  var current_width = $(window).width();
  var $mobileSize = 767,
    $isMobile;

  $.Window.bind("load resize", function() {

    if($.Window.width() <= $mobileSize){
      $isMobile = true;
      if(!$('body').hasClass('mobile')){
        $('body').addClass('mobile');
      }
    }else{
      $isMobile = false;
      if($('body').hasClass('mobile')){
        $('body').removeClass('mobile');
      }
    }
  });

  /*-------------------------------------
  Edit Profile
  -------------------------------------*/

  $.Window.bind("load resize", function() {
      $('#edit-profile-menu').click(function(e){
        e.preventDefault();
        $('body').addClass('bgposfix');
        $('#edit-profile').css({'display' : 'block', 'opacity' : '0'}).stop().animate({'opacity':'1'},500);
        $('#edit-profile .close').click(function(e){
          $('body').removeClass('bgposfix');
          $("html,body").scrollTop(0);
          $('#edit-profile').stop().animate({'opacity':'0'},500, function(){$(this).css({'display' : 'none', 'opacity' : '0'})});
        });
      });
      $('#edit-profile-menu2').click(function(e){
        e.preventDefault();
        $('body').addClass('bgposfix');
        $('#edit-profile').css({'display' : 'block', 'opacity' : '0'}).stop().animate({'opacity':'1'},500);
        $('#edit-profile .close').click(function(e){
          $('body').removeClass('bgposfix');
          $("html,body").scrollTop(0);
          $('#edit-profile').stop().animate({'opacity':'0'},500, function(){$(this).css({'display' : 'none', 'opacity' : '0'})});
        });
      });
  
  });


/*-------------------------------------
  Pop Up Materi
  -------------------------------------*/

  $.Window.bind("load resize", function() {
    if($isMobile == false){
      $('#popup-materi-menu').click(function(e){
        e.preventDefault();
        $('body').addClass('bgposfix');
        $('#popup-materi').css({'display' : 'block', 'opacity' : '0'}).stop().animate({'opacity':'1'},500);
        $('#popup-materi .close').click(function(e){
          $('body').removeClass('bgposfix');
          $("html,body").scrollTop(0);
          $('#popup-materi').stop().animate({'opacity':'0'},500, function(){$(this).css({'display' : 'none', 'opacity' : '0'})});
        });
      });
    }else{
      $('#popup-materi-menu').unbind();
    }
  });