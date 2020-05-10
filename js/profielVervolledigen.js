let loadFile = function(event) {
	let image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
};

//   Code hieronder is om begeleider optie te verbergen als je een eerstejaars bent

let year = document.querySelector("#year");

if(year.value == "1IMD"){
	document.querySelector("#begeleider").setAttribute("disabled", true);
}

year.addEventListener("change", function(){

	if(year.value == "1IMD"){
		document.querySelector("#begeleider").setAttribute("disabled", true);
		document.querySelector("#begeleider").selected = false;
		document.querySelector("#beBuddy").removeAttribute("disabled");
		document.querySelector("#beBuddy").selected = true;
		
	}
	else if(year.value == "3IMD"){
		document.querySelector("#beBuddy").setAttribute("disabled", true);
		document.querySelector("#beBuddy").selected = false;
		document.querySelector("#begeleider").removeAttribute("disabled");
		document.querySelector("#begeleider").selected = true;
	}
	else{
		document.querySelector("#begeleider").removeAttribute("disabled");
		document.querySelector("#beBuddy").removeAttribute("disabled");
	}

});

