/*
$(".tool").each(function(){
  $t = $(this);
  
  $t.click(function(){
    $(this).next().slideToggle();
  })
  .next().click(function(){
    $(this).slideToggle();
  })
  
})

*/



/*
 * prevent jumpy jquery slideToggle with this workaround:
 * http://stackoverflow.com/questions/1335461/jquery-slide-is-jumpy
 * 
 */
$('.tool').click(function(event) {
  //event.preventDefault();
  xToggleHeight($(this).next());
});

$('.toolinfo').click(function(event) {
  //event.preventDefault();
  xToggleHeight($(this).parent());
});

//For each collapsible element.
$('.toolinfo').each(function() {
  //Wrap a div around and set to hidden.
  $(this).wrap('<div style="height:0;overflow:hidden;visibility:hidden;"/>');
});

function xToggleHeight(el){
  //Get the height of the content including any margins.
  var contentHeight = el.children('.toolinfo').outerHeight(true);
  //If the element is currently expanded.
  if(el.hasClass("expanded")){
    //Collapse
    el.removeClass("expanded")
      .stop().animate({height:0},400,
      function(){
        //on collapse complete
        //Set to hidden so content is invisible.
        $(this).css({'overflow':'hidden', 'visibility':'hidden'});
      }
    );
  }else{
    //Expand
    el.addClass("expanded").css({'overflow':'', 'visibility':'visible'})
      .stop().animate({height: contentHeight},400,
      function(){
              //on expanded complete
              //Set height to auto incase browser/content is resized afterwards.
              $(this).css('height','');
      }
    );
  }
}


/*
$(".buttons li").click(function(){
        location.href = $(this).find("a").attr("href");
});
*/

$(".buttons li a").click(function(evt){
  evt.stopPropagation();
  this.click();
});

$(".toolinfo .description").click(function(evt){
  evt.stopPropagation();
});
