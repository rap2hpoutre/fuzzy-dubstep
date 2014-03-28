;Quintus.RafObjects = function(Q) {
	// Une vie
	Q.Sprite.extend("Life",{
		init: function(p) {
			this._super(p, {
				asset:'life.png',
				y: 14
			});
		}
	});

	// Un billet
	Q.Sprite.extend("Loot",{
		init: function(p) {
			this._super(p, {
				asset:'money2.png',
				vx: 5,
				vy: 10
			});
			this.add('animation');
		}
	});

	// L'argent
	Q.UI.Text.extend("Money",{
		init: function(p) {
			this._super({
				label: '' + Q.state.get("money") + ' €',
				x: 40,
				y: 54,
				color: "#118800",
				size: 14
			});
			Q.state.on("change.money",this,"money");
		},
		money: function(money) {
			this.p.label = '' + money + ' €';
		}
	});

	// Le temps
	Q.UI.Text.extend("Time",{
		init: function(p) {
			this._super({
				x:40,
				y: 35,
				label: '' + Q.state.get("time"),
				color: "#0066DD",
				size: 14
			});
			Q.state.on("change.time",this,"time");
		},
		time: function(time) {
			this.p.label = '' + time;
		}
	});

	// Les FPS
	Q.UI.Text.extend("FPS",{
		init: function(p) {
			this._super({
				x:Q.width-30,
				y: 14,
				label: '' + Q.state.get("FPS"),
				color: "#000",
				size: 14
			});
			Q.state.on("change.FPS",this,"FPS");
		},
		step: function (dt) {
			Q.state.set('FPS', Math.round(1/dt));
		},
		FPS: function(FPS) {
			this.p.label = '' + FPS + ' fps';
		}
	});

	// Un personnage non joueur
	Q.Sprite.extend("NPC",{
		init: function(p) {
			this.pause = false;
			this.life = 3;
			this._super(p, {
				gravity:0,
				vx: 0
			});
			this.add('animation');
			this.on("standup", this, "standup");
		},
		standup: function() {
			this.pause = false;
			this.p.vx = 0;
		},
		step: function(dt) {
			if (this.p.vx != 0) {
				this.p.x+=this.p.vx*dt;
				if (Math.abs(this.p.x) > width_div_2) {
					this.p.vx = this.p.vx * -1;
					this.p.x += ((Math.abs(this.p.x) != this.p.x) ? 1 :-1);
				}
				if (this.pause) {
					this.p.vx += (this.p.vx < 0 ? 50*dt : -50*dt);
					if (Math.abs(this.p.vx) < 3) {
						this.p.vx = 0;
						this.p.x = Math.floor(this.p.x);
						this.p.y = Math.floor(this.p.y);
					}
				} else {
					if (this.p.vx < 0) this.play('walkleft');
					else if (this.p.vx > 0) this.play('walkright');
				}
			}
		}
	});

	// Voiture
	Q.Sprite.extend("Car",{
		init: function(p) {
			this._super(p, {
				asset:'car.png',
				gravity:0,
				vx: -200,
				x: 600,
				y: 480
			});
			this.add('2d');
			this.p.points = [
				[this.p.cx*-1+6, 0],
				[this.p.cx-6,0],
				[this.p.cx*-1+6, this.p.cy-8],
				[this.p.cx-6, this.p.cy-8]
			];
			this.p.z = this.p.y;
			this.on("hit",function(collision) {
				this.p.vx = 100;
			});
		},
		step: function(dt) {
			if (this.p.vx > -180) {
				this.p.vx -= 50*dt;
			}
			if (this.p.x < -2000) {
				this.p.x = 2000 + Math.floor(Math.random()*200);
				this.p.vx = -150 - Math.floor(Math.random()*100)
				this.p.y = Math.floor(Math.random()*100)+480;
				this.p.z = this.p.y;
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
				// Promeneur
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
				// Voiture
				} else if(collision.obj.isA("Car")) {
					if (Date.now() > this.last_action + 500) {
						this.last_action = Date.now();
						BIM(this.p.x, this.p.y);
						this.takeDamage(2, this.p.x < collision.obj.p.x ? -150 : 150);
					}
				// Argent
				} else if (collision.obj.isA("Loot")) {
					collision.obj.destroy();
					Q.state.inc("money",Math.floor(Math.random() * 3) + 1);
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
};