function scrollMe(){$("a.anchor_link").click(function(){return $("html, body").animate({scrollTop:$('[name="'+$.attr(this,"href").substr(1)+'"]').offset().top},1e3),!1})}var $=jQuery;$(document).ready(function(){scrollMe()});