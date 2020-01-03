var $ = jQuery;
$(document).ready(function() {
	$("#site-navigation").mmenu({
		// options
		"extensions": [
			"fx-menu-zoom",
			"fx-panels-slide-up",
			"position-right"
		],
		// "navbars": [
        //     {
        //        "position": "top",
        //        "content": [
        //           "searchfield"
        //        ]
        //     }
		//  ],
		 "searchfield": {
			"clear": true,
			"add": false,
			"search": false,
			"noResults": false,
			"panel":true
         }
	}, {
		// configuration
		clone: true,
		offCanvas: {
			pageSelector: "#page"
		},
		classNames: {
            selected: "active"
		}
	});
	$(".mm-searchfield__input input").keyup(function(e){
		if(e.keyCode == 13){
			window.location.href = '/?s=' + $(this).val();
		}
	});
});