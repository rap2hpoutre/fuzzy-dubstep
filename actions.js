var game_actions = [
	{v: 'Parler', c: function() {
		var demander_du_fric = [
			'Tu n\'aurais pas un brin de monnaie, par hasard ?',
			'J\'ai besoin d\'argent pour me marier, tu en as ?',
			'Une petite pièce pour un futur marié ?',
			'T\'as pas une pièce ?',
			'T\'aurai pas un euro ou deux ?',
			'Tu as une petite pièce pour un mec en galère ?',
			'T\'as pas un euro ?',
			'Tu as un euro ou deux ?',
			'T\'as un euro ?',
			'T\'as pas une petite pièce ?'
		];
		return [
			{v: demander_du_fric[Math.floor(Math.random() * demander_du_fric.length)], c: function(){

				if (Math.random() > .7) {
					var fric = Math.floor(Math.random() * 3) + 1;
					Q.state.inc("money",fric);
					var reponse_fric = [
						'Tiens prends ça',
						'Tiens, voilà '  + fric + '€',
						'Tu as de la chance, il me reste '  + fric + '€',
						'Voilà '  + fric + '€'
					];
					return {v: reponse_fric[Math.floor(Math.random() * reponse_fric.length)]}
				} else {
					var reponse_fric = [
						'Non',
						'Désolé, j\'ai rien sur moi',
						'J\'ai rien sur moi',
						'Attends... Ah non, j\'ai rien',
						'Désolé, j\'ai que des billets',
						'Non je ne donne jamais',
						'Je ne donne pas, c\'est contre mes principes',
						'Désolé, j\'ai déjà donné aujourd\'hui'
					];
					return {v: reponse_fric[Math.floor(Math.random() * reponse_fric.length)]}
				}

			}},
			{v: 'Donne moi tout ce que tu as !', c: function() {
				var aaa = Math.random();
				if (aaa > .98) {
					var fric = Math.floor(Math.random() * 150) + 1;
					Q.state.inc("money",fric);
					return {v: 'Ok ! Voilà ' + fric + '€',}
				} else if (aaa > .6) {
					return {v: 'Tiens, prends ça dans ta gueule !', c: function() {return 'HITPLAYER'}}
				} else {
     				return {v: 'Tu ne fais pas peur !'}
				}
			}},
			{v: 'Je peux t\'aider ?'},
			{v: 'Je cherche un moyen de me faire de l\'argent.'},
			{v: 'Je cherche de la drogue.'},
			{v: 'Je cherche des armes.'},
			{v: 'Je veux juste discuter.',  c: function() {
				return {
					v: polemiques[Math.floor(Math.random() * polemiques.length)], 
					c: function() {
						return [
							{v: 'Fascinant !', c: function() {return {v: 'Oui, je trouve aussi'}} },
							{v: 'Révoltant !', c: function() {return {v: 'Ah bon ?'}} },
							{v: 'Intéressant...', c: function() {return {v: 'Merci'}} },
							{v: 'Euh...', c: function() {return {v: 'C\'est pourtant clair, non ?'}}  },
							{v: 'J\'ai rien compris !', c: function() {return {v: 'C\'est pourtant clair, non ?'}}  },
						];
					}
				}
			}}

		];
	}},
	{v: 'Frapper', c: function() {return 'HIT'}},
	{v: 'Quitter', c: function() {}}
];