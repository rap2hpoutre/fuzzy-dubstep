// Une vie
Q.Sprite.extend("Life",{
	init: function(p) {
		this._super(p, {
			asset:'life.png',
			y: 14
		});
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
			if (Math.abs(this.p.x) > width_div_2) this.p.vx = this.p.vx * -1;
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