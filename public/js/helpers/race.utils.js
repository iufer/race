define(['race'], function(Race){

	Race.makeURLFriendly = function(str){
		return str.toLowerCase() // change everything to lowercase
			.replace(/^\s+|\s+$/g, "") // trim leading and trailing spaces		
			.replace(/[_|\s]+/g, "-") // change all spaces and underscores to a hyphen
			.replace(/[^a-z0-9-]+/g, "") // remove all non-alphanumeric characters except the hyphen
			.replace(/[-]+/g, "-") // replace multiple instances of the hyphen with a single instance
			.replace(/^-+|-+$/g, "")
			.substring(0, 127); // chop to 128 chars
	};

});