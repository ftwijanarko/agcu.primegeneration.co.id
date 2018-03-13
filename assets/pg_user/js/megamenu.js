// Dropdown Menu Fade
    $(".dropdown").on("click",
        function() { if(!$('.navbar-collapse').hasClass('in')){ $('.dropdown-menu', this).stop().fadeIn("fast"); }
        },
        function() { $('.dropdown-menu', this).stop().fadeOut("fast");
    });