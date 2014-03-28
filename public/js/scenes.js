;Quintus.RafScenes = function(Q) {
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
					stage.options.player.pause = false;
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
					stage.options.player.last_action = Date.now();
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
		var pnjs = [];
		console.log(pnjs_props, pnjs_props.length);
		for (i = 0; i < pnjs_props.length; i++) {
			pnjs.push(
				stage.insert(
					new Q.NPC({
						x: Math.round((houses.p.cx - Math.floor(Math.random()*houses.p.w))/16)*16,
						y: Math.floor(Math.random()*60)+360,
						nname: pnjs_props[i].nname,
						bg_text_color: pnjs_props[i].bg_text_color,
						text_color: pnjs_props[i].text_color,
						sprite: pnjs_props[i].sprite,
						sheet: pnjs_props[i].sprite,
						vx: pnjs_props[i].vx
					})
				)
			);
			pnjs[i].p.z = pnjs[i].p.y;
			pnjs[i].p.points = [
				[pnjs[i].p.cx*-1, pnjs[i].p.cy*.1],
				[pnjs[i].p.cx,pnjs[i].p.cy*.1],
				[pnjs[i].p.cx*-1, pnjs[i].p.cy],
				[pnjs[i].p.cx, pnjs[i].p.cy]
			];
		}
		console.log(pnjs);

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
		var FPS_zone = stage.insert(new Q.FPS({}));
		for (var i=0; i < Q.state.get("life"); i++){
			stage.insert(
				new Q.Life({
					x: 16 + i*16,
				})
			);
		}
	});
};