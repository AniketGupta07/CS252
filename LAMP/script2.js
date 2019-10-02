$('#login-button').click(function(){
  $('#login-button').fadeOut("slow",function(){
    $("#signup-container").fadeIn();
    TweenMax.from("#signup-container", .4, { scale: 0, ease:Sine.easeInOut});
    TweenMax.to("#signup-container", .4, { scale: 1, ease:Sine.easeInOut});
  });
});

$(".close-btn").click(function(){
  TweenMax.from("#signup-container", .4, { scale: 1, ease:Sine.easeInOut});
  TweenMax.to("#signup-container", .4, { left:"0px", scale: 0, ease:Sine.easeInOut});
  $("#signup-container, #forgotten-container").fadeOut(800, function(){
    $("#login-button").fadeIn(800);
  });
});

/* Forgotten Password */
$('#forgotten').click(function(){
  $("#signup-container").fadeOut(function(){
    $("#forgotten-container").fadeIn();
  });
});