var pnjs = [];pnjs.push(
				stage.insert(
					new Q.NPC({
						x: Math.round((houses.p.cx - Math.floor(Math.random()*houses.p.w))/16)*16,
						y: Math.floor(Math.random()*60)+360,
						nname: "Asbed Girardin",
						bg_text_color: "rgba(106,121,126,0.95)",
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
						nname: "Lilliane Gakusha",
						bg_text_color: "rgba(116,172,132,0.95)",
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
						nname: "Audélia Moore",
						bg_text_color: "rgba(90,136,4,0.95)",
						text_color: "black",
						sprite: "pnj3",
						sheet: "pnj3",
						vx: -60
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
						nname: "Rohan Ricardo",
						bg_text_color: "rgba(76,34,136,0.95)",
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
						nname: "Cerise Lipszyc",
						bg_text_color: "rgba(197,72,17,0.95)",
						text_color: "black",
						sprite: "pnj5",
						sheet: "pnj5",
						vx: 0
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
						nname: "Mami Blaszczak",
						bg_text_color: "rgba(101,199,238,0.95)",
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
						nname: "Billel Namiki",
						bg_text_color: "rgba(72,47,124,0.95)",
						text_color: "black",
						sprite: "pnj7",
						sheet: "pnj7",
						vx: 0
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
						nname: "Chakib Antonovitch",
						bg_text_color: "rgba(126,176,78,0.95)",
						text_color: "black",
						sprite: "pnj8",
						sheet: "pnj8",
						vx: 0
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
						nname: "Adenora Koutovski",
						bg_text_color: "rgba(21,174,124,0.95)",
						text_color: "black",
						sprite: "pnj9",
						sheet: "pnj9",
						vx: 0
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
						nname: "Arzula Mogaburu",
						bg_text_color: "rgba(26,86,67,0.95)",
						text_color: "black",
						sprite: "pnj10",
						sheet: "pnj10",
						vx: -70
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