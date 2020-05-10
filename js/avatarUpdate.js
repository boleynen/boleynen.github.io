let loadFile = function(event) {
	let image = document.getElementById('output');
    image.src = URL.createObjectURL(event.target.files[0]);
    let oldAvatar = document.querySelector("#oldAvatar");
    oldAvatar.style.display = "none";
};