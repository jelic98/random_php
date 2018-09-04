var selectedPath;
var selectedPathIndex = -1;
var allPaths;

$(function(){

    allPaths = $("svg path").get();	

    /* $("svg path").on("hover", function(){
		var $countryName = $(this).prop("id");
		// console.log("this value = " + $countryName );
		// $("#country_name").html($countryName);
		// var $action = $(this).closest('form').prop('action');
		// console.log("$action = " + $action);
		// window.location = $action + $value;
	});

	$("svg path").on("click", function(event){
		event.preventDefault();
		if ( selectedPath != undefined ) {
			if ( selectedPath != $(this) ) {
				$(this).addClass("active");
				selectedPath.removeClass("active");
				selectedPath = $(this);
			}		
		} else {
			$(this).addClass("active");
			selectedPath = $(this);
		}
		var $countryName = $(this).prop("id");
		$("#country_name").html($countryName);
	}); */

    console.log("allPaths = " + allPaths);

    $(window).keydown(function(event){

        if (selectedPath == undefined) {
            selectedPath = allPaths[0];
            selectedPathIndex = 0;
            console.log("selectedPath = " + selectedPath);
            $(selectedPath).addClass("active");
            $countryName = $(selectedPath).prop("id");
            $("#country_name").html($countryName);			
        }

        $(selectedPath).removeClass("active");
        $("#country_name").html("");
        // alert(event.keyCode);
        // event.KeyCode 37 = left / 38 = up / 39 = right / 40 = down 

        if (event.keyCode == 37) {
            selectedPathIndex -= 1;
            selectedPath = allPaths[selectedPathIndex];
        }

        if (event.keyCode == 39) {
            selectedPathIndex += 1;
            selectedPath = allPaths[selectedPathIndex];
        }

        $(selectedPath).addClass("active");
        $countryName = $(selectedPath).prop("id");
        $("#country_name").html($countryName);	

    });
});