var IntroductionPanel = function () {
	$('.introductionclose').click( function(){
		$('.introduction').addClass('no-display');
		$('.reservation').removeClass('no-display');
	});
    return {
        //main function to initiate template pages
        init: function () {
        }
    };
}();