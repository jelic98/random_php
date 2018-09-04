var pathsArray = {}; // = [];

// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["US"] = ["CA", "US", "MX", "BS"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["CA"] = ["CA", "US", "US", "GL"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["GL"] = ["GL", "CA", "IS", "GL"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["MX"] = ["US", "US", "GT", "GT"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["GT"] = ["MX", "MX", "SV", "BZ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["SV"] = ["BZ", "GT", "HN", "HN"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["BZ"] = ["MX", "GT", "SV", "HN"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["HN"] = ["JM", "SV", "NI", "JM"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["NI"] = ["HN", "HN", "CR", "CR"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["CR"] = ["NI", "NI", "PA", "PA"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["PA"] = ["CR", "CR", "CO", "CO"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["CO"] = ["PA", "PA", "EC", "VE"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["EC"] = ["CO", "PA", "PE", "CO"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["PE"] = ["EC", "PE", "BO", "BR"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["VE"] = ["PR", "CO", "BR", "TT"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["TT"] = ["TT", "VE", "TT", "GY"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["GY"] = ["PR", "TT", "BR", "SR"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["SR"] = ["SR", "GY", "BR", "GF"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["GF"] = ["GF", "SR", "BR", "GF"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["BR"] = ["GF", "PE", "UY", "BR"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["UY"] = ["BR", "AR", "FK", "UY"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["JM"] = ["CU", "HN", "JM", "HT"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["CU"] = ["BS", "CU", "JM", "HT"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["HT"] = ["CU", "JM", "CO", "DO"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["DO"] = ["DO", "HT", "DO", "PR"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["PR"] = ["PR", "DO", "VE", "PR"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["BS"] = ["US", "US", "CU", "BR"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["BO"] = ["BO", "PE", "PY", "BR"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["PY"] = ["BO", "AR", "UY", "BR"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["AR"] = ["PY", "CL", "AR", "FK"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["CL"] = ["CL", "CL", "CL", "AR"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["FK"] = ["UY", "AR", "FK", "FK"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["IS"] = ["IS", "GL", "SJ", "IS"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["SJ"] = ["SJ", "IS", "NO", "RU"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["NO"] = ["SJ", "NO", "FI", "RU"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["FI"] = ["NO", "SE", "EE", "RU"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["RU"] = ["RU", "FI", "GE", "RU"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["SE"] = ["SE", "NO", "DK", "FI"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["DK"] = ["NO", "DK", "DE", "SE"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["EE"] = ["FI", "EE", "LV", "RU"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["LV"] = ["EE", "LV", "LT", "RU"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["LT"] = ["LV", "PL", "BY", "BY"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["PL"] = ["PL", "CZ", "SK", "BY"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["BY"] = ["LT", "PL", "UA", "RU"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["UA"] = ["BY", "MD", "TR", "RU"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["MD"] = ["MD", "RO", "MD", "UA"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["RO"] = ["HU", "RS", "BG", "MD"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["RS"] = ["HU", "BA", "XK", "RO"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["BA"] = ["BA", "HR", "ME", "RS"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["HR"] = ["SI", "HR", "HR", "BA"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["ME"] = ["BA", "ME", "AL", "XK"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["XK"] = ["RS", "ME", "MK", "BG"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["MK"] = ["XK", "AL", "GR", "BG"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["AL"] = ["ME", "AL", "GR", "MK"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["GR"] = ["MK", "AL", "GR", "TR"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["BG"] = ["RS", "XK", "TR", "BG"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["TR"] = ["UA", "BG", "SY", "AM"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["CZ"] = ["CZ", "DE", "AT", "PL"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["SK"] = ["PL", "AT", "HU", "UA"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["HU"] = ["SK", "SI", "RS", "RO"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["SI"] = ["AT", "IT", "HR", "HU"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["AT"] = ["CZ", "CH", "SI", "SK"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["DE"] = ["DK", "LU", "CH", "CZ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["LU"] = ["NL", "BE", "FR", "DE"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["NL"] = ["NL", "GB", "BE", "DE"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["CH"] = ["DE", "FR", "IT", "AT"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["IT"] = ["CH", "FR", "TN", "SI"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["FR"] = ["GB", "ES", "ES", "CH"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["BE"] = ["NL", "GB", "FR", "LU"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["GB"] = ["GB", "IE", "FR", "BE"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["IE"] = ["IE", "IE", "GB", "GB"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["ES"] = ["FR", "PT", "MA", "IT"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["PT"] = ["PT", "PT", "MA", "ES"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["MA"] = ["ES", "MA", "EH", "DZ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["DZ"] = ["DZ", "MA", "ML", "TN"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["TN"] = ["IT", "DZ", "TN", "LY"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["EH"] = ["MA", "EH", "MR", "DZ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["MR"] = ["EH", "MR", "SN", "ML"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["SN"] = ["MR", "GM", "GM", "ML"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["GW"] = ["GM", "GW", "GW", "GN"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["GM"] = ["SN", "GM", "GW", "SN"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["GN"] = ["ML", "GW", "SL", "CI"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["SL"] = ["GN", "SL", "SL", "LR"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["LR"] = ["LR", "SL", "LR", "CI"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["CI"] = ["BF", "LR", "CI", "GH"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["ML"] = ["DZ", "MR", "BF", "NE"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["BF"] = ["ML", "CI", "GH", "NE"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["GH"] = ["BF", "CI", "GH", "TG"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["TG"] = ["NE", "GH", "TG", "BJ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["BJ"] = ["NE", "TG", "BJ", "NG"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["NE"] = ["LY", "BF", "NG", "TD"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["NG"] = ["NE", "BJ", "CM", "TD"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["TD"] = ["LY", "NG", "CF", "SD"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["LY"] = ["TN", "DZ", "TD", "EG"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["CM"] = ["TD", "NG", "GQ", "CF"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["GQ"] = ["CM", "GQ", "GA", "GA"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["GA"] = ["GQ", "GA", "AO", "CG"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["CG"] = ["CF", "GA", "AO", "CD"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["AO"] = ["CD", "AO", "NA", "ZM"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["NA"] = ["AO", "NA", "ZA", "BW"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["ZA"] = ["NA", "ZA", "LS", "LS"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["LS"] = ["ZA", "ZA", "LS", "SZ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["SZ"] = ["ZW", "LS", "SZ", "MZ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["BW"] = ["ZM", "NA", "ZA", "ZW"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["ZW"] = ["ZM", "BW", "ZA", "MZ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["MZ"] = ["TZ", "ZW", "ZA", "MG"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["ZM"] = ["CD", "AO", "ZW", "MW"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["MW"] = ["TZ", "ZM", "MZ", "MW"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["CF"] = ["TD", "CM", "CD", "SS"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["CD"] = ["CF", "CG", "ZM", "BI"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["BI"] = ["RW", "CD", "ZM", "TZ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["RW"] = ["UG", "CD", "BI", "TZ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["SD"] = ["EG", "TD", "SS", "ER"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["EG"] = ["CY", "LY", "SD", "IL"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["SS"] = ["SD", "CF", "UG", "ET"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["GE"] = ["RU", "TR", "AM", "AZ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["AM"] = ["GE", "TR", "IR", "AZ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["AZ"] = ["GE", "AM", "IR", "AZ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["IR"] = ["AZ", "IQ", "PK", "AF"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["IQ"] = ["TR", "SY", "SA", "IR"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["SY"] = ["TR", "LB", "JO", "IQ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["LB"] = ["TR", "CY", "IL", "SY"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["CY"] = ["TR", "GR", "IL", "LB"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["JO"] = ["SY", "PS", "SA", "IQ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["PS"] = ["PS", "IL", "PS", "JO"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["SA"] = ["JO", "EG", "YE", "QA"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["QA"] = ["IR", "KW", "SA", "AE"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["AE"] = ["IR", "QA", "SA", "OM"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["OM"] = ["AE", "YE", "OM", "PK"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["YE"] = ["SA", "ER", "SO", "OM"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["KW"] = ["IR", "IQ", "SA", "QA"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["AF"] = ["TM", "IR", "PK", "TJ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["TM"] = ["UZ", "KZ", "AF", "UZ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["TJ"] = ["KG", "UZ", "PK", "CN"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["KG"] = ["KZ", "UZ", "TJ", "CN"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["KZ"] = ["RU", "KZ", "KG", "MN"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["UZ"] = ["KZ", "TM", "TJ", "KG"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["PK"] = ["AF", "IR", "IN", "IN"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["IN"] = ["NP", "PK", "LK", "BD"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["NP"] = ["CN", "IN", "BD", "BT"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["LK"] = ["IN", "IN", "IN", "IN"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["BT"] = ["CN", "NP", "BD", "MM"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["BD"] = ["BT", "IN", "BD", "MM"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["MM"] = ["MM", "BD", "MY", "TH"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["TH"] = ["LA", "MM", "MY", "VN"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["LA"] = ["MM", "TH", "KH", "VN"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["KH"] = ["LA", "TH", "MY", "VN"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["MY"] = ["TH", "TH", "ID", "BN"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["BN"] = ["PH", "MY", "MY", "PH"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["ID"] = ["MY", "MY", "TL", "PG"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["TL"] = ["ID", "ID", "AU", "AU"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["AU"] = ["TL", "TF", "AU", "NZ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["NZ"] = ["FJ", "AU", "NZ", "NZ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["FJ"] = ["VU", "VU", "NZ", "NZ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["PG"] = ["JP", "ID", "AU", "SB"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["SB"] = ["SB", "PG", "NC", "VU"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["VU"] = ["VU", "SB", "NC", "FJ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["NC"] = ["VU", "NC", "NZ", "FJ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["PH"] = ["TW", "BN", "ID", "PH"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["TW"] = ["KR", "CN", "PH", "JP"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["CN"] = ["MN", "TJ", "LA", "KP"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["KP"] = ["CN", "CN", "KR", "KR"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["KR"] = ["KP", "KP", "JP", "JP"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["JP"] = ["KR", "KR", "JP", "JP"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["MN"] = ["RU", "KZ", "CN", "CN"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["VN"] = ["CN", "KH", "ID", "VN"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["IL"] = ["LB", "EG", "IL", "PS"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["ER"] = ["SA", "SD", "ET", "YE"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["ET"] = ["ER", "SS", "KE", "DJ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["DJ"] = ["ER", "ET", "ET", "SO"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["SO"] = ["SO", "DJ", "SO", "SO"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["KE"] = ["ET", "UG", "TZ", "SO"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["UG"] = ["SS", "CD", "RW", "KE"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["RW"] = ["UG", "CD", "BI", "TZ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["BI"] = ["RW", "CD", "ZM", "TZ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["TZ"] = ["KE", "BI", "MZ", "TZ"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["MG"] = ["MG", "MZ", "MG", "TF"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray["TF"] = ["TF", "MG", "TF", "AU"];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];
// Syntax is UP, LEFT, DOWN, RIGHT
pathsArray[""] = ["", "", "", ""];

// console.log("Debug:// PathsArray Length: " + pathsArray.length);
