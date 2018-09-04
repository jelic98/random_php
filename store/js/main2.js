var selectedPath;
var selectedCountry;
var currentCountry;

$(function(){
    var allPaths = $("svg path").get();
    console.log("Debug:// Total Paths: " + allPaths.length);
    console.log("Debug:// PathsArray Length: " + Object.keys(pathsArray).length);

    /* $.each( allPaths, function( key, value ) {
		var id = $(value).prop("id");
		if (pathsArray.hasOwnProperty(id)) {
			// $(value).addClass("debugHide");
		} else {
			// console.log("Debug:// Currently Missing: " + id);
			// $(value).addClass("missing");
		}  		
	});		 */

    $("svg path").on("click", function(event){
        event.preventDefault();

        currentCountry = $("#country_name").html();
        selectedCountry = $(this).prop("id");

        if(selectedCountry == currentCountry) {
            if (selectedPath != undefined) {
                var country_name = $(selectedPath).prop("id");
                var theURL = "/get_country_name.php?country=" + country_name.toLowerCase();
                // var theURL = $(selectedPath).closest("a").prop("href");						    
                // var url = theA.prop("href");
                // console.log("theURL =" + JSON.stringify(theURL) );
                // console.log("theURL =" + theURL );
                window.location = theURL;

            } else {
                console.log("selectedPath is undefined");
            }
        }

        if ( selectedPath == undefined )  {
            $(this).addClass("active");
            selectedPath = $(this);
        } else {
            if ( selectedPath != $(this) ) {
                $(this).addClass("active");
                $(selectedPath).removeClass("active");
                selectedPath = $(this);
            }		
        } 

        var $countryName = $(this).prop("id");
        $("#country_name").html($countryName);
    });

    /* $("svg path").on("keydown", function(event){
		if(event.which == 13) //enter
        	event.preventDefault();
	}); */

    function moveToNextPath(key) {
        if (selectedPath == undefined) {
            selectedPath = $("svg path[id='US']").get();		    
            // console.log("selectedPath = " + selectedPath);
            $(selectedPath).addClass("active");
            $countryName = $(selectedPath).prop("id");
            $("#country_name").html($countryName);			
        } else {

            $(selectedPath).removeClass("active");

            $("#country_name").html("");

            var id = $(selectedPath).prop("id");

            // console.log("moveToNextPath called with key = " + key + " and ID = " + id);
            if (id in pathsArray) {
                switch(key) {
                    case "up":
                        selectedPath = $("svg path[id='"+ pathsArray[id][0] +"']").get();
                        break;
                    case "left":
                        selectedPath = $("svg path[id='"+ pathsArray[id][1] +"']").get();
                        break;
                    case "down":
                        selectedPath = $("svg path[id='"+ pathsArray[id][2] +"']").get();
                        break;
                    case "right":
                        selectedPath = $("svg path[id='"+ pathsArray[id][3] +"']").get();
                        break;
                }
            }

            $(selectedPath).addClass("active");	
            $countryName = $(selectedPath).prop("id");
            $("#country_name").html($countryName);

        }				
    }

    $(window).keydown(function(event){		
        // event.KeyCode 37 = left / 38 = up / 39 = right / 40 = down
        // alert(event.keyCode); 

        if (event.keyCode == 37) {
            moveToNextPath("left");
        }

        if (event.keyCode == 38) {
            moveToNextPath("up");
        }

        if (event.keyCode == 39) {
            moveToNextPath("right");
        }

        if (event.keyCode == 40) {
            moveToNextPath("down");
        }

        if (event.keyCode == 13) {
            if (selectedPath != undefined) {
                var country_name = $(selectedPath).prop("id");
                var theURL = "/get_country_name.php?country=" + country_name.toLowerCase();
                // var theURL = $(selectedPath).closest("a").prop("href");						    
                // var url = theA.prop("href");
                // console.log("theURL =" + JSON.stringify(theURL) );
                // console.log("theURL =" + theURL );
                window.location = theURL;

            } else {
                console.log("selectedPath is undefined");
            }
        }

    });

});