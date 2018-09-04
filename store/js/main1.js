var selectedPath;

$(function(){
    $("svg path").on("click", function(event){
        event.preventDefault();
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

            switch(id) {
                case "US":
                    if (key=="up") { selectedPath = $("svg path[id='CA']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='BS']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='MX']").get(); }
                    break;
                case "CA":
                    if (key=="left") { selectedPath = $("svg path[id='US']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='US']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='GL']").get(); }
                    break;
                case "GL":
                    if (key=="left") { selectedPath = $("svg path[id='CA']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='IS']").get(); }
                    break;				
                case "MX":
                    if (key=="up") { selectedPath = $("svg path[id='US']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='US']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='GT']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='GT']").get(); }								
                    break;				
                case "GT":
                    if (key=="up") { selectedPath = $("svg path[id='MX']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='MX']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='HN']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='HN']").get(); }
                    break;
                case "HN":
                    if (key=="left") { selectedPath = $("svg path[id='GT']").get(); }
                    if (key=="up") { selectedPath = $("svg path[id='JM']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='JM']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='NI']").get(); }
                    break;
                case "NI":
                    if (key=="left") { selectedPath = $("svg path[id='HN']").get(); }
                    if (key=="up") { selectedPath = $("svg path[id='HN']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='CR']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='CR']").get(); }
                    break;
                case "CR":
                    if (key=="up") { selectedPath = $("svg path[id='NI']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='NI']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='PA']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='PA']").get(); }
                    break;
                case "PA":
                    if (key=="up") { selectedPath = $("svg path[id='CR']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='CR']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='CO']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='CO']").get(); }
                    break;
                case "CO":
                    if (key=="up") { selectedPath = $("svg path[id='PA']").get(); }				
                    if (key=="left") { selectedPath = $("svg path[id='PA']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='VE']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='EC']").get(); }				
                    break;
                case "EC":
                    if (key=="up") { selectedPath = $("svg path[id='CO']").get(); }				
                    // if (key=="left") { selectedPath = $("svg path[id='PA']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='CO']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='PE']").get(); }				
                    break;
                case "PE":
                    if (key=="up") { selectedPath = $("svg path[id='EC']").get(); }				
                    // if (key=="left") { selectedPath = $("svg path[id='PA']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='BR']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='BO']").get(); }				
                    break;
                case "VE":
                    if (key=="up") { selectedPath = $("svg path[id='PR']").get(); }				
                    if (key=="left") { selectedPath = $("svg path[id='CO']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='GY']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='BR']").get(); }				
                    break;
                case "GY":
                    if (key=="up") { selectedPath = $("svg path[id='PR']").get(); }				
                    if (key=="left") { selectedPath = $("svg path[id='VE']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='SR']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='BR']").get(); }				
                    break;
                case "SR":
                    // if (key=="up") { selectedPath = $("svg path[id='PR']").get(); }				
                    if (key=="left") { selectedPath = $("svg path[id='GY']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='GF']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='BR']").get(); }				
                    break;
                case "GF":
                    if (key=="left") { selectedPath = $("svg path[id='SR']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='BR']").get(); }				
                    break;
                case "BR":
                    if (key=="up") { selectedPath = $("svg path[id='GF']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='PE']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='UY']").get(); }				
                    break;
                case "UY":
                    if (key=="up") { selectedPath = $("svg path[id='BR']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='AR']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='FK']").get(); }				
                    break;
                case "JM":
                    if (key=="left") { selectedPath = $("svg path[id='HN']").get(); }
                    if (key=="up") { selectedPath = $("svg path[id='CU']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='HT']").get(); }
                    break;
                case "CU":
                    if (key=="up") { selectedPath = $("svg path[id='BS']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='JM']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='HT']").get(); }
                    break;
                case "HT":
                    if (key=="left") { selectedPath = $("svg path[id='JM']").get(); }
                    if (key=="up") { selectedPath = $("svg path[id='CU']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='DO']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='CO']").get(); }
                    break;
                case "DO":				
                    if (key=="left") { selectedPath = $("svg path[id='HT']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='PR']").get(); }
                    break;
                case "PR":				
                    if (key=="left") { selectedPath = $("svg path[id='DO']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='VE']").get(); }				
                    break;
                case "BS":
                    if (key=="up") { selectedPath = $("svg path[id='US']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='US']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='CU']").get(); }
                    break;
                case "BO":
                    if (key=="left") { selectedPath = $("svg path[id='PE']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='BR']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='PY']").get(); }
                    break;
                case "PY":
                    if (key=="up") { selectedPath = $("svg path[id='BO']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='BR']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='AR']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='UY']").get(); }
                    break;
                case "AR":
                    if (key=="right") { selectedPath = $("svg path[id='FK']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='CL']").get(); }
                    if (key=="up") { selectedPath = $("svg path[id='PY']").get(); }
                    break;
                case "CL":
                    if (key=="right") { selectedPath = $("svg path[id='AR']").get(); }
                    break;
                case "FK":
                    if (key=="left") { selectedPath = $("svg path[id='AR']").get(); }
                    if (key=="up") { selectedPath = $("svg path[id='UY']").get(); }
                    break;
                case "IS":
                    if (key=="left") { selectedPath = $("svg path[id='GL']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='SJ']").get(); }
                    break;
                case "SJ":
                    if (key=="left") { selectedPath = $("svg path[id='IS']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='RU']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='NO']").get(); }
                    break;
                case "NO":
                    if (key=="down") { selectedPath = $("svg path[id='FI']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='RU']").get(); }
                    if (key=="up") { selectedPath = $("svg path[id='SJ']").get(); }
                    break;
                case "FI":
                    if (key=="right") { selectedPath = $("svg path[id='RU']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='SE']").get(); }
                    if (key=="up") { selectedPath = $("svg path[id='NO']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='EE']").get(); }
                    break;
                case "RU":
                    if (key=="left") { selectedPath = $("svg path[id='FI']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='GE']").get(); }
                    break;
                case "SE":
                    if (key=="left") { selectedPath = $("svg path[id='NO']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='FI']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='DK']").get(); }
                    break;
                case "DK":				
                    if (key=="right") { selectedPath = $("svg path[id='SE']").get(); }
                    if (key=="up") { selectedPath = $("svg path[id='NO']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='DE']").get(); }
                    break;
                case "EE":
                    if (key=="up") { selectedPath = $("svg path[id='FI']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='RU']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='LV']").get(); }
                    break;
                case "LV":
                    if (key=="up") { selectedPath = $("svg path[id='EE']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='RU']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='LT']").get(); }
                    break;
                case "LT":
                    if (key=="up") { selectedPath = $("svg path[id='LV']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='BY']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='PL']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='BY']").get(); }
                    break;
                case "PL":
                    if (key=="down") { selectedPath = $("svg path[id='SK']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='CZ']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='BY']").get(); }
                    break;
                case "BY":
                    if (key=="up") { selectedPath = $("svg path[id='LT']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='UA']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='PL']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='RU']").get(); }
                    break;
                case "UA":
                    if (key=="up") { selectedPath = $("svg path[id='BY']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='TR']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='MD']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='RU']").get(); }
                    break;
                case "MD":
                    // if (key=="up") { selectedPath = $("svg path[id='BY']").get(); }
                    // if (key=="down") { selectedPath = $("svg path[id='TR']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='RO']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='UA']").get(); }
                    break;
                case "RO":
                    if (key=="up") { selectedPath = $("svg path[id='HU']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='BG']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='RS']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='MD']").get(); }
                    break;
                case "RS":
                    if (key=="up") { selectedPath = $("svg path[id='HU']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='XK']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='BA']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='RO']").get(); }
                    break;
                case "BA":
                    // if (key=="up") { selectedPath = $("svg path[id='HU']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='ME']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='HR']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='RS']").get(); }
                    break;
                case "HR":
                    if (key=="up") { selectedPath = $("svg path[id='SI']").get(); }
                    // if (key=="down") { selectedPath = $("svg path[id='BG']").get(); }
                    // if (key=="left") { selectedPath = $("svg path[id='HR']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='BA']").get(); }
                    break;
                case "ME":
                    if (key=="up") { selectedPath = $("svg path[id='BA']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='XK']").get(); }
                    // if (key=="left") { selectedPath = $("svg path[id='HR']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='AL']").get(); }
                    break;
                case "XK":
                    if (key=="up") { selectedPath = $("svg path[id='RS']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='BG']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='ME']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='MK']").get(); }
                    break;
                case "MK":
                    if (key=="up") { selectedPath = $("svg path[id='XK']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='BG']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='AL']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='GR']").get(); }
                    break;
                case "AL":
                    if (key=="up") { selectedPath = $("svg path[id='ME']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='MK']").get(); }
                    // if (key=="left") { selectedPath = $("svg path[id='AL']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='GR']").get(); }
                    break;
                case "GR":
                    if (key=="right") { selectedPath = $("svg path[id='TR']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='AL']").get(); }
                    if (key=="up") { selectedPath = $("svg path[id='MK']").get(); }
                    break;
                case "BG":
                    if (key=="up") { selectedPath = $("svg path[id='RS']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='BG']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='XK']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='TR']").get(); }
                    break;				
                case "TR":
                    if (key=="up") { selectedPath = $("svg path[id='UA']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='SY']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='BG']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='AM']").get(); }
                    break;
                case "CZ":
                    // if (key=="up") { selectedPath = $("svg path[id='HU']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='AT']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='DE']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='PL']").get(); }
                    break;
                case "SK":
                    if (key=="up") { selectedPath = $("svg path[id='PL']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='HU']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='AT']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='UA']").get(); }
                    break;
                case "HU":
                    if (key=="up") { selectedPath = $("svg path[id='SK']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='RS']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='SI']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='RO']").get(); }
                    break;
                case "SI":
                    if (key=="up") { selectedPath = $("svg path[id='AT']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='HR']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='IT']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='HU']").get(); }
                    break;
                case "AT":
                    if (key=="up") { selectedPath = $("svg path[id='CZ']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='SI']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='CH']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='SK']").get(); }
                    break;
                case "DE":
                    if (key=="up") { selectedPath = $("svg path[id='DK']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='CH']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='NL']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='CZ']").get(); }
                    break;
                case "NL":
                    // if (key=="up") { selectedPath = $("svg path[id='CH']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='BE']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='GB']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='DE']").get(); }
                    break;
                case "CH":
                    if (key=="up") { selectedPath = $("svg path[id='DE']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='IT']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='FR']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='AT']").get(); }
                    break;
                case "IT":
                    if (key=="up") { selectedPath = $("svg path[id='CH']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='TN']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='FR']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='SI']").get(); }
                    break;
                case "FR":
                    if (key=="up") { selectedPath = $("svg path[id='GB']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='ES']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='ES']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='CH']").get(); }
                    break;
                case "BE":
                    if (key=="up") { selectedPath = $("svg path[id='NL']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='FR']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='GB']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='DE']").get(); }
                    break;
                case "GB":
                    // if (key=="up") { selectedPath = $("svg path[id='NL']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='FR']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='IE']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='BE']").get(); }
                    break;
                case "IE":
                    // if (key=="up") { selectedPath = $("svg path[id='NL']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='GB']").get(); }
                    // if (key=="left") { selectedPath = $("svg path[id='IE']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='GB']").get(); }
                    break;
                case "ES":
                    if (key=="up") { selectedPath = $("svg path[id='FR']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='MA']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='PT']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='IT']").get(); }
                    break;
                case "PT":
                    //if (key=="up") { selectedPath = $("svg path[id='FR']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='MA']").get(); }
                    // if (key=="left") { selectedPath = $("svg path[id='PT']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='ES']").get(); }
                    break;				
                case "MA":
                    if (key=="up") { selectedPath = $("svg path[id='ES']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='EH']").get(); }
                    // if (key=="left") { selectedPath = $("svg path[id='PT']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='DZ']").get(); }
                    break;
                case "DZ":
                    //if (key=="up") { selectedPath = $("svg path[id='FR']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='ML']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='MA']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='TN']").get(); }
                    break;
                case "TN":
                    if (key=="up") { selectedPath = $("svg path[id='IT']").get(); }
                    // if (key=="down") { selectedPath = $("svg path[id='MA']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='DZ']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='LY']").get(); }				
                    break;
                case "EH":
                    if (key=="up") { selectedPath = $("svg path[id='MA']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='MR']").get(); }
                    // if (key=="left") { selectedPath = $("svg path[id='PT']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='DZ']").get(); }
                    break;
                case "MR":
                    if (key=="up") { selectedPath = $("svg path[id='EH']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='SN']").get(); }
                    // if (key=="left") { selectedPath = $("svg path[id='PT']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='ML']").get(); }
                    break;
                case "SN":
                    if (key=="up") { selectedPath = $("svg path[id='MR']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='GW']").get(); }
                    // if (key=="left") { selectedPath = $("svg path[id='PT']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='ML']").get(); }
                    break;
                case "GW":
                    if (key=="up") { selectedPath = $("svg path[id='SN']").get(); }
                    // if (key=="down") { selectedPath = $("svg path[id='GW']").get(); }
                    // if (key=="left") { selectedPath = $("svg path[id='PT']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='GN']").get(); }
                    break;
                case "GN":
                    if (key=="up") { selectedPath = $("svg path[id='ML']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='SL']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='GW']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='CI']").get(); }
                    break;
                case "SL":
                    if (key=="up") { selectedPath = $("svg path[id='GN']").get(); }
                    // if (key=="down") { selectedPath = $("svg path[id='SL']").get(); }
                    // if (key=="left") { selectedPath = $("svg path[id='GW']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='LR']").get(); }
                    break;
                case "LR":
                    // if (key=="up") { selectedPath = $("svg path[id='ML']").get(); }
                    // if (key=="down") { selectedPath = $("svg path[id='SL']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='CI']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='SL']").get(); }
                    break;
                case "CI":
                    if (key=="up") { selectedPath = $("svg path[id='BF']").get(); }
                    // if (key=="down") { selectedPath = $("svg path[id='SL']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='GH']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='LR']").get(); }
                    break;
                case "ML":
                    if (key=="up") { selectedPath = $("svg path[id='DZ']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='BF']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='NE']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='MR']").get(); }
                    break;
                case "BF":
                    if (key=="up") { selectedPath = $("svg path[id='ML']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='GH']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='NE']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='CI']").get(); }
                    break;
                case "GH":
                    if (key=="up") { selectedPath = $("svg path[id='BF']").get(); }
                    // if (key=="down") { selectedPath = $("svg path[id='GH']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='TG']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='CI']").get(); }
                    break;
                case "TG":
                    if (key=="up") { selectedPath = $("svg path[id='NE']").get(); }
                    // if (key=="down") { selectedPath = $("svg path[id='GH']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='BJ']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='GH']").get(); }
                    break;
                case "BJ":
                    if (key=="up") { selectedPath = $("svg path[id='NE']").get(); }
                    // if (key=="down") { selectedPath = $("svg path[id='GH']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='NG']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='TG']").get(); }
                    break;
                case "NE":
                    if (key=="up") { selectedPath = $("svg path[id='LY']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='NG']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='TD']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='BF']").get(); }
                    break;
                case "NG":
                    if (key=="up") { selectedPath = $("svg path[id='NE']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='CM']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='TD']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='BJ']").get(); }
                    break;
                case "TD":
                    if (key=="up") { selectedPath = $("svg path[id='LY']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='CF']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='SD']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='NG']").get(); }
                    break;
                case "LY":
                    if (key=="up") { selectedPath = $("svg path[id='TN']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='TD']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='EG']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='DZ']").get(); }
                    break;
                case "CM":
                    if (key=="up") { selectedPath = $("svg path[id='TD']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='GQ']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='CF']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='NG']").get(); }
                    break;
                case "GQ":
                    if (key=="up") { selectedPath = $("svg path[id='CM']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='GA']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='GA']").get(); }
                    // if (key=="left") { selectedPath = $("svg path[id='DZ']").get(); }
                    break;
                case "GA":
                    if (key=="up") { selectedPath = $("svg path[id='GQ']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='AO']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='CG']").get(); }
                    // if (key=="left") { selectedPath = $("svg path[id='DZ']").get(); }
                    break;
                case "CG":
                    if (key=="up") { selectedPath = $("svg path[id='CF']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='AO']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='CD']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='GA']").get(); }
                    break;
                case "AO":
                    if (key=="up") { selectedPath = $("svg path[id='CD']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='NA']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='ZM']").get(); }
                    // if (key=="left") { selectedPath = $("svg path[id='GA']").get(); }
                    break;
                case "NA":
                    if (key=="up") { selectedPath = $("svg path[id='AO']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='ZA']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='BW']").get(); }
                    // if (key=="left") { selectedPath = $("svg path[id='GA']").get(); }
                    break;
                case "ZA":
                    if (key=="up") { selectedPath = $("svg path[id='NA']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='LS']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='LS']").get(); }
                    // if (key=="left") { selectedPath = $("svg path[id='GA']").get(); }
                    break;
                case "LS":
                    if (key=="up") { selectedPath = $("svg path[id='ZA']").get(); }
                    // if (key=="down") { selectedPath = $("svg path[id='ZA']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='SZ']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='ZA']").get(); }
                    break;
                case "SZ":
                    if (key=="up") { selectedPath = $("svg path[id='ZW']").get(); }
                    // if (key=="down") { selectedPath = $("svg path[id='ZA']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='MZ']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='LS']").get(); }
                    break;
                case "BW":
                    if (key=="up") { selectedPath = $("svg path[id='ZM']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='ZA']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='ZW']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='NA']").get(); }
                    break;
                case "ZW":
                    if (key=="up") { selectedPath = $("svg path[id='ZM']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='ZA']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='MZ']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='BW']").get(); }
                    break;
                case "MZ":
                    if (key=="up") { selectedPath = $("svg path[id='TZ']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='ZA']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='MG']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='BW']").get(); }
                    break;
                case "ZM":
                    if (key=="up") { selectedPath = $("svg path[id='CD']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='ZW']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='MZ']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='AO']").get(); }
                    break;
                case "CF":
                    if (key=="up") { selectedPath = $("svg path[id='TD']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='CD']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='SS']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='CM']").get(); }
                    break;
                case "CD":
                    if (key=="up") { selectedPath = $("svg path[id='CF']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='ZM']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='BI']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='CG']").get(); }
                    break;
                case "BI":
                    if (key=="up") { selectedPath = $("svg path[id='RW']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='ZM']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='TZ']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='CD']").get(); }
                    break;
                case "RW":
                    if (key=="up") { selectedPath = $("svg path[id='UG']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='BI']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='TZ']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='CD']").get(); }
                    break;
                case "SD":
                    if (key=="up") { selectedPath = $("svg path[id='EG']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='SS']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='ER']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='TD']").get(); }
                    break;
                case "EG":
                    if (key=="up") { selectedPath = $("svg path[id='CY']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='SD']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='IL']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='LY']").get(); }
                    break;
                case "SS":
                    if (key=="up") { selectedPath = $("svg path[id='SD']").get(); }
                    if (key=="down") { selectedPath = $("svg path[id='UG']").get(); }
                    if (key=="right") { selectedPath = $("svg path[id='ET']").get(); }
                    if (key=="left") { selectedPath = $("svg path[id='LY']").get(); }
                    break;
                    /*				 
				case "":
				break;
				case "":
				break;
				case "":
				break;
				case "":
				break;
				case "":
				break;
				case "":
				break;
				case "":
				break;
				case "":
				break;
				case "":
				break;
				case "":
				break;
				case "":
				break;
				case "":
				break;
				case "":
				break; */
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
            /*if (selectedPath != undefined) {
                var country_name = $(selectedPath).prop("id");
                var theURL = "get_country_name.php?country=" + country_name.toLowerCase();
                // var theURL = $(selectedPath).closest("a").prop("href");						    
                // var url = theA.prop("href");
                // console.log("theURL =" + JSON.stringify(theURL) );
                // console.log("theURL =" + theURL );
                window.location = theURL;

            }*/
        }
    });
});