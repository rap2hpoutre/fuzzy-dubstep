<?php
$getOnlyPlayer = true;
require('npcs.php');
require('ptf.php');
?><!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8" />

<meta name="viewport" content="width=device-width, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"/>
<title>CV</title>
<script src="http://cdn.html5quintus.com/v0.1.6/quintus-all.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
window.addEventListener("load",function() {

	function isTouchDevice() { return 'ontouchstart' in window || 'onmsgesturechange' in window; };

	var Q = window.Q = Quintus({development: true}).include("Sprites, Scenes, Input, 2D, Anim, Touch, UI").setup("myGame");


	// Q.input.joypadControls();
	Q.input.keyboardControls();
	Q.input.touchControls({ controls:  [ [],[],['left', '←'],['up', '↑'],['right', '→'] ] });



	Q.Sprite.extend("Player",{
		init: function(p) {
			this._super(p, {sprite: "player", sheet: "player", speed: 150 });
			this.add('2d, animation, platformerControls');
			this.play('stand');
			this.currentDivId = 'intro';
			this.updateDiv(this.currentDivId);

			this.on("hit.sprite",function(collision) {
				if(collision.obj.isA("Ptf") && this.currentDivId != collision.obj.p.divId) {
					this.updateDiv(collision.obj.p.divId);
				}
			});
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
			else this.play('stand');
		},
		updateDiv: function(divId) {
			this.currentDivId = divId;
			$('#content').html($('#' + this.currentDivId).html());
		}
	});

	Q.Sprite.extend("Bird",{
		init: function(p) {
			this._super(p, {sprite: "corbeau", sheet: "corbeau", speed: 150, gravity: 0 });
			this.add('2d, animation');
			this.play('fly');
			this.p.vx = -50;
		},
		step: function(dt) {
			if (this.p.x < -50) {
				this.destroy();
			}
		}
	});

	Q.Sprite.extend("Ptf",{
		init: function(p) {
			this._super(p, {asset:'ptf.png' });
		},
		setPoints: function() {
			this.p.points = [
				[this.p.cx*-1, 0],
				[this.p.cx,0],
				[this.p.cx, this.p.cy+5],
				[this.p.cx*-1, this.p.cy+5]
			];
		}
	});

	Q.scene("Main",function(stage) {
		stage.insert(new Q.Repeater({ asset: "fondmoche.png", speedX: 0, speedY: 0 }));
		stage.insert(new Q.Ptf({x: 50, y: 180, divId: 'intro'})).setPoints();
		stage.insert(new Q.Ptf({x: 180, y: 180, divId: 'competences'})).setPoints();
		stage.insert(new Q.Ptf({x: 320, y: 150, divId: 'parcours'})).setPoints();
		stage.insert(new Q.Ptf({x: 470, y: 130, divId: 'formation'})).setPoints();
		stage.insert(new Q.Ptf({x: 660, y: 180, divId: 'activites'})).setPoints();
		stage.insert(new Q.Sprite({x: 690, y: 164, asset:'merci.png'}));
		stage.insert(new Q.Bird({x: 600, y: 40}));
		var player = stage.insert(new Q.Player({x: 20, y: 100}));
		stage.add("viewport").follow(player,{x: true, y: false}, {minX: -20});
	});

	Q.scene("UI",function(stage) {
		if (!isTouchDevice()) stage.insert(new Q.Sprite({asset:'arrows.png', x: 280, y: 170}));
	});

	// Chargement initial
	Q.load("player.png, arrows.png, merci.png, corbeau.png, fondmoche.png, ptf.png", function() {
		Q.sheet("player","player.png",{tilew: 16, tileh: 32,  sx: 0, sy: 0});
		Q.animations('player', {
			hit: { frames: [1], rate: 3, next: 'stand', trigger: 'standup'},
			stand: { frames: [0], rate: 10},
			dead: { frames: [2,3], rate: 1/4},
			walk: { frames: [4,5,4,0,7,6,7,0], rate: 1/6},
			walkright: { frames: [8,9,8,11,10,12,10,11], rate: 1/6},
			walkleft: { frames: [17,16,17,14,15,13,15,14], rate: 1/6},
		});
		Q.sheet("corbeau","corbeau.png",{tilew: 23, tileh: 16,  sx: 0, sy: 0});
		Q.animations('corbeau', {
			fly: { frames: [0,1], rate: 1/4 },
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
	h1,h2,h3 {font-weight: bold; margin: 0; color: #556;}
	h1 { font-size: 15px; padding: 5px 0 5px 0; }
	h2 { font-size: 14px; padding: 4px 0 4px 0; }
	h3 { font-size: 13px; padding: 2px 0 2px 0; }
	ul { color: #777; list-style-type: circle; padding: 0; text-align: justify;}
	ul li { color: #000; margin: 6px 0 4px 16px}
</style>
</head>
<body>
	<div style="width:340px; margin:0 auto;">
		<h1>Raphaël Huchet: Développeur</h1>
		<canvas id="myGame" width="320" height="200" style="border: black 1px solid"></canvas>
		<div id="content"></div>
	</div>

	<div id="intro" style="display: none;">
		<h2>Qui suis-je ?</h2>
		<p>
			<ul>
			<li>J'ai 28 ans, on peut m'appeler au 06 26 54 79 71 et m'écrire à cette adresse: raphaelht@gmail.com</li>
			<li>Pour me voir il faut aller au 24 boulevard Stalingrad à Nantes, j'ai le permis et une carte de bus.</li>
			<li>Pour découvrir ce qui (je l'espère) pourra vous intéresser (parcours professionnel, compétences, etc.) je vous invite à vous rendre sur la plateforme suivante, avec le pouce ou les touches du clavier</li>
			</ul>
		</p>
	</div>

	<div id="parcours" style="display: none;">
		<h2>Parcours professionnel</h2>
		<h3>Depuis Avril 2007</h3>
		<p>
			Responsable du logiciel « Edoceo Learning Manager », plateforme LMS de la société e-doceo :
			<ul>
				<li>Développement seul et en équipe<br />(pilotage, conception, programmation, tests, livraison)</li>
				<li>E-learning: développement du LMS, standards SCORM et AICC, installation, configuration, monitoring</li>
				<li>Gestion de projet, expression des besoins, workflow, déplacements, formation de développeurs, process qualité, tests unitaires et fonctionnels automatisés</li>
			</ul>
		</p>
		<h3>Janvier à Mars 2007</h3>
		<p>Stage en développement pour le Groupe PLG</p>
	</div>

	<div id="formation" style="display: none;">
		<h2>Formation</h2>
		<p>
			<ul>
				<li>2006-2007: Formation Analyste-programmeur au CNAM de Nantes</li>
				<li>2005: Université de Sociologie à Nantes</li>
				<li>2004: Université de Philosophie à Nantes</li>
				<li>2003: Baccalauréat L (option italien)</li>
			</ul>
		</p>
	</div>

	<div id="competences" style="display: none;">
		<h2>Compétences</h2>
		<h3>Développement</h3>
		<p>
			<ul>
				<li>Expert développement Web : PHP5, MySQL5, HTML5, Javascript (objet, design patterns, sécurité, optimisation) Xp: 7ans</li>
				<li>Connaissances en C#, Ruby, NodeJS, LUA</li>
			</ul>
		</p>
		<h3>Outils/divers</h3>
		<p>
			<ul>
				<li>Utilisation quotidienne: LAMP, SVN, Selenium (tests fonctionnels), PHPUnit (tests unitaires), Phing, PuTTY (SSH), Notepad++, BugTracker, Bash (find, grep, cron, etc.)</li>
				<li>Méthodes d’analyse: UML (+merise)</li>
				<!-- <li>Adaptation à divers IDE (NetBeans, PhpStorm, Eclipse, Visual Studio, Unity, PhpDesigner…)</li> -->
				<li>Bureautique : Google apps, Microsoft Office, Open Office</li>
				<li>Présence sur stackoverflow, github</li>
			</ul>
		</p>
	</div>

	<div id="activites" style="display: none;">
		<h2>Activités</h2>
		<p>Musique, bande-dessinée, canvas, vie sociale et vie familiale</p>
	</div>

</body>
</html>