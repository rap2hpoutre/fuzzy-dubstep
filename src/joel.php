<?php
mt_srand(microtime(true) * 100000);

$nom_plurs = array(
	'prêtres', 'papes', 'abbés', 'curés', 'moines', 'saints', 'anges', 'réformistes',
	'mormons', 'raëliens', 'satanistes', 'gothiques', 'adorateurs de satan', 'francs-maçons', 'conspirateurs', 'skull and bones',
	'homosexuels', 'transesuels', 'bisexuels', 'hétérosexuels',
	'catholiques', 'juifs', 'religieux', 'musulmans', 'islamistes', 'chrétiens', 'orthodoxes', 'hétérodoxes', 'israëlites', 'hérétiques',
	'rois', 'ducs', 'présidents', 'ministres', 'technocrates', 'phallocrates', 'conservateurs', 'libéraux', 'capitalistes', 'communistes',
	'sorciers', 'adeptes de sorcellerie', 'alchimistes', 'escalves modernes',
	'nazis', 'violeurs', 'voleurs', 'bandits', 'pédés', 'violeurs d\'enfants', 'tueurs en séries', 'fils de putes', 'queutards'
);

$nom_sings = array(
	'prêtre', 'pape', 'abbé', 'curé', 'moine', 'saint', 'ange', 'réformiste',
	'mormon', 'raëlien', 'sataniste', 'gothique', 'adorateur de satan', 'francs-maçon', 'conspirateur',
	'homosexuel', 'transesuel', 'bisexuel', 'hétérosexuel',
	'catholique', 'juif', 'religieux', 'musulman', 'islamiste', 'chrétien', 'orthodoxe', 'hétérodoxe', 'israëlite', 'hérétique',
	'roi', 'duc', 'président', 'ministre', 'technocrate', 'phallocrate', 'conservateur', 'libéral', 'capitaliste', 'communiste',
	'sorcier', 'adepte de sorcellerie', 'alchimiste', 'escalve moderne',
	'nazi', 'violeur', 'voleur', 'bandit', 'pédé', 'violeur d\'enfants', 'tueur en série', 'fils de pute', 'queutard'
);

$nom_communs_sings = array(
	'le talmud', 'la bible', 'une église', 'une cathédrale', 'une chapelle', 'la torah', 'le coran',
	'un calendrier', 'un de mes admis', 'l\'argent', 'un voyage', 'logiciel e-learning',
	'une baraque a frites', 'un cerveau'
);

$phrases = array();

for ($i = 0; $i < 80; $i++) {
	$nom_plur = $nom_plurs[mt_rand(0,count($nom_plurs)-1)];
	$nom_plur2 = $nom_plurs[mt_rand(0, count($nom_plurs)-1)];
	$nom_sing = $nom_sings[mt_rand(0, count($nom_sings)-1)];
	$nom_sing2 = $nom_sings[mt_rand(0, count($nom_sings)-1)];
	$nom_commun_sing = $nom_communs_sings[mt_rand(0, count($nom_communs_sings)-1)];

	$tous_les = array(
		"Une grande partie des $nom_plur est $nom_sing",
		"Tous les $nom_plur sont $nom_plur2",
		"La majorité des $nom_plur est $nom_sing",
		"Une faible partie des $nom_plur est $nom_sing",
		"La moitié des $nom_plur est $nom_sing",
		"Je connais un $nom_sing qui est $nom_sing2",
		"Il parait que les $nom_plur sont $nom_plur2",
		"Il parait que les $nom_plur valent mieux que les $nom_plur2",
		"Les $nom_plur sont $nom_plur2",
		"Les $nom_plur sont de moins en moins $nom_plur2",
		"Les $nom_plur sont de plus en plus $nom_plur2",
		"Les $nom_plur sont plus ou moins $nom_plur2",
		"J'ai entendu dire que les $nom_plur sont $nom_plur2",
		"Je préfère les $nom_plur aux $nom_plur2",
		"Un $nom_sing vaut mieux que deux tu l'aura",
		/* "Tu as entendu parler des $nom_plur-$nom_plur2 ?", */
		"Les $nom_plur, les $nom_plur2... Tu sais ce que j'en pense...",
		"J'ai décidé de devenir $nom_sing",
		/* "Tu as lu le dernier articles sur les $nom_plur ?", */
		"Je trouve que les $nom_plur sont révolants",
		"J'aime les $nom_plur",
		"Je suis devenu $nom_sing",
		"$nom_plur, $nom_plur, $nom_plur ! Il n'y en a que pour eux !",
		"Je préfère encore être $nom_sing que $nom_sing2",
		"Les $nom_plur2 hésitent à élire un $nom_sing ou un $nom_sing2 à la tête des $nom_plur",
		"Ce qu'il faudrait aux $nom_plur c'est un bon vieux $nom_sing",
		"Les $nom_plur n'ont pas su choisir leur $nom_sing",
		"Les $nom_plur et les $nom_plur2 ne feront la paix que lorsqu'un $nom_sing règlera ça",
		"Les $nom_plur ont encore fait un attentat contre les $nom_plur2",
		"Un $nom_sing a tué un $nom_sing2",
		"Putain je hais les $nom_plur2",
		"Avant j'étais $nom_sing. Maintenant je suis $nom_sing2",
		"$nom_plur > $nom_plur2",
		"Je rêve d'un monde où les $nom_plur seront pareils que les $nom_plur2",
		"Si j'étais $nom_sing, je pense que je n'aimerais pas les $nom_plur2",
		"Un $nom_sing a brulé $nom_commun_sing",
		"Un $nom_sing a renié $nom_commun_sing",
		"Les $nom_plur ont créé $nom_commun_sing pour les $nom_plur2",
		"Les $nom_plur ont libéré $nom_commun_sing",
		"Les $nom_plur ont $nom_commun_sing plus développé que les $nom_plur2",
		"$nom_commun_sing a permis aux $nom_plur de s'affranchir des $nom_plur2",
		"$nom_sing après tout, ce n'est qu'un $nom_sing2 en mieux",
		"$nom_sing ou $nom_sing2, il faut choisir",
		"Impossible pour un $nom_sing de devenir $nom_sing2",
		"Je déteste les $nom_plur",
		"Rien de pire qu'un $nom_sing, à part peut être deux $nom_plur",
		"Vive les $nom_plur !",
		"Je trouve vraiment les $nom_plur ridicules",
		"Ces $nom_plur sont vraiment tous les mêmes"
	);

	$phrases[] = $tous_les[mt_rand(0, count($tous_les)-1)];
}
$phrase = 'var polemiques=' . json_encode($phrases) . ';';
file_put_contents(dirname(__FILE__) . '/../public/js/phrases.js', $phrase);
?>