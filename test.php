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
<center>
<div id='loading'>
	<div id='loading_container'>
		Loading...
		<div id='loading_progress'></div>
	</div>
</div>
</center>
<script src="http://cdn.html5quintus.com/v0.1.6/quintus-all.js"></script>
<script src="./phrases.js?t=<?php echo time(); ?>"></script>
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

<?php require 'actions.js'; ?>


window.addEventListener("load",function() {
	var Q = window.Q = Quintus({development: true})
		.include("Sprites, Scenes, Input, 2D, Anim, Touch, UI")
		.setup({ maximize: true, upsampleWidth:  420, upsampleHeight:  320});

	Q.input.joypadControls();
	Q.input.keyboardControls();
	Q.input.touchControls({ controls:  [ [],[],[],[],['fire', 'action' ]] });

	<?php require 'objects.js'; ?>

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

	// ## Player Sprite
	Q.Sprite.extend("Player",{
		init: function(p) {
			this.last_action = 0;
			this.pause = false;
			this._super(p, {
				gravity:0,
				sprite: "player",
				sheet: "player"
			});
			this.add('2d, animation, simpleRPGControls');
			Q.state.on("change.life",this,"testIsDead");
			this.on("hit",function(collision) {
				if(collision.obj.isA("NPC") && collision.obj.life > 0) {
					if (Date.now() > this.last_action + 500 && Q.state.get("life") > 0) {
						this.last_action = Date.now();
						this.play('stand');
						this.p.x = Math.floor(this.p.x);
						this.p.y = Math.floor(this.p.y);
						Q.stage(0).pause();
						var action_list = game_actions;
						Q.stageScene("actionList", 1, {
							actions: action_list,
							npc: collision.obj,
							player: this
						});
					}
				} else if(collision.obj.isA("Car")) {
					if (Date.now() > this.last_action + 500) {
						this.last_action = Date.now();
						BIM(this.p.x, this.p.y);
						this.takeDamage(2, this.p.x < collision.obj.p.x ? -150 : 150);
					}
				}
			});
			this.on("standup", this, "standup");
		},
		testIsDead: function() {
			if (Q.state.get("life") <= 0) {
				this.pause = true;
				this.play("dead");
			}

		},
		standup: function() {
			this.pause = false;
			this.p.vx = 0;
		},
		step: function(dt) {
			this.p.z = this.p.y;
			if (!this.pause) {
				if (this.p.vx < 0) this.play('walkleft');
				else if (this.p.vx > 0) this.play('walkright');
				else if (this.p.vy > 0) this.play('walk');
				else if (this.p.vy < 0) this.play('walk');
				else {
					this.play('stand');
					this.p.x = Math.floor(this.p.x);
					this.p.y = Math.floor(this.p.y);
				}
			}
		},
		takeDamage: function(damage, dvx) {
			this.play("hit");
			Q.state.dec("life",damage);
			if (damage == 1) {
				Q("Life", 2).last().destroy();
			} else {
				for (var i=0; i < damage; i++) {
					Q("Life", 2).at(Q.state.get("life")-i +1).destroy();
				}
			}
			this.pause = true;
			this.p.vx = dvx;
		}
	});

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

	// Liste des actions
	Q.scene('actionList',function(stage) {
		var is_action_list = (stage.options.actions instanceof Array);
		var title = stage.options.title;
		var container = stage.insert(new Q.UI.Container({
			x: Q.width/2,
			y: Q.height/2-80,
			fill: (is_action_list ? "rgba(255,255,255,0.9)" : stage.options.npc.p.bg_text_color),
			border: 1
		}));
		var current_selected_text_id = 0;
		var csti = current_selected_text_id;
		var text_zone = container.insert(
			new Q.UI.Text({
				x:20,
				y: 0,
				label: (
					is_action_list ?
						getSelectedText(stage.options.actions, 0) :
						(stage.options.npc.p.nname + ':\n' + stage.options.actions.v)
					),
				color: (is_action_list ? "black" : stage.options.npc.p.text_color),
				size: 12,
				align: 'center'
			})
		);
		container.fit(10, 16);
		setTimeout(function() {
			if (is_action_list) {
				Q.input.on('down',stage,function(e) {
					csti = (csti == stage.options.actions.length -1 ? 0 : csti + 1);
					text_zone.p.label = getSelectedText(stage.options.actions, csti);
				});
				Q.input.on('up',stage,function(e) {
					csti = (csti == 0 ? stage.options.actions.length - 1 : csti - 1);
					text_zone.p.label = getSelectedText(stage.options.actions, csti);
				});
			}
			Q.input.on('fire',stage,function(e) {
				try {
					var tmp_new_actions = (is_action_list ? stage.options.actions[csti].c() : stage.options.actions.c());
					if (tmp_new_actions == 'HIT' || tmp_new_actions == 'HITPLAYER') {
						BIM(
							(stage.options.player.p.x + stage.options.npc.p.x)/2,
							(stage.options.player.p.y + stage.options.npc.p.y)/2
						);
						if (tmp_new_actions == 'HITPLAYER' || Math.random() > .5) {
							stage.options.player.takeDamage(1, (stage.options.player.p.x < stage.options.npc.p.x ? -50 : 50));
						} else {
							stage.options.player.standup();
							stage.options.npc.life--;
							stage.options.npc.pause = true;
							if (stage.options.npc.life <= 0) {
								stage.options.npc.play("dead");
							} else {
								stage.options.npc.play("hit");
							}
							if (stage.options.player.p.x > stage.options.npc.p.x) {
								stage.options.npc.p.vx = -50;
							} else {
								stage.options.npc.p.vx = 50;
							}
						}
						throw true;
					} else {
						Q.stageScene("actionList", 1, {
							actions: tmp_new_actions,
							npc: stage.options.npc,
							player: stage.options.player
						});
					}

				} catch (e) {
					Q.stage(0).unpause();
					// Pour éviter qu'on refasse un truc juste après avoir parlé
					Q("Player", 0).first().last_action = Date.now();
					Q.clearStage(1);
				}
			});
		}, 250);
	});

	Q.scene("Main",function(stage) {
		stage.insert(new Q.Repeater({ asset: "background.png", speedX: 1, speedY: 0 }));
		var houses = stage.insert(new Q.Sprite({asset:'houses.png', x: 0, y: 260}));
		stage.insert(new Q.Car({asset: 'car2.png', y: 480, x: 1300, vx : -200}));
		stage.insert(new Q.Car({asset: 'car1.png', y: 540, x: 600, vx : -180}));
		stage.insert(new Q.Car({asset: 'car0.png', y: 580, x: -500, vx : -220}));
		width_div_2 = houses.p.cx;
		<?php require('testraf.js'); ?>

		var player = stage.insert(new Q.Player({x: 0, y: 400}));
		player.p.points = [
			[player.p.cx*-1+6, player.p.cy*.3],
			[player.p.cx-6,player.p.cy*.3],
			[player.p.cx*-1+6, player.p.cy],
			[player.p.cx-6, player.p.cy]
		];
		stage.add("viewport").follow(player,{x: true, y: false});
	});

	Q.scene("UI",function(stage) {
		var time_image = stage.insert(new Q.Sprite({asset:'time.png', x: 16, y: 36}));
		var money_image = stage.insert(new Q.Sprite({asset:'money.png', x: 16, y: 56}));
		var time_zone = stage.insert(new Q.Time({}));
		var fric_zone = stage.insert(new Q.Money({}));
		for (var i=0; i < Q.state.get("life"); i++){
			stage.insert(
				new Q.Life({
					x: 16 + i*16,
				})
			);
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
<style>
  body { padding:0px; margin:0px; }
</style>
</head>
<body>
</body>
</html>
