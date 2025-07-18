$(document).ready(function() {
	// Get the HTML elements.
	const nav_buttons = $(".nav-btn");
	const background = $("#background");
	const btn_background = $("#btn-background");
	const intro_pic = $("#intro-pic");
	const intro_name = $("#intro-name");
	const closeAlert = $("#closeAlert");
	const alertDiv = $("#alertDiv");

	// Change the navbar button's color.
	nav_buttons.on('click', function() {
		$(this).css('background', 'dodgerblue');
	});

	// Play or pause the background video.
	btn_background.on('click', function() {
		if (background[0].played) {
			background.paused();
			btn_background.html('<i class="fas fa-play"></i>');
		} else {
			background.play();
			btn_background.html('<i class="fas fa-pause"></i>');
		}
	});

	// Change the homepage picture and name.
	intro_pic.on('mouseover', function() {
		intro_pic.attr('src', '../assets/images/one-piece-2.jpg');
		intro_name.text('🔥 MONKEY D LUFFY 🔥');
	}).on('mouseout', function() {
		intro_pic.attr('src', '../assets/images/one-piece.jpg');
		intro_name.text('_RAINHARDER');
	});

	// Close all alerts
	closeAlert.click(function() {
		alertDiv.fadeOut(400, function() {
			$(this).remove();
		});
	});
});
