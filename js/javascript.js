// Get the HTML elements.
const nav_buttons = document.querySelectorAll(".nav-btn")

const background = document.getElementById("background")

const btn_background = document.getElementById("btn-background")

const intro_pic = document.getElementById("intro-pic")

const intro_name = document.getElementById("intro-name")
 
// change the navbar button's color.
// iterate each elements with the class 'nav-btn', and give them an eventListener.
nav_buttons.forEach(function(element) {
	element.addEventListener(
		'click',
		function() {
			element.style.background = 'dodgerblue'
	})
})

// play or pause the video.
btn_background.addEventListener(
	'click',
	function switchVideo() {
		if (background.paused) {
      background.play()
      btn_background.innerHTML = '<i class="fas fa-pause"></i>'
    } else {
      background.pause()
      btn_background.innerHTML = '<i class="fas fa-play"></i>'
    }
	}
)

// change the homepage picture and name.
intro_pic.addEventListener(
	'mouseover',
	function onmouseover() {
		intro_pic.src = '../assets/images/one-piece-2.jpg'
		intro_name.innerText = '🔥 MONKEY D LUFFY 🔥'
	}
)
intro_pic.addEventListener(
	'mouseout',
	function onmouseout() {
		intro_pic.src = '../assets/images/one-piece.jpg'
		intro_name.innerText = '_RAINHARDER'
	}
)
