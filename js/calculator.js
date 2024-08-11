// Get HTML Elements.
const first_num = document.getElementById('first-num')
const second_num = document.getElementById('second-num')
const add = document.getElementById('add')
const substract = document.getElementById('substract')
const multiply = document.getElementById('multiply')
const divide = document.getElementById('divide')
const modulo = document.getElementById('modulo')
let result = document.getElementById('result')


// Add event listeners to the elements.
add.addEventListener(
 	'click',
 	function addition() {
		result.value = Number(first_num.value) + Number(second_num.value)
		console.log(result.value)
	}
)

substract.addEventListener(
 	'click',
 	function substraction() {
		result.value = Number(first_num.value) - Number(second_num.value)
		console.log(result.value)
	}
)

multiply.addEventListener(
 	'click',
 	function multiplication() {
		result.value = Number(first_num.value) * Number(second_num.value)
		console.log(result.value)
	}
)

divide.addEventListener(
 	'click',
 	function division() {
		result.value = Number(first_num.value) / Number(second_num.value)
		console.log(result.value)
	}
)

modulo.addEventListener(
 	'click',
 	function modular() {
		result.value = Number(first_num.value) % Number(second_num.value)
		console.log(result.value)
	}
)
