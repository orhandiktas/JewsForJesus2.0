<?php

require_once('apiCallFML.php');

function keywordSearch($inputtedSearch) {

	$states = ["Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Carolina", "North Dakota", "Ohio", "Oklahoma", "Oregon", "Pennsylvania Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming"];


	$abbreviations = ["AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "FL", "GA", "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY", "AS", "DC", "FM", "GU", "MH", "MP", "PW", "PR", "VI", "AE", "AA", "AE", "AE", "AE"];

	$cities = ["Acmar", "Adamsville", "Adger", "Keystone", "New Site", "Alpine", "Arab", "Baileyton", "Bessemer", "Hueytown", "Blountsville", "Bremen", "Brent", "Brierfield", "Calera", "Centreville", "Chelsea", "Coosa Pines", "Clanton", "Cleveland", "Columbiana", "Crane Hill", "Cropwell", "Cullman", "Dolomite", "Dora", "Empire", "Fairfield", "Coalburg", "Gardendale", "Goodwater", "Alden", "Hanceville", "Harpersville", "Hayden", "Helena", "Holly Pond", "Jemison", "Joppa", "Kellyton", "Kimberly", "Leeds", "Lincoln", "Logan", "Mc Calla", "Maylene", "Montevallo", "Morris", "Mount Olive", "Sylvan Springs", "Odenville", "Oneonta", "Indian Springs", "Pell City", "Dixiana", "Pleasant Grove", "Quinton", "Ragland", "Remlap", "Riverside", "Rockford", "Shelby", "Springville", "Sterrett", "Sumiton", "Sylacauga", "Talladega", "Thorsby", "Trafford", "Trussville", "Union Grove", "Vandiver", "Vincent", "Vinemont", "Warrior", "Weogufka", "West Blocton", "Wilsonville", "Woodstock", "Birmingham", "Homewood", "Irondale", "Crestline Height", "Center Point", "Vestavia Hills", "Mountain Brook", "Bluff Park", "Midfield", "Shoal Creek", "Cahaba Heights", "Hoover", "Tuscaloosa", "Holt", "Stewart", "Aliceville", "Boligee", "Brookwood", "Buhl", "Carrollton", "Coker", "Cottondale", "Duncanville", "Echola", "Elrod", "Emelle", "Epes", "Ethelsville", "Eutaw", "Fosters", "Gainesville", "Gordo", "Knoxville", "Coatopa", "Cypress", "Northport", "Ralph", "Reform", "Vance", "Jasper", "Addison", "Arley", "Bankston", "Bear Creek", "Beaverton", "Berry","Cuthbert", "Damascus", "Graves", "De Soto", "Doerun", "Donalsonville", "Edison", "Enigma", "Fitzgerald", "Fort Gaines", "Hartsfield", "Iron City", "Irwinville", "Jakin", "Leary", "Meigs", "Morgan", "Springvale", "Moultrie", "Norman Park", "Oakfield", "Ochlocknee", "Ocilla", "Omega", "Parrott", "Pavo", "Pelham", "Plains", "Poulan", "Rebecca", "Sale City", "Shellman", "Sumner", "Sycamore", "Sylvester", "Abac", "Ty Ty", "Warwick", "Whigham", "Wray", "Juniper", "Tazewell", "Cataula", "Ellaville", "Ellerslie", "Fortson", "Lumpkin", "Midland", "Pine Mountain", "Pine Mountain Va", "Richland", "Shiloh", "Talbotton", "Upatoi", "Waverly Hall", "Custer Terrace", "Aiea", "Captain Cook", "Eleele", "Ewa Beach", "Kapolei", "Haiku", "Hakalau", "Haleiwa", "Hana", "Hanapepe", "Hauula", "Hawaii National", "Hawi", "Hilo", "Princeville", "Holualoa", "Honaunau", "Honokaa", "Honomu", "Hoolehua", "Kaaawa", "Kahului", "Kailua", "Kailua Kona", "Kalaupapa", "Kamuela", "Kaneohe", "Kapaa", "Kaumakani", "Kaunakakai", "Keaau", "Kealakekua", "Kekaha", "Kihei", "Kapaau", "Koloa", "Kualapuu", "Kurtistown", "Lahaina", "Laie", "Lanai City", "Laupahoehoe", "Lihue", "Makawao", "Makaweli", "Maunaloa", "Naalehu", "Ninole", "Ookala", "Paauhau", "Paauilo", "Pahala", "Pahoa", "Paia", "Papaaloa", "Papaikou", "Pearl City", "Pepeekeo", "Wahiawa", "Mililani", "Kula", "Waialua", "Waianae", "Wailuku", "Waimanalo", "Waimea", "Waipahu", "Honolulu", "Pocatello", "Chubbuck", "Fort Hall", "American Falls", "Arbon", "Arco", "Arimo", "Bancroft", "Bern", "Blackfoot", "Challis", "Conda", "Darlington", "Dayton", "Ellis", "Firth", "Grace", "Inkom", "Lava Hot Springs", "Mc Cammon", "Mackay", "Malad City", "Montpelier", "Moore", "Pingree", "Rockland", "Shelley", "Stanley", "Stone", "Wayan", "Fish Haven", "Twin Falls", "Rogerson", "Bellevue", "Bliss", "Burley", "Carey", "Castleford", "Corral", "Declo", "San Francisco"];

	$zipcodes = ["35004", "35005", "35006", "35007", "35010", "35014", "35016", "35019", "35020", "35023", "35031", "35033", "35034", "35035", "35040", "35042", "35043", "35044", "35045", "35049", "35051", "35053", "35054", "35055", "35061", "35062", "35063", "35064", "35068", "35071", "35072", "35073", "35077", "35078", "35079", "35080", "35083", "35085", "35087", "35089", "35091", "35094", "35096", "35098", "35111", "35114", "35115", "35116", "35117", "35118", "35120", "35121", "35124", "35125", "35126", "35127", "35130", "35131", "35133", "35135", "35136", "35143", "35146", "35147", "35148", "35150", "35160", "35171", "35172", "35173", "35175", "35176", "35178", "35179", "35180", "35183", "35184", "35186", "35188", "35203", "35204", "35205", "35206", "35207", "35208", "35209", "35210", "35211", "35212", "35213", "35214", "35215", "35216", "35217", "35218", "35221", "35222", "35223", "35224", "35226", "35228", "35233", "35234", "35235", "35242", "35243", "35244", "35401", "35404", "35405", "35406", "35441", "35442", "35443", "35444", "35446", "35447", "35452", "35453", "35456", "35457", "35458", "35459", "35460", "35461", "35462", "35463", "35464", "35466", "35469", "35470", "35474", "35476", "35480", "35481", "35490", "35501", "35540", "35541", "35542", "35543", "35544", "35546", "35548", "35549", "35550", "35552", "35553", "35554", "35555", "35563", "35564", "35565", "35570", "35571", "35572", "35574", "35575", "35576", "35578", "35579", "35580", "35581", "35582", "35585", "35586", "35587", "35592", "35593", "35594", "35601", "35603", "35610", "35611", "35616", "35618", "35619", "35620", "35621", "35622", "35630", "35633", "35640", "35643", "35645", "35646", "35647", "35648", "35650", "35651", "35652", "35653", "35660", "35661", "35670", "35671", "35672", "35673", "35674", "35677", "35739", "35740", "35741", "35744", "35745", "35746", "35747", "35748", "35749", "35750", "35751", "35752", "35754", "35755", "35758", "35759", "35760", "35761", "35763", "35764", "35765", "35766", "35768", "35771", "35772", "35773", "35774", "35775", "35776", "35801", "35802", "35803", "35805", "35806", "35808", "35810", "35811", "35816", "35824", "35901", "35903", "35904", "35905", "35950", "35952", "35953", "35954", "35957", "35958", "35959", "35960", "35961", "35962", "35963", "35966", "35967", "35971", "35972", "35973", "35974", "35975", "35976", "35978", "35979", "35980", "35981", "35983", "35984", "35986", "35987", "35988", "35989", "36003", "36004", "36005", "36006", "36009", "36010", "36013", "36016", "36017", "36022", "36024", "36025", "36026", "36027", "36028", "36029", "36030", "36031", "36032", "36033", "36034", "36035", "36036", "36037", "36038", "36039", "36040", "36041", "36042", "36043", "36046", "36047", "36048", "36049", "36051", "36052", "36053", "36054", "36061", "36064", "36066", "36067", "36069", "36071", "36075", "36078", "36080", "36081", "36083", "36088", "36089", "36091", "36092", "36104", "36105", "36106", "36107", "36108", "36109", "36110", "36111", "36113", "36115", "36116", "36117", "36201", "36203", "36205", "36206", "36250", "36251", "36255", "36256", "36258", "36260", "36262", "36263", "36264", "36265", "36266", "36267", "36268", "36269", "36270", "36271", "36272", "36273", "36274", "36276", "36277", "36278", "36279", "36280", "36301", "36303", "36310", "36311", "36312", "36314", "36316", "36317", "36318", "36319", "36320", "36322", "36323", "36330", "36340", "36343", "36344", "36345", "36346", "36349", "36350", "36351", "36352", "36353", "36360", "36362", "36370", "36373", "36374", "36375", "36376", "36401", "36419", "36420", "36425", "36426", "36432", "36435", "36436", "36441", "36442", "36444", "36445", "36446", "36451", "36453", "36454", "36456", "36460", "36467", "36471", "36473", "36474", "36475", "36477", "36480", "36481", "36482", "36483", "36502", "36505", "36507", "36509", "36510", "36511", "36515", "36518", "36521", "36522", "36523", "36524", "36525", "36526", "36527", "36528", "36529", "36530", "36532", "36535", "36538", "36539", "36540", "36541", "36542", "36544", "36545", "36548", "36549", "36550", "36551", "36553", "36555", "36558", "36560", "36561", "36562", "36567", "36569", "36570", "36571", "36572", "36574", "36575", "36576", "36579", "36580", "36582", "36583", "36584", "36585", "36586", "36587", "36602", "36603", "36604", "36605", "36606", "36607", "36608", "36609", "36610", "36611", "36612", "36613", "36615", "36617", "36618", "36619", "36693", "36695", "36701", "36703", "36720", "36722", "36726", "36727", "36728", "36732", "36736", "36738", "36740", "36742", "36744", "36748", "36749", "36750", "36751", "36752", "36754", "36756", "36758", "36759", "36761", "36762", "36765", "36767", "36768", "36769", "36771", "36773", "36775", "36776", "36779", "36782", "36783", "36784", "36785", "36786", "36790", "36792", "36793", "36801", "36830", "36850", "36852", "36853", "36854", "36855", "36858", "36860", "36861", "36862", "36863", "36866", "36867", "36869", "36871", "36874", "36875", "36877", "36879", "36904", "36907", "36908", "36910", "36912", "36915", "36916", "36919", "36921", "36922", "36925", "98791", "99501", "99502", "99503", "99504", "99505", "99506", "99507", "99508", "99515", "99516", "99517", "99518", "99549", "99551", "99552", "99553", "99554", "99555", "99556", "99557", "99558", "99559", "99561", "99563", "99564", "99565", "99567", "99568", "99569", "99571", "99572", "99573", "99574", "99575", "99576", "99577", "99578", "99579", "99580", "99581", "99583", "99585", "99586", "99588", "99589", "99590", "99591", "99602", "99603", "99604", "99606", "99607", "99610", "99611", "99612", "99613", "99614", "99615", "99620", "99621", "99622", "99625", "99626", "99627", "99628", "99630", "99631", "99632", "99633", "99634", "99636", "99638", "99639", "99640", "99645", "99647", "99648", "99649", "99650", "99651", "99653", "99654", "99655", "99656", "99657", "99658", "99659", "99660", "99661", "99662", "99664", "99665", "99668", "99669", "99670", "99671", "99672", "99676", "99679", "99681", "99682", "99683", "99684", "99685", "99686", "99687", "99688", "99689", "99691", "99692", "99701", "99702", "99703", "99704", "99705", "99709", "99712", "99714", "99720", "99721", "99722", "99723", "99724", "99726", "99727", "99729", "99730", "99733", "99734", "99736", "99737", "99739", "99740", "99741", "99742", "99743", "99744", "99745", "99746", "99747", "99748", "99749", "99750", "99751", "99752", "99753", "99755", "99756", "99757", "99758", "99759", "99760", "99761", "99762", "99763", "99765", "99766", "99767", "99768", "99769", "99770", "99771", "99772", "99773", "99774", "99777", "99778", "99780", "99781", "99782", "99783", "99784", "99785", "99786", "99788", "99789", "99801", "99820", "99824", "99826", "99827", "99829", "99833", "99835", "99840", "99901", "99919", "99921", "99922", "99923", "99925", "99926", "99927", "99929", "99950", "85003", "85004", "85006", "85007", "85008", "85009", "85012", "85013", "85014", "85015", "85016", "85017", "85018", "85019", "85020", "85021", "85022", "85023", "85024", "85027", "85028", "85029", "85031", "85032", "85033", "85034", "85035", "85037", "85039", "85040", "85041", "85043", "85044", "85051", "85201", "85202", "85203", "85204", "85205", "85206", "85207", "85208", "85210", "85213", "85219", "85220", "85222", "85224", "85225", "85226", "85228", "85231", "85232", "85234", "85236", "85237", "85239", "85240", "85242", "85247", "85248", "85249", "85250", "85251", "85253", "85254", "85255", "85256", "85257", "85258", "85259", "85260", "85262", "85264", "85268", "85272"];


	$results = [];
	$javascriptSearchString = '';
	$cities_results = individualKeywordSearch($cities, $inputtedSearch);
	$abbreviations_results = individualKeywordSearch($abbreviations, $inputtedSearch);
	$states_results = individualKeywordSearch($states, $inputtedSearch);
	$zipcodes_results = individualKeywordSearch($zipcodes, $inputtedSearch);

	foreach ($cities_results as $city) {
		$javascriptSearchString = $javascriptSearchString . "shortcodeSearchResults = shortcodeSearchResults + shortcodeSearch(\"city\", \"" . $city . "\");";
	}

	foreach ($abbreviations_results as $state) {
		$javascriptSearchString = $javascriptSearchString . "shortcodeSearchResults = shortcodeSearchResults + shortcodeSearch(\"state\", \"" . $state . "\");";
	}

	foreach ($states_results as $state) {
		$javascriptSearchString = $javascriptSearchString . "shortcodeSearchResults = shortcodeSearchResults + shortcodeSearch(\"state\", \"" . $state . "\");";
	}

	foreach ($zipcodes_results as $zipcode) {
		$javascriptSearchString = $javascriptSearchString . "shortcodeSearchResults = shortcodeSearchResults + shortcodeSearch(\"zipcode\", \"" . $zipcode . "\");";
	}
	
	echo '<script type="text/javascript">
	$( document ).ready(function() {
		function eventLoop(eventArray) {
			var currentEvents = ""
			for (var i = 0; i < eventArray.length; i++) {
				currentEvents = currentEvents + eventArray[i] + "<br>"
			}
			return currentEvents;
		}
		function makeAddressUrlFriendly(address1, address2, address3) {
			return "http://maps.google.com/?q=" + address1 + " " + address2 + " " + address3
		}

		function displayData(x) {
    	$("#speaker-container").append("<h3>Nearby events:</h3>");
        x.success(function(realData) {
            for (var i = 0; i < realData.length; i++) {
            $("#speaker-container").append("<br>" + 
            eventLoop(getMeetingTimes(realData[i].Values.v[19], realData[i].Values.v[3])) +
            "<a href=\"" + makeAddressUrlFriendly(realData[i].Values.v[12], realData[i].Values.v[13], realData[i].Values.v[14]) + "\">" + realData[i].Values.v[6] + "</a>" + 
            "<br>" + 
            realData[i].Values.v[3] +
            "<br>_______________");
            }
        });
    }

    var promise = shortcodeSearch("city", "San Francisco");

    displayData(promise); 
	});
</script>';

	// checks to see if any of the cities or states or abbreviations are included in the search string
	// and if so then make the relevant shortcode search 
}

function searchAggregate($results) {
	//gets called inside of probably keywordSearch 
	//checks to see if any of the events already exist and gets rid of duplicates
}

function individualKeywordSearch($sample_dictionary, $sample_query) {
	$matches = [];
	foreach ($sample_dictionary as $value) {
		if(strpos($sample_query, $value) !== false) {
			array_push($matches, $value);
		}
	}
	return $matches;
}
