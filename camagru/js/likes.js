function like(like_id, post_id, counter) {
	let likebtn = document.getElementById(likeid);
	ajax = new XMLHttpRequest;
	ajax.open("POST", "http://localhost:8080/camagru/camagru/post", true);
		ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        ajax.onload = function(){
			document.getElementById(counter).innerHTML = ajax.responseText;
		}
		ajax.send("likeData="+postid);
}
