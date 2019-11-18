//global vars

let width = 500,
	height = 0,
	filter = "none",
	streaming = false;

// DOM elements

var imgFilter;

const video = document.getElementById("video");
const canvas = document.getElementById("canvas");
const stickercan = document.getElementById("sticker");
//const photos = document.getElementById("photos");
const photoButton = document.getElementById("photo-button");
const clearButton = document.getElementById("clear-button");
const photoFilter = document.getElementById("photo-filter");

const savebtn = document.querySelector("#photo-save");
savebtn.disabled = true;

const photobtn = document.querySelector("#photo-button");
photobtn.disabled = true;

//get media stream
navigator.mediaDevices
	.getUserMedia({
		video: true,
		audio: false
	})
	.then(function(stream) {
		//link to video source
		video.srcObject = stream;

		//play video
		video.play();
	})
	.catch(function(err) {
		console.log(`Error: ${err}`);
	});

//play when ready
video.addEventListener(
	"canplay",
	function(e) {
		if (!streaming) {
			//set video canvas height
			height = video.videoHeight / (video.videoWidth / width);

			video.setAttribute("min-width", width);
			video.setAttribute("min-height", height);
			canvas.setAttribute("min-width", width);
			canvas.setAttribute("min-height", height);
			resizecanvas(video);

			streaming = true;
			photobtn.disabled = false;
		}
	},
	false
);

//photo button event
photoButton.addEventListener(
	"click",
	function(e) {
		takePicture();
		savebtn.disabled = false;
		e.preventDefault();
	},
	false
);

//filter event
photoFilter.addEventListener("change", function(e) {
	//set filter to chosen option
	filter = e.target.value;
	//set filter to video
	video.style.filter = filter;

	e.preventDefault();
});

//clear event
clearButton.addEventListener("click", function(e) {
	//clear photos
	// photos.innerHTML = "";

	//change filter to none
	filter = "none";
	//set video filter
	video.style.filter = filter;
	//reset select list
	photoFilter.selectedIndex = 0;

	canvas.style.display = "none";
	stickercan.style.display = "none";
});

//take pic from canvas
function takePicture() {
	//create canvas
	const context = canvas.getContext("2d");
	if (width && height) {
		//set canvas props
		canvas.width = width;
		canvas.height = height;
	}
	//flips the image before drawing
	context.setTransform(-1, 0, 0, 1, canvas.width, 0);

	//draw an image of the video on the canvas
	context.drawImage(video, 0, 0, width, height);

	//create image from the canvas
	const imgUrl = canvas.toDataURL("image/png");

	//create img element
	const img = document.createElement("img");

	//set img src
	img.setAttribute("src", imgUrl);
	img.setAttribute("class", "thumbnail");
	img.setAttribute("style", "margin: 10px auto;");

	imgFilter = filter;

	img.style.filter = filter;
	canvas.style.filter = filter;

	//make canvas visible
	canvas.style.display = "block";
	canvas.setAttribute("class", "thumbnail");
	//canvas.setAttribute("height", "375");

	//add image to photos
	//photos.appendChild(img);
}

function vidOff() {
	video.src = "";
	video.srcObject.getTracks()[0].stop();

	navigator.mediaDevices
		.getUserMedia({
			video: true,
			audio: false
		})
		.then(function(stream) {
			//link to video source
			video.srcObject = stream;
			localstream = stream;
			//play video
			video.play();
		})
		.catch(function(err) {
			console.log(`Error: ${err}`);
		});
}

function vidOn() {
	navigator.mediaDevices
		.getUserMedia({
			video: true,
			audio: true
		})
		.then(function(stream) {
			//link to video source
			video.srcObject = stream;
			localstream = stream;
			//play video
			video.play();
		})
		.catch(function(err) {
			console.log(`Error: ${err}`);
		});
}

document.getElementById("photo-save").addEventListener("click", function() {
	const imgUrl = canvas.toDataURL("image/png");
	const stickUrl = stickercan.toDataURL("image/png");

	var ajax = new XMLHttpRequest();
	ajax.open("POST", "/camagru/camagru/upload/submit", true);
	ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajax.onload = function() {
		if (ajax.status === 200) location.replace("/camagru/camagru/");
		else if (ajax.status === 400) console.log("oh shit");
	};
	ajax.send("img=" + imgUrl + "&filter=" + imgFilter + "&sticker=" + stickUrl);
});

var upload = document.getElementById("upload");

upload.addEventListener("change", e => {
	if (upload.files.length > 0 && upload.files[0].type.match(/image\/*/)) {
		savebtn.disabled = false;
		var image = new Image();
		var context = canvas.getContext("2d");
		image.onload = () => {
			if (image.width <= 500 && image.height <= 500) {
				canvas.width = image.width;
				canvas.height = image.height;
				canvas.style.display = "block";
				context.drawImage(image, 0, 0);
			} else {
				canvas.width = 500;
				canvas.height = 375;
				canvas.style.display = "block";
				context.drawImage(image, 0, 0);
			}
		};
		image.src = URL.createObjectURL(upload.files[0]);
	}
});

function addSticker(sticker) {
	const ctx = stickercan.getContext("2d");

	stickercan.width = width;
	stickercan.height = height;

	dImg = new Image();
	dImg.src = "imgs/stickers/" + sticker;
	ctx.drawImage(dImg, 0, 0, width, height);
}

// function addSticker(sticker) {
// 	var context = stickercan.getContext("2d");
// 	console.log(stickercan.height);
// 	context.drawImage(
// 		sticker,
// 		sticker.width / 2,
// 		sticker.height / 2,
// 		stickercan.width * 4,
// 		stickercan.height * 4,
// 		sticker.width / 2,
// 		sticker.height / 2,
// 		stickercan.width,
// 		stickercan.height
// 	);
// 	console.log(stickercan);
// }

function resizecanvas(size) {
	let w = size.offsetWidth;
	let h = size.offsetHeight;
	stickercan.width = w;
	stickercan.height = h;
}
