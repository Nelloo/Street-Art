

$(document).on({
    ajaxStart: function() { $('body').addClass("loading");    },
    ajaxStop: function() { $('body').removeClass("loading"); }    
});


/*
Execute the module + action
with get parameters using json
and inject the result inside the given div
Only method get is currently allowed
example 

 onclick='executeAjax("main","test","#test",{"a":10});

*/



function executeAjax(myurl,thediv) {
	var div = $(thediv);	
 $.ajax({
    url: myurl,
    type: 'GET',
    success	: function(data, textStatus, jqXHR) {
      // Succes. On affiche un message de confirmation
      //thediv.html(data); 
	  div.html(data);
    }
  });
  return false;
}


/** Changer la chanson en cours */


function changeMP3(song) {
	$("#audio").get(0).src = song;
	return false;
}


