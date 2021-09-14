$(document).ready(function() {
	$('.slider').slick({
		arrows: true,
		dots: true,
		adaptiveHeight: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		speed: 400,
	});
	$('.slider-gallery').slick({
		arrows: false,
		dots: true,
		adaptiveHeight: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		speed: 400,
		pauseOnFocus: true,
	});
});
