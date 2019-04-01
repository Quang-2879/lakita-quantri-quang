var Lock = function () {

    return {
        //main function to initiate the module
        init: function () {

             $.backstretch([
		        "styles/assets/img/bg/1.jpg",
		        "styles/assets/img/bg/2.jpg",
		        "styles/assets/img/bg/3.jpg",
		        "styles/assets/img/bg/4.jpg"
		        ], {
		          fade: 1000,
		          duration: 8000
		      });
        }

    };

}();