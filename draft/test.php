<?php
if (!isset($_REQUEST['cache'])) {
	require('town.php');
	require('npcs.php');
	require('cars.php');
	require('joel.php');
}
?><!DOCTYPE HTML>
<html lang="en">
<head>
<style>
#loading {
  margin:50px auto;
  position:fixed;
  width:100%;
  height:100%;
  text-align:center;
}

#loading_container {
  position:relative;
  margin:0 auto;
  width:200px;
  height:20px;
  border:1px solid black;
  text-align:center;
  padding-top:10px;
}

#loading_progress {
  width:0%;
  background-color:lightblue;
  position:absolute;
  height:30px;
  top:0px;
  left:0px;
}
</style>
<meta charset="UTF-8" />

<meta name="viewport" content="width=device-width, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"/>
<title>Le plus beau jour de ma vie</title>
<script src="http://cdn.html5quintus.com/v0.2.0/quintus-all.js"></script>
<script src="./phrases.js?t=<?php echo time(); ?>"></script>
<script src="./actions.js?t=<?php echo time(); ?>"></script>
<script src="./objects.js?t=<?php echo time(); ?>"></script>
<script src="./scenes.js?t=<?php echo time(); ?>"></script>
<script src="./testraf.js?t=<?php echo time(); ?>"></script>
<style>
  body { padding:0px; margin:0px; }
</style>
</head>
<body>
<center>
	<div id='loading'>
		<div id='loading_container'>
			Loading...
			<div id='loading_progress'></div>
		</div>
	</div>
</center>
<script>
// Chargement des pnj
var pnj_load = [];
var str_pnj_load;
for (var i=0;i<11;i++) { pnj_load.push('pnj' + (i+1) + '.png'); }
str_pnj_load = pnj_load.join(', ');

var width_div_2;


function getSelectedText(text_array, id) {
	var buffer = '';
	for(var i=0; i< text_array.length; i++) buffer += (i == id ? '[ ' + text_array[i].v + ' ]' : text_array[i].v) + (i == text_array.length-1 ? '' : '\n');
	return buffer;
}

function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}

function BIM(bx, by) {
	var bim = Q.stage(0).insert(
		new Q.Sprite({
			asset:'paf.png',
			x: bx,
			y: by,
			type: Q.SPRITE_NONE,
			z: 9999
		})
	);
	setTimeout(function() {
		bim.destroy();
	},500);
}

window.addEventListener("load",function() {
	var Q = window.Q = Quintus({development: true})
		.include("Sprites, Scenes, Input, 2D, Anim, Touch, UI")
		.include("RafObjects, RafScenes")
		.setup({ maximize: true, upsampleWidth:  420, upsampleHeight:  320});

	Q.input.joypadControls();
	Q.input.keyboardControls();
	Q.input.touchControls({ controls:  [ [],[],[],[],['fire', 'action' ]] });

	// Déplacement simple pour le joueurs
	Q.component("simpleRPGControls", {
		defaults: {
			speed: 100
		},

		added: function() {
			var p = this.entity.p;
			Q._defaults(p,this.defaults);
			this.entity.on("step",this,"step");
			p.direction ='right';
		},

		step: function(dt) {
			var p = this.entity.p;
			if (this.entity.pause) {
				if (p.vx != 0) {
					p.vx += (p.vx < 0 ? 50*dt : -50*dt);
					if (Math.abs(p.vx) < 3) p.vx = 0;
				}
				p.vy = 0;
				return;
			}
			if(Q.inputs['left']) {
				p.vx = -p.speed;
				p.direction = 'left';
			} else if(Q.inputs['right']) {
				p.direction = 'right';
				p.vx = p.speed;
			} else {
				p.vx = 0;
			}

			if(Q.inputs['up']) {
				p.vy = -p.speed;
				p.direction = 'up';
			} else if(Q.inputs['down']) {
				p.direction = 'down';
				p.vy = p.speed;
			} else {
				p.vy = 0;
			}
		}
	});

	// Chargement initial
	Q.load("houses.png, car0.png, car1.png, car2.png, money.png, player.png,time.png, background.png, life.png, paf.png, " + str_pnj_load, function() {

		Q.sheet("player","player.png",{tilew: 16, tileh: 32,  sx: 0, sy: 0});
		Q.animations('player', {
			hit: { frames: [1], rate: 3, next: 'stand', trigger: 'standup'},
			stand: { frames: [0], rate: 10},
			dead: { frames: [2,3], rate: 1/4},
			walk: { frames: [4,5,4,0,7,6,7,0], rate: 1/6},
			walkright: { frames: [8,9,8,11,10,12,10,11], rate: 1/6},
			walkleft: { frames: [17,16,17,14,15,13,15,14], rate: 1/6},
		});
		for (i=1; i<11; i++) {
   			Q.sheet("pnj" + (i),"pnj" + (i) + ".png",{tilew: 16, tileh: 32,  sx: 0, sy: 0});
			Q.animations("pnj" + (i), {
				hit: { frames: [1], rate: 3, next: 'stand', trigger: 'standup'},
				stand: { frames: [0], rate: 10},
				dead: { frames: [2,3], rate: 1/4},
				walkright: { frames: [8,9,8,11,10,12,10,11], rate: 1/6},
				walkleft: { frames: [17,16,17,14,15,13,15,14], rate: 1/6},
			});
		}

		Q.state.reset({money: 13, time: 600, life: 6});
		Q.stageScene("Main",0, {sort: true});
		Q.stageScene("UI",2, {time: 600});
		setInterval(function() {
			Q.state.dec("time",1);
		},1000);

	}, {
		progressCallback: function(loaded,total) {
			var element = document.getElementById("loading_progress");
			element.style.width = Math.floor(loaded/total*100) + "%";
		}
	});
});




</script>
</body>
</html>
