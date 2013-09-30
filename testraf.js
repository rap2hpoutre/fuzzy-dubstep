var pnjs = [];pnjs.push(
				stage.insert(
					new Q.NPC({
						x: Math.round((houses.p.cx - Math.floor(Math.random()*houses.p.w))/16)*16,
						y: Math.floor(Math.random()*60)+360,
						nname: "Bastianne Roland",
						bg_text_color: "rgba(27,59,131,0.95)",
						text_color: "black",
						sprite: "pnj1",
						sheet: "pnj1",
						vx: 0
					})
				)
			);

			pnjs[0].p.z = pnjs[0].p.y;
			pnjs[0].p.points = [
				[pnjs[0].p.cx*-1, pnjs[0].p.cy*.1],
				[pnjs[0].p.cx,pnjs[0].p.cy*.1],
				[pnjs[0].p.cx*-1, pnjs[0].p.cy],
				[pnjs[0].p.cx, pnjs[0].p.cy]
			];pnjs.push(
				stage.insert(
					new Q.NPC({
						x: Math.round((houses.p.cx - Math.floor(Math.random()*houses.p.w))/16)*16,
						y: Math.floor(Math.random()*60)+360,
						nname: "Antony Nawabe",
						bg_text_color: "rgba(193,105,94,0.95)",
						text_color: "black",
						sprite: "pnj2",
						sheet: "pnj2",
						vx: 0
					})
				)
			);

			pnjs[1].p.z = pnjs[1].p.y;
			pnjs[1].p.points = [
				[pnjs[1].p.cx*-1, pnjs[1].p.cy*.1],
				[pnjs[1].p.cx,pnjs[1].p.cy*.1],
				[pnjs[1].p.cx*-1, pnjs[1].p.cy],
				[pnjs[1].p.cx, pnjs[1].p.cy]
			];pnjs.push(
				stage.insert(
					new Q.NPC({
						x: Math.round((houses.p.cx - Math.floor(Math.random()*houses.p.w))/16)*16,
						y: Math.floor(Math.random()*60)+360,
						nname: "Thadeus Quentin",
						bg_text_color: "rgba(57,120,156,0.95)",
						text_color: "black",
						sprite: "pnj3",
						sheet: "pnj3",
						vx: 0
					})
				)
			);

			pnjs[2].p.z = pnjs[2].p.y;
			pnjs[2].p.points = [
				[pnjs[2].p.cx*-1, pnjs[2].p.cy*.1],
				[pnjs[2].p.cx,pnjs[2].p.cy*.1],
				[pnjs[2].p.cx*-1, pnjs[2].p.cy],
				[pnjs[2].p.cx, pnjs[2].p.cy]
			];pnjs.push(
				stage.insert(
					new Q.NPC({
						x: Math.round((houses.p.cx - Math.floor(Math.random()*houses.p.w))/16)*16,
						y: Math.floor(Math.random()*60)+360,
						nname: "Joachim Rabaud",
						bg_text_color: "rgba(128,68,176,0.95)",
						text_color: "black",
						sprite: "pnj4",
						sheet: "pnj4",
						vx: 0
					})
				)
			);

			pnjs[3].p.z = pnjs[3].p.y;
			pnjs[3].p.points = [
				[pnjs[3].p.cx*-1, pnjs[3].p.cy*.1],
				[pnjs[3].p.cx,pnjs[3].p.cy*.1],
				[pnjs[3].p.cx*-1, pnjs[3].p.cy],
				[pnjs[3].p.cx, pnjs[3].p.cy]
			];pnjs.push(
				stage.insert(
					new Q.NPC({
						x: Math.round((houses.p.cx - Math.floor(Math.random()*houses.p.w))/16)*16,
						y: Math.floor(Math.random()*60)+360,
						nname: "Francky Simons",
						bg_text_color: "rgba(154,149,106,0.95)",
						text_color: "black",
						sprite: "pnj5",
						sheet: "pnj5",
						vx: 50
					})
				)
			);

			pnjs[4].p.z = pnjs[4].p.y;
			pnjs[4].p.points = [
				[pnjs[4].p.cx*-1, pnjs[4].p.cy*.1],
				[pnjs[4].p.cx,pnjs[4].p.cy*.1],
				[pnjs[4].p.cx*-1, pnjs[4].p.cy],
				[pnjs[4].p.cx, pnjs[4].p.cy]
			];pnjs.push(
				stage.insert(
					new Q.NPC({
						x: Math.round((houses.p.cx - Math.floor(Math.random()*houses.p.w))/16)*16,
						y: Math.floor(Math.random()*60)+360,
						nname: "Salwa Mauricy",
						bg_text_color: "rgba(166,12,0,0.95)",
						text_color: "black",
						sprite: "pnj6",
						sheet: "pnj6",
						vx: 0
					})
				)
			);

			pnjs[5].p.z = pnjs[5].p.y;
			pnjs[5].p.points = [
				[pnjs[5].p.cx*-1, pnjs[5].p.cy*.1],
				[pnjs[5].p.cx,pnjs[5].p.cy*.1],
				[pnjs[5].p.cx*-1, pnjs[5].p.cy],
				[pnjs[5].p.cx, pnjs[5].p.cy]
			];pnjs.push(
				stage.insert(
					new Q.NPC({
						x: Math.round((houses.p.cx - Math.floor(Math.random()*houses.p.w))/16)*16,
						y: Math.floor(Math.random()*60)+360,
						nname: "Raihau Zamora",
						bg_text_color: "rgba(182,249,8,0.95)",
						text_color: "black",
						sprite: "pnj7",
						sheet: "pnj7",
						vx: -10
					})
				)
			);

			pnjs[6].p.z = pnjs[6].p.y;
			pnjs[6].p.points = [
				[pnjs[6].p.cx*-1, pnjs[6].p.cy*.1],
				[pnjs[6].p.cx,pnjs[6].p.cy*.1],
				[pnjs[6].p.cx*-1, pnjs[6].p.cy],
				[pnjs[6].p.cx, pnjs[6].p.cy]
			];pnjs.push(
				stage.insert(
					new Q.NPC({
						x: Math.round((houses.p.cx - Math.floor(Math.random()*houses.p.w))/16)*16,
						y: Math.floor(Math.random()*60)+360,
						nname: "Ellyn Twain",
						bg_text_color: "rgba(51,115,116,0.95)",
						text_color: "black",
						sprite: "pnj8",
						sheet: "pnj8",
						vx: -30
					})
				)
			);

			pnjs[7].p.z = pnjs[7].p.y;
			pnjs[7].p.points = [
				[pnjs[7].p.cx*-1, pnjs[7].p.cy*.1],
				[pnjs[7].p.cx,pnjs[7].p.cy*.1],
				[pnjs[7].p.cx*-1, pnjs[7].p.cy],
				[pnjs[7].p.cx, pnjs[7].p.cy]
			];pnjs.push(
				stage.insert(
					new Q.NPC({
						x: Math.round((houses.p.cx - Math.floor(Math.random()*houses.p.w))/16)*16,
						y: Math.floor(Math.random()*60)+360,
						nname: "Marycka Lavalle",
						bg_text_color: "rgba(179,166,11,0.95)",
						text_color: "black",
						sprite: "pnj9",
						sheet: "pnj9",
						vx: 60
					})
				)
			);

			pnjs[8].p.z = pnjs[8].p.y;
			pnjs[8].p.points = [
				[pnjs[8].p.cx*-1, pnjs[8].p.cy*.1],
				[pnjs[8].p.cx,pnjs[8].p.cy*.1],
				[pnjs[8].p.cx*-1, pnjs[8].p.cy],
				[pnjs[8].p.cx, pnjs[8].p.cy]
			];pnjs.push(
				stage.insert(
					new Q.NPC({
						x: Math.round((houses.p.cx - Math.floor(Math.random()*houses.p.w))/16)*16,
						y: Math.floor(Math.random()*60)+360,
						nname: "Milio Tsukada",
						bg_text_color: "rgba(91,186,167,0.95)",
						text_color: "black",
						sprite: "pnj10",
						sheet: "pnj10",
						vx: 30
					})
				)
			);

			pnjs[9].p.z = pnjs[9].p.y;
			pnjs[9].p.points = [
				[pnjs[9].p.cx*-1, pnjs[9].p.cy*.1],
				[pnjs[9].p.cx,pnjs[9].p.cy*.1],
				[pnjs[9].p.cx*-1, pnjs[9].p.cy],
				[pnjs[9].p.cx, pnjs[9].p.cy]
			];