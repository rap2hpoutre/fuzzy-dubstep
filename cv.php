<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8" />

<meta name="viewport" content="width=device-width, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"/>
<title>CV</title>
<script src="http://cdn.html5quintus.com/v0.1.6/quintus-all.js"></script>
<script>
window.addEventListener("load",function() {
	var Q = window.Q = Quintus({development: true}).include("Sprites, Scenes, Input, 2D, Anim, Touch, UI").setup("myGame");


	// Q.input.joypadControls();
	Q.input.keyboardControls();
	// Q.input.touchControls({ controls:  [ [],[],[],[],[] ] });



	Q.Sprite.extend("Player",{
		init: function(p) {
			this._super(p, {sprite: "player", sheet: "player", x: 410, y: 90, speed: 150 });
			this.add('2d, animation, platformerControls');
			this.play('stand');


			/*
			this.on("hit.sprite",function(collision) {
				if(collision.obj.isA("Tower")) {
					Q.stageScene("endGame",1, { label: "You Won!" });
					this.destroy();
				}
			});
			*/
		},
		step: function(dt) {
			if (this.p.y > 300) {
				this.p.x = 20;
				this.p.y = 160;
				this.p.vy = 0;
				this.p.vx = 0;

			}
			if (this.p.vx < 0) this.play('walkleft');
			else if (this.p.vx > 0) this.play('walkright');
			else {
				this.play('stand');
				// this.p.x = Math.floor(this.p.x);
				// this.p.y = Math.floor(this.p.y);
			}
		}
	});

	Q.Sprite.extend("Ptf",{
		init: function(p) {
			this._super(p, {asset:'plateforme1.png' });
		},
		setPoints: function() {
			this.p.points = [
				[this.p.cx*-1, 0],
				[this.p.cx,0],
				[this.p.cx, this.p.cy],
				[this.p.cx*-1, this.p.cy]
			];
		}
	});

	Q.scene("Main",function(stage) {
		// stage.insert(new Q.Repeater({ asset: "background.png", speedX: 0, speedY: 0 }));
		stage.insert(new Q.Ptf({x: 50, y: 180})).setPoints();
		stage.insert(new Q.Ptf({x: 180, y: 180})).setPoints();
		stage.insert(new Q.Ptf({x: 320, y: 150})).setPoints();
		var player = stage.insert(new Q.Player({x: 20, y: 100}));
		stage.add("viewport").follow(player,{x: true, y: false}, {minX: -20});
	});

	Q.scene("UI",function(stage) {
		stage.insert(new Q.Sprite({asset:'arrows.png', x: 260, y: 170}));
	});



	// Chargement initial
	Q.load("player.png, background.png, plateforme1.png, arrows.png", function() {
		Q.sheet("player","player.png",{tilew: 16, tileh: 32,  sx: 0, sy: 0});
		Q.animations('player', {
			hit: { frames: [1], rate: 3, next: 'stand', trigger: 'standup'},
			stand: { frames: [0], rate: 10},
			dead: { frames: [2,3], rate: 1/4},
			walk: { frames: [4,5,4,0,7,6,7,0], rate: 1/6},
			walkright: { frames: [8,9,8,11,10,12,10,11], rate: 1/6},
			walkleft: { frames: [17,16,17,14,15,13,15,14], rate: 1/6},
		});
		Q.stageScene("Main",0);
		Q.stageScene("UI",1);
	}, {
		progressCallback: function(loaded,total) {}
	});
});
</script>
<style>
	body { padding:0px; margin:0px; font: 11px Arial,Helvetica, sans-serif; margin: 0;}
	h1,h2,h3 {font-weight: bold; margin: 0;}
	h1 { font-size: 15px; padding: 5px 0 5px 0; }
	h2 { font-size: 14px; padding: 4px 0 4px 0; }
	h3 { font-size: 13px; padding: 2px 0 2px 0; }
	ul { color: #777; list-style-type: none; padding: 0; text-align: justify;}
	ul li { color: #000; margin: 10px 0 0 16px}
</style>
</head>
<body>
<div style="width:340px; margin:0 auto;">
	<h1>Raphaël Huchet: Développeur</h1>
	<canvas id="myGame" width="320" height="200" style="border: black 1px solid"></canvas>
	<h2>Parcours professionnel</h2>
	<h3>Depuis Avril 2007</h3>
	<p>
		Responsable du logiciel « Edoceo Learning Manager », plateforme LMS de la société e-doceo :
		<ul>
			<li>Développement seul et en équipe<br />(pilotage, conception, programmation, tests, livraison)</li>
			<li>E-learning: développement du LMS, standards SCORM et AICC, installation, configuration, monitoring sur serveurs hétérogènes</li>
			<li>Gestion de projet, expression des besoins, workflow, déplacements, formation de développeurs, process qualité, tests unitaires et fonctionnels automatisés</li>
		</ul>
	</p>
</div>
</body>
</html>