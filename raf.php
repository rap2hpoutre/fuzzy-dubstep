<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8" />

<meta name="viewport" content="width=device-width, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"/>
<title>CV</title>
<script src="http://cdn.html5quintus.com/v0.1.6/quintus-all.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
window.addEventListener("load",function() {
	var Q = window.Q = Quintus({development: true}).include("Sprites, Scenes, Input, 2D, Anim, Touch, UI").setup("myGame");
/*
	Q.input.joypadControls();
	Q.input.keyboardControls();
	Q.input.touchControls();

*/

	Q.scene("Main",function(stage) {
		// stage.insert(new Q.Repeater({ asset: "background.png", speedX: 0, speedY: 0 }));
		stage.insert(new Q.Ptf({x: 50, y: 180})).setPoints();
	});