<?

require_once('../top.php');
init();
require_once('../foot.php');

function init() 
{
	afficher_titre_tableau("L'assaut contre la Liche", "<img src='/images/laliche.gif'><br>15� jour de l'Hydre du 4� cycle apr�s Ragnarok");
	?>
	<center><img src="http://www.relaismago.com/images/Unclelobo.gif" border="0"></center>
	<?

	tutorial_haut();

	echo "<br><br>";

	hist_liche_Leroidelaclasse_1();
	hist_liche_MohicTroll_1();
	hist_liche_Kasseroll_1();
	hist_liche_Bodega_1();
	hist_liche_Garffon();
	hist_liche_Minos();
	hist_liche_Trulk_1();
	hist_liche_Peaceandtroll();
	hist_liche_Kelu_1();
	hist_liche_MohicTroll_2();
	hist_liche_Leroidelaclasse_2();
	hist_liche_Trulk_2();
	hist_liche_Kapootroll_1();
	hist_liche_Kasseroll_2();
	hist_liche_Jcpoupard();
	hist_liche_Kapootroll_2();
	hist_liche_Leroidelaclasse_3();
	hist_liche_Kasseroll_3();
	hist_liche_Argowar();
	hist_liche_Grognon();
	hist_liche_Kasseroll_4();
	hist_liche_Lobo();
	echo "<img src='http://www.relaismago.com/images/tueur.gif'>";
	hist_liche_Kelu_2();
	hist_liche_Kasseroll_5();
	hist_liche_Domfada();
	
	hist_liche_Bodega_2();
	echo "<img src='http://www.relaismago.com/images/stele.gif'>";

	echo "<br><br>";
	echo "<br><br>";
	tutorial_bas();
}


function hist_liche_Leroidelaclasse_1()
{
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Leroidelaclasse_avatar_bleu.gif", "Leroidelaclasse (36452)");
	?>
	Depuis la nuit des temps, une cr�ature monstrueuse arpentait les profondeurs du Hall. Cette b�te immonde accomplissait
	sa sombre besogne en s'attaquant � tout Troll assez fou pour s'en approcher.<br><br>
	Plusieurs centaines de meurtres plus tard, un groupe de courageux volontaires ont d�cid� d'en d�coudre !<br><br>
	Le point de rassemblement pour le grand combat sera situ� entre le Lac souterrain du Froid et la Crois�e des cavernes du Manger.<br>

	<?
	tutorial_haut_bas_gauche();
}

function hist_liche_MohicTroll_1()
{
	tutorial_haut_bulle_droit();
	?>
	De nombreux trolls �taient rassembl�s.<br>
	De toutes races, de tous �ges, de guildes diff�rentes.<br>
	Rarement on avait vu autant de trolls dans si peu de cavernes, surtout sans qu'ils se battent !<br>
	Ils piaffaient tous d'impatience, s'�changeant potions, parchemins, armes et armures.<br>
	Certains usaient de magie pour aider les autres.<br>
	Tous �taient suspendus aux l�vres d'un seul troll, qui leur donnerait le signal du d�part...<br>
	<?
	tutorial_haut_bas_droit("http://www.pipeshow.net/RM/avatars/Mohictroll_avatar_bleu.gif", "Mohic'Troll (40616)");
}

function hist_liche_Kasseroll_1()
{
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Kasseroll_avatar_bleu.gif", "Kasseroll (18537)");
	?>
	Dans un coin de la caverne, un troll �tait assis. Demain, ce troll partait par le portail de t�l�portation ouvert le soir m�me, en direction d'un des monstres les plus puissants des souterrains. Il partait parmi les premiers, charg� de ralentir la garde afin que ses compagnons puissent entamer leur commandant. Il partait en sachant pertinement qu'il n'avait presque aucune chance de survivre au combat.<br><br>
	
	Dans un coin de la caverne, un troll �tait assis. Entre ses mains, une statuette de bouse de gowap s�ch�e prenait forme. On reconnaissait la silhouette naissante de Kkwet, le sage esprit protecteur de la guilde Relais&Mago. Ce n'�tait pas la survie qu'il esp�rait. Un sourire f�roce d�couvrait ses dents : la victoire suffirait.<br><br>

	Dans un coin de la caverne, un troll �tait assis. Son oeuvre achev�e, il v�rifiait une derni�re fois son mat�riel. Son sac, soigneusement modifi� pour qu'� sa mort les potions importantes qu'il transportaient ne soient pas d�truites dans la d�composition rapide de son corps (usuelle chez les trolls), mais tombent au sol, pr�tes � �tre utilis�es par les suivants. Son armure, d�risoire protection contre ce qui l'attendait, mais toujours rassurante. Sa casserole, soigneusement viss�e sur son cr�ne pour garder ses lorgnons des chocs.<br><br>

	Dans un coin de la caverne, un troll �tait assis. Il fit cr�piter plusieurs fois l'�nergie magique entre ses doigts, retrouvant la sensations famili�re. Des flamm�ches naquirent puis s'�teignirent, suivies d'un ectoplasme vert et gluant. La puissance du Dieu du Feu courait dans ses veines et r�chauffait son corps, tendu par l'attente et la perspective du combat � venir.<br><br>

	Dans un coin de la caverne, un troll �tait assis et commen�ait � s�v�rement s'ennuyer.<br><br>

	"Bon, on y va ?"<br>

	<?
	tutorial_haut_bas_gauche();
}

function hist_liche_Bodega_1()
{
	tutorial_haut_bulle_droit();
	?>
	Trollinets, Trollettes, Trolls. Tous ce soir l�, �taient en attente. En attente dans un calme plat au milieu d'une caverne bond�e de dizaines et de dizaines de trolls.<br>
	Mais que font-ils ? Ils prient, ils pensent, ils dorment pour le lendemain.<br>
	Ce soir, calme plat avant la tempette qui va faire rage sur cette bestiole tant attendue depuis des mois. Oh, un bruit se fit entendre.<br>
	<i>* prout *</i><br>
	Personne ne fit attention � ce bruit, tout le monde fignolle sa cacahouette. Gloire � Kkwet, Mort � la Liche.<br>
	<?
	tutorial_haut_bas_droit("http://www.pipeshow.net/RM/avatars/Bodega_avatar_bleu.gif", "Bod�ga (49145)");
}

function hist_liche_Garffon()
{
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Garffon_avatar_bleu.gif", "Garffon (43658)");
	?>
 Demain, je verrai la Liche.<br><br>

	Voil� la pens�e que j'�tait en train de ressasser...J'�tais, comme � mon habitude, en train de veiller sous un tas de gravas, mon fid�le Corbeau montant la garde au sommet du monticule. Ainsi camoufl�, je cherchais le sommeil, mais en vain. L'id�e du Monstre, un Monstre que l'on m'a toujours pr�sent� comme terrible et implacable, occupait mon esprit.<br><br>

	La tension �tait palpable, presque mat�rielle. L'attention de tous se focalisait sur une sorte de petit nuage bleu, flou, qui occupait le centre de la caverne : un portail de t�l�portation. Si je connaissait l'existence de tels objets magiques, je n'en avait emprunt� un que quelques jours auparavant : jusque l�, je pensais qu'une telle concentration de magie brute �tait r�serv�e aux plus grands mages parmi les trolls, et je d�sesp�rait d'en paser un un jour.<br><br>

	Les derniers jours avaient �t� �prouvants. J'ai pris plusieurs portails d'affil�, faussant mes sens, provoquant des naus�es. D�cid�ment, de tels sorts sont bien pratiques, mais ils ne sont pas au point. Tout avait commenc� � la surface : j'avais d� courir longtemps sous le solail, pour pouvoir me jeter � temps dans l'un de ces nuages peu avant sa disparition. En avait suivi une s�rie de voyages identiques, me menant au fur et � mesure dans les profondeurs du Hall. Partant de la surface, je me suis vite retrouv� en compagnie de monstres qui m'�taient familiers, puis je suis descendu plus encore. Et j'ai rencontr� des monstres plus grands, plus forts, plus puissants, plus mortels. Et j'ai rencontr� des trolls plus grands, plus forts, plus mortels.<br><br>

	Me voil� maintenant entour� de Phoenix, de Grylles, de G�ants d'un c�t�, et de trolls bien plus impressionants que moi (5 pieds de haut, plut�t malingre) de l'autre. Je suis dans un rassemblement, d'innombrables trolls occupent ma caverne, la plupart ressemblant � des titans � c�t� de moi.<br><br>

	Et tous, tous regardent le portail. Tous savent que dans quelques heures, il devront le passer. Certains paraissent ne pas s'en soucier, discutant (dans un langage parfois brutal : comment de vraies brutes, qui ne sont m�me pas de la noble race des Tomawak de surcro�t, pourraient-elles s'exprimer normalement ?) avec le troll d'� c�t� : mais apr�s tout, ce n'est l� qu'un artifice parmi d'autre pour d�tourner leur esprit du Monstre. J'en vois un qui rajuste son armure crasseuse, comme si elle pouvait lui servir � quelque chose face au Monstre. D'autres encore cherchent en vain le sommeil, ou m�ditent. Ils savent que la mort risque de les faucher, mais il doivent �carter toute peur de leur esprit.<br><br>

	Si eux craignent quelque chose, moi, que dois-je en penser ? La peur cherche � s'emparer de moi, mais je la repousse. Je ferai honneur aux Tomawak. Je ferai honneur � ma guilde. Je ne fuirai pas devant le danger. Je rel�verai le d�fi.<br><br>

	Demain, nous devrons passer le portail.<br>
	Demain, nous devrons affronter la Liche.<br>
	Demain est un beau jour pour mourir...<br>

	<?
	tutorial_haut_bas_gauche();
}

function hist_liche_Minos()
{
	tutorial_haut_bulle_droit();
	?>
	De m�moire de ma jeune vie de troll, je n'avais jamais vu autant de trolls r�unis. Des touts petits trollinets bard�s de popos jusqu'aux supertrolls bavants de rage... Impressionant.<br>
	Derri�re le portail...<br>
	Tout le monde fixait ce vague truc miroitantdevant nous.<br>
	Derri�re le portail..<br><br>
	Le monstre.<br>
	M�me pas peur.<br>
	<?
	tutorial_haut_bas_droit("http://www.pipeshow.net/RM/avatars/Minos_avatar_bleu.gif", "Minos (27951)");
}

function hist_liche_Trulk_1()
{
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Trulk_avatar_bleu.gif", "Trulk (50275)");
	?>
	Le combat avait commenc� ! Une centaine de trolls avaient franchi le portail et d�j� le bruit du fracas des armes avait retentit.<br>
	Je regardais � droite et � gauche, partout des trolls et des morts vivants. J'aper�ois bri�vement mon ami DomFada qui tente veinement d'oter une texture ectoplasmique de son fin coutelas par des gestes vifs du bras. Le fant�me qui lui fait face part d'un rire d'outre-tombe.<br>
	Je me concentre, �a y est, je l'ai retrouv�: l'odeur et la couleur. Je vois le rouge de son pyjama et je sens le fumet de sa transpiration. Grognon court comme il peut en �vitant les attaques de monstres innommables.<br>
	Je le suis, court, esquive, court, tr�buche, esquive....<br>
	Puis, je l'aper�ois, perch�e sur un monticule de cranes grima�ants. La Liche. D�j� � ses pieds gisent des trolls de ma guilde que je n'ai pas eu le temps de conna�tre. La Liche ne m'a pas laiss� ce plaisir.<br>
	Grognon fonce sur la cr�ature et lui fiche un gros coup de t�te. La Liche encaisse le coup sans broncher et d'un revers de main griffue, d�capite le pauvre Grognon.<br>
	Il n'y a qu'une seule solution: le venger.<br>
	Mes v�tements commencent � craquer et ma t�te se pigmente de rose. Je me recroqueville sur moi m�me et, ne ressemblant plus qu'� une �norme boule de chair ros�tre, j'entame une charge en roul�-boul� qui est ma marque de fabrique.<br>
	La liche n'a pas le temps de voir venir et dans un grand fracas, son corps vole en milles �clats. Je me redresse, empoigne la t�te de la cr�ature en hurlant:<br><br>
	
	VICTOIRE ! GLOIRE POUR KKWET!<br><br>
	
	Quand alors, les orbites vides de la t�te tenue � bout de bras se mettent � luirent et un son horrible sort de sa bouche d�sincarn�e: RRRRRRRRrrrr uummffglub !<br><br>
	
	Je me retourne et repousse le bras qui me g�ne. RRRRRRRrrr umfffglub ! Quel bruit atroce ! Mes paupi�res s'ouvrent et j'aper�ois un troll vautr� � mes c�t�s, ronflant � grosses bulles. JE tourne la t�te, partout autour de moi, des trolls mangent, dorment ou festoient, et au centre..... la lueur bleut�e du portail.<br><br>
	
	Umf, avec empressement, je me rallonge pour prendre des forces. Demain sera un jour de gloire.<br><br>

	De gloire, et de mort.<br>
	<?
	tutorial_haut_bas_gauche();
}

function hist_liche_Peaceandtroll()
{
	tutorial_haut_bulle_droit();
	?>
	Kkwet guide leur bras et que le calvok leur donne la force de lui �clater la tronche....accorde � Mohic la force de ses esprit-des-bestioles et que Poass prenne ses RT�T�.
	<?
	tutorial_haut_bas_droit("http://www.pipeshow.net/RM/avatars/Peaceandtroll_avatar_bleu.gif", "Peace&Troll (31202)");
}

function hist_liche_Kelu_1()
{
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Kelu_avatar_bleu.gif", "Kelu (43246)");
	?>
	Aujourd'hui sera un grand jour, j'en ai la certitude.<br>

	Tout au long de mon p�riple au sein du groupe de chasse des As-troll-ogs, Les D�kans nous ont montr� la voie. Et tout particuli�rement Saint Kaprikornu, � qui nous d�dions souvent une petite pri�re avant de nous jeter au combat.<br>
	Mais depuis quelques temps, je ne ressentais plus sa pr�sence autour de nous...or, cette nuit, j'ai eu une vision:<br><br>
	
	Saint Kaprikornu et kkwet dansaient ensemble sur un air de rumba.<br><br>
	
	Serait-ce un signe, mes compagnons ?<br>
	<?
	tutorial_haut_bas_gauche();
}

function hist_liche_MohicTroll_2()
{
	tutorial_haut_bulle_droit();
	?>
	Le grand disque miroitant flottait devant nous. Tous attendaient, impatients.<br><br>

	Puis, sur l'ordre de l'un d'eux, un petit groupe se mit en marche.<br><br>

	Ils franchirent le portail, d'un pas sur, m�me si sur leur visage se lisait autant de peur que de d�termination.<br><br>

	Quelques instants plus tard, ceux qui n'avaient pas encore passer le portail, entendirent au loin les cris de guerre, les potions qui �clatent sur leur cibles, et les borborygmes des formules magiques.<br>

	D�j� un autre groupe s'avance, tandis que le plus gros de la troupe n'attend plus q'un geste poue s'�lancer.<br><br>

	"Ca y est, c'est parti. Que les Esprits nous prot�gent et nous rendent plus fort !"<br>

	<?
	tutorial_haut_bas_droit("http://www.pipeshow.net/RM/avatars/Mohictroll_avatar_bleu.gif", "Mohic'Troll (40616)");
}

function hist_liche_Leroidelaclasse_2()
{
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Leroidelaclasse_avatar_bleu.gif", "Leroidelaclasse (36452)");
	?>
	Le plan a s�rement une faille mais o� ??<br><br>

	Tout repose sur la synchro, si ils ne se t�l�portent pas au bon moment on est mal, si ils tombent trop loin de la Liche on est mal, si les M�ga Dover Powa ne marchent pas on est mal, si tout le monde se marche dessus on est mal, si la garde tombe dans la caverne de la Liche on est mal...<br><br>

	Pfff ya trop de param�tres l� !<br><br>

	Bon, allez, on verra bien demain ...<br>

	<?
	tutorial_haut_bas_gauche();
}

function hist_liche_Trulk_2()
{
	tutorial_haut_bulle_droit();
	?>
	On y �tait ! Le lev� avait �t� rude.... (dormir avec le pied de Wolf sur la t�te n'est pas de tout repos). Tout se d�roulait comme pr�vu.... Le roi de la classe qui se tenait devant le portail beuglait ses ordres (tient lui aussi) et formait les diff�rents groupes ou Kohort comme j'ai entendu dire.<br>
	Beaucoup de trolls tr�pignaient.<br>
	Le Roi sorti un gros drapeau � carreaux et hurla... unit� sp�ciale, GO !<br>
	Et le premier groupe s'engoufra dans le portail.<br>
	Ainsi de suite. Puis vint le tour de mon groupe: les cogneurs. Notre but, un seul: taper la Liche jusqu'� ce que mort s'en suive.<br><br>

	Grognon qui menait le groupe se mit � courrir tout en relayant l'ordre du roi: "Les Cogneurs, GO !"<br>
	Et je plongeais dans le portail.<br><br>

	Tout c'�tait donc bien pass�, les trolls �taient bien form�s et les groupes disciplin�s. Mais le roi avait oubli� un d�tail: la nature profonde des trolls.<br>
	Le spectacle auquel j'assistait �tait grandiose et je ne mis pas longtemps � faire partie des acteurs: comme chaque troll qui avait pass� le portail, le sang monta � ma t�te en apercevant la cr�ature ant�p�ruvienne. Je me mis � hurler et comme mes cong�n�res je commen�ais � bousculer tout le monde, �crasant des pieds et des t�tes, bref c'�tait le bordel et tout les trolls sur placent criaient "elle est pour moi ! Kkwet m'a �lu" et d'autres "pousse toi d'l� que je tape d'abord".<br><br>
	
	Le roi avait bien oubli� quelque chose dans son plan g�nial: aucun plan ne survit au contact d'un troll (d'autant plus quand il est expos� � l'ennemi).<br>

	<?
	tutorial_haut_bas_droit("http://www.pipeshow.net/RM/avatars/Trulk_avatar_bleu.gif", "Trulk (50275)");
}


function hist_liche_Kapootroll_1()
{
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Kapootroll_avatar_bleu.gif", "KapooTroll (13236)");
	?>
	<i>Le petit KapooTroll est attendu par la Liche ... le petit KapooTroll est attendu ...</i><br><br>

	"Bah ui ... j'veux bien moa ... mais j'ai pas encore re�u ma Mega Dover pour lui p�ter sa magie � la vieille ... et sans �a, j'vois pas trop en quoi j'serai utile ... "<br><br>

	<i>C'est � ce moment-l� qu'une �trange bestiole se rapprocha de lui, une potion entre les dents ... �a sentait le gowap, �a marchait comme une gowap ... c'�tait surement un gowap en fait ... sauf que cet abruti ne voulait pas l�cher la potion qu'il tenait dans sa gueule.</i><br><br>

	"Bon ... tu m'�coutes ... tu l�ches �a ou j'te la fais bouffer et c'est toi que j'balance sur la Mamy !"<br><br>

	<i>La cr�ature le regarda, surpris et ind�cis, puis rebroussant chemin, fit mine de s'enfuir.</i><br><br>

	"Oh que non !" Il l'attrapa par la queue et le tira � lui, "tu restes l� ! IL ME FAUT CETTE POTION !"<br>
Il prit alors le Gowap � la gorge et le secoua en tous sens, la potion tomba alors au sol.<br><br>
	
	"Ah ben tu vois quand tu veux", dit-il en reposant le gowap qui ne parvenait plus � aligner ses pattes pour avancer en ligne droite.<br><br>

	<i>KapooTroll se baissa, ramassa la potion qu'il examina ... puis la glissa sous son armure et s'avan�a vers le Portail qui devait l'amener voir la Liche ....</i><br>

	<?
	tutorial_haut_bas_gauche();
}

function hist_liche_Kasseroll_2()
{
	tutorial_haut_bulle_droit();
	?>
	�a y est, la bataille commence. Les trolls s'�lancent du portail, vague apr�s vague. 
	La liche, derri�re son rideau de morts-vivants, beugle des ordres. <br><br>
	Des potions volent dasn les airs et atterissent dans les yeux de quelques morts-vivants, d'autrss tombent au sol. 
	Un nuage de fum�e verd�tre enveloppe deux n�crochores qui venaient de se retourner.<br>
	Le Grand Scribouillard des RelaisMago arrive � franchir le rideau et d�verse le contenu d'une potion sur la face de la liche, rapidement suivi par Kelu et son parchemin.<br>
	Les premi�res attaques fusent, testant la r�sistance de la vieille horreur. <br><br>
	La conclusion, beugl�e � travers les souterrains, est sans appel : elle est rudement en forme pour son �ge.<br>

	<?
	tutorial_haut_bas_droit("http://www.pipeshow.net/RM/avatars/Kasseroll_avatar_bleu.gif", "Kasseroll (18537)");
}

function hist_liche_Jcpoupard()
{
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Jcpoupard_avatar_bleu.gif", "Jean-Christian POUPARD (21352)");
	?>
 Jean-Christian POUPARD �tait super concentr�.<br><br>

	Il transpirait un peu dans ses mocassins mais c'�tait l'�motion de se retrouver dans la m�me caverne que Mme La Liche.<br>
	On l'avait pourtant brieff� que c'�tait une cliente difficile aussi avait-il r�vis� son discours compos� d'arguments commerciaux aussi vaseux que soporifiques.<br><br>
	"Je vais sortir le Grand Jeu, �a va s�rement l'endormir, �a marche � chaque fois".<br>
	
	A peine songeait-il � ouvrir la bouche qu'il sentit un vent glacial lui parcourir l'�chine. La douleur le fit crier. Puis un brouhaha familier titilla ses oreilles.<br><br>

	"Qu'est-ce que je refous l� ?" se dit-il en parcourant du regard l'int�rieur de la Taverne Relais&Mago et constatant qu'un certain nombre de ses mouches avait disparu.<br><br>

	Il compris qu'il avait eu affaire � une sacr�e cliente.<br>

	<?
	tutorial_haut_bas_gauche();
}


function hist_liche_Kapootroll_2()
{
	tutorial_haut_bulle_droit();
	?>
 Ca y �tait ... il traversait enfin le portail.<br>
	Arriv� de l'autre c�t�, les yeux encore remplis de couleurs et formes en tous genres, KapooTroll scruta l'horizon � la recherche de ses compagnons d�j� pass�s ... c'est alors qu'il sentit qu'on lui tapotait l'�paule.<br><br>

	Il se retourna, et se retrouva nez � nez avec Troll Astic, un gros ;.. gros ... gros Kastar, dont il vit que le pied �tait coinc� sous le sien.<br><br>

	"Oups Mr Astic ... excusez-moi ..." c'est alors qu'il entendit un hurlement ... il crut reconna�tre la voix de Jean-Christian, qui, � n'en pas douter, venait de se faire dessouder ...<br><br>

	Il sentit alors une odeur pestine...pasten...pisten... enfin �a schlinguait quoi !<br>
	Il vit alors une grande masse sombre au loin, et se dirigea alors vers elle, mais les effets du Teleport se faisaient encore sentir, et il tr�bucha, tombant de tout son long en avant ... dans un bruit de verre cass�.<br><br>
	
	"MEeeeeeeeeeeeeeeeeeeeeeeeeerde .... la Mega Dover ... p'tin ... LeRoi va m'engueuler � coup s�r ... y m'en faut une autre ... boah, j'en trouverai bien une par l�-bas ..."<br><br>

	Il se redressa et se remit en marche ... au moment o� la Liche appelait � elle encore plus de suivants pour ... la suivre ...<br>

	<?
	tutorial_haut_bas_droit("http://www.pipeshow.net/RM/avatars/Kapootroll_avatar_bleu.gif", "KapooTroll (13236)");
}


function hist_liche_Leroidelaclasse_3()
{
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Leroidelaclasse_avatar_bleu.gif", "Leroidelaclasse (36452)");
	?>
	Pfff encore une de mes pr�cieuses g�ch�e, c'est pas possible !!<br><br>

	Bon, il est reste une, Garbraaaaaaggggggg , il est ou celui l� ??!!<br><br>

	Heureusement que Lobo �tait l�, pas de perte de temps, pile � l'heure, directement sur l'objectif, �a c'est du bon troll !<br><br>

	Bon et ben colle lui une rafale Kapooo fooonnnceeee !!!<br><br>

	Anogh, quoi de neuf du c�t� des hypnos ??<br><br>

	Grognon, tes cogneurs sont en place ??<br>

	<?
	tutorial_haut_bas_gauche();
}


function hist_liche_Kasseroll_3()
{
	tutorial_haut_bulle_droit();
	?>
	Le chaos r�gne sdans la caverne. Assaillie de toute part, la liche titube, les trolls hurlent leur rage et leur envie de sang... Un liquide verd�tre inonde le champ de bataille...
	<?
	tutorial_haut_bas_droit("http://www.pipeshow.net/RM/avatars/Kasseroll_avatar_bleu.gif", "Kasseroll (18537)");
}

function hist_liche_Argowar()
{
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Argowar_avatar_bleu.gif", "Argowar (36881)");
	?>
	-- Derni�re vague go !<br><br>

	<i>Euh finalement ... poussez pas derri�re ... je vous demande de ne pas poussez !"</>
	...
	<i>Qui m'a pouss� ?"</i><br><br>

	Devant moi s'�tendaient les plus grandes grottes du hall que je n'avais jamais vu ! Et il le faut pour abriter tant de monstres aussi puissants.<br>
	Soudain je m'avisai du cadavre d'un troll devant moi, je le connaissait de vu, il faisait partie de ma guilde, un troll dangereux porteur de moustaches et d'un complet cravate ?! En tout cas deux fois plus vieux et quatre fois plus puissant que moi, mort d'une seul baffe de liche, et encore s'il avait r�ussi � l'esquiver le souffle l'aurait renvoyer � la surface d'un seul coup! <br><br>
	
	Seuls les plus vieux duraks, les l�gendes de leur race peuvent esp�rer l'honneur d'une deuxi�me !<br>

	<?
	tutorial_haut_bas_gauche();
}

function hist_liche_Grognon()
{
	tutorial_haut_bulle_droit();
	?>
	<i>Oust !</i>
	<?
	tutorial_haut_bas_droit("http://www.pipeshow.net/RM/avatars/Grognon_avatar_bleu.gif", "Grognon (2690)");
}

function hist_liche_Kasseroll_4()
{
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Kasseroll_avatar_bleu.gif", "Kasseroll (18537)");
	?>
	 <b>CA Y EST !! LA LICHE EST TOMBEE !</b><br><br>

	Grognon le rouge, en une charge surhumaine, a percut� la garde, l'envoyer valdinguer dans les rochers. Le coup �tait parfait , le hurlement puissant. Les morceaux de cr�ne ont vol� dans les souterrains, � ce cri unanime : "IL l'A EU !!"<br><br>

	Les cris de joie et les hurlements de rire ne cessaient de retentir. Chacun avait vu s'effondrer la liche, chacun avait vu le formol verd�tre qui lui tenait lieu de sang �clabousser les murs, mais pourtant personne ne parvenait encore � y croire vraiment.<br><br>

	La liche, la terreur des souterrains, l'�g�rie des Chulzis, le monstre aux 100 meurtres, n'�tait plus. Fatigu�e, �puis�e, d�bord�e par l'�tendue de l'assaut, elle avait tent� de fuir. Face � des dizaines de trolls d�ments, d�couvrant leurs canines, arrachant sa chair morte de leurs dents, elle avait tent� son ultime recours. Et c'est dos � ses adversaires qu'elle fut achev�e, jet�e au sol et pi�tin�e.<br><br>

	Les trolls se congratulaient, se donnaient des grandes tapes dans le dos. Grognon, auteur du coup fatal, fut acclam�. Mais d�j�, la garde de la d�funte liche, dans une fr�n�sie suicidaire, se lan�ait � l'assaut pour venger sa d�testable maitresse. Soit, se dirent les trolls. Remont�s � bloc, ils saisirent leurs armes et accueillirent l'assaut le sourire aux l�vres.<br><br>

	Lou� soit-tu Kkwet, puisse ton esprit nous prot�ger encore longtemps.<br>

	<?
	tutorial_haut_bas_gauche();
}

function hist_liche_Lobo()
{
	tutorial_haut_bulle_droit();
	?>
	La LICHE est morte !!<br>
	Vive l'Union des Trolls !<br>
	Vive GROGNON le pourfendeur !<br>
	Vive LeRoidelaclasse, le Gentil Organisateur !!<br>
	Vive Kkwet qui chaque jour d�verse sa Sainte Huile d'Arachide sur nos visages embu�s d'une joie victorieuse !!<br>
	Vive les tueurs de Liche !!!<br>
	Que ce modeste dessin puisse orner leur profil.<br>
	<?
	tutorial_haut_bas_droit("http://www.pipeshow.net/RM/avatars/Lobo_avatar_bleu.gif", "Lobo (10866)");
}

function hist_liche_Kelu_2()
{
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Kelu_avatar_bleu.gif", "Kelu (43246)");
	?>
	Aujourd'hui serait un grand jour, j'en avais eu la certitude.<br><br>

	Tout au long de mon p�riple au sein de mon groupe de chasse des As-troll-ogs, Les D�kans nous ont montr� la voie. Et tout particuli�rement Saint Kaprikornu, � qui nous d�dions souvent une petite pri�re avant de nous jeter au combat.<br>
	Mais depuis quelques temps, je ne ressentais plus sa pr�sence autour de nous...or, cette nuit, j'ai eu une vision:<br><br>

	Saint Kaprikornu et kkwet dansaient ensemble sur un air de rumba.<br><br>

	C'�tait un signe, mes compagnons! <br><br>

	Kelu, fier d'avoir particip� � sa premi�re graaaaande action, et encore plus fier de l'avoir fait aux c�t�s de nombre de ses compagnons de guilde.<br>

	<?
	tutorial_haut_bas_gauche();
}

function hist_liche_Kasseroll_5()
{
	tutorial_haut_bulle_droit();
	?>
	Dans les sombres souterrains, les profondeurs de la terre,<br>
	Parmi les restes enfouis des trolls de lancien temps,<br>
	L� o� r�gnent le behemoth et le golem de fer,<br>
	On entends parfois, se m�lant aux puissants rugissements<br>
	Comme entrecoup�e de sanglots une plainte lancinante.<br>
	Trolls, tremblez ! Car cest l� la voix de la liche !<br>
	De toutes les horreurs la plus grande et terrifiante ;<br>
	Jadis un troll, de pouvoir trop avide et de magie trop riche.<br>
	Il hante d�sormais les terres d�vast�es par sa pr�sence,<br>
	Cherchant lassouvissement de ses passions primaires :<br>
	Sa vie est maintenant faite de meurtres et de violence,<br>
	Et nul aujourdhui ne remonte des profondeurs de la terre.<br><br><br>


	Qui aura laudace de chasser ce cauchemar ambulant,<br>
	Qui pourra reconqu�rir les terres quelle nous a vol� ?<br>
	Car nen d�plaise aux Chulzis, le Hall est n�tre assur�ment<br>
	Et aucun mort-vivant jamais ne pourra le r�clamer !<br>
	Mais voil� que savance, le gigantesque et viril,<br>
	Chef des Relais&Mago, Tackianosaurus linou� !<br>
	A son c�t�, qui vois-je, Zoulou tout bard� de mithril<br>
	De lExp�rience Interdite ! Mais maintenant jou�s<br>
	Comme une m�lop�e, ne serait-ce pas un troll farceur<br>
	Tra�nant un elfe et un panier de pommes entre les dents ?<br>
	Avec dautres, tant dautres, ils partent courage au c�ur<br>
	De nos verts souterrains chasser ce cauchemar ambulant.<br><br><br>

	Dans une caverne profonde retentit un sinistre craquement :<br>
	Comme une arme quon aiguise, une armure quon fourbit.<br>
	Dans la taverne dHeliacyn, chacun se pr�pare ardemment<br>
	A laffrontement, chacun sait quil peut y laisser la vie.<br>
	Les fanfaronnades se succ�dent, mais au s�rieux fait place<br>
	Dans la petite pi�ce o� les ma�tres tacticiens devisent.<br>
	� Le plan doit �tre impeccable �, dit leroidelaclasse,<br>
	� Contre un tel adversaire nulle erreur nest permise �<br>
	Un grand portail magique est ouvert le lendemain<br>
	Vers le monstre quils combattront vaillamment.<br>
	Les premi�res escouades avancent armes � la mains,<br>
	Et derri�re le portail retentit un sinistre craquement.<br><br><br>
	
	Le combat commence, il pleut du sang et des tripes !<br>
	R�fugi�e derri�re sa garde, l�che g�n�ral, la liche crie<br>
	Les trolls veulent latteindre mais les morts les agrippent<br>
	Et d�j� tombe un brave, premi�re victime de sa magie.<br>
	Le combat est acharn�, moult potions sont d�vers�es<br>
	Rongeant la peau morte comme lacide ronge la lame.<br>
	Des muscles gonflent lorsque les parchemins sont prononc�s<br>
	Et chaque troll ressent lappel du combat au creux de son �me.<br>
	Lagilit� de lanc�tre tient en respect des guerriers de valeurs,<br>
	Mais voil� que savance Poupard, moustache sur la lippe,<br>
	Ralentissant ses mouvements par son regard enj�leur.<br>
	Echec ! Gigolo mort, il pleut du sang et des tripes.<br><br><br>
	
	
	Avec horreur les trolls voient tomber au sol un cr�ne bris�.<br>
	Rendus fous par la rage et le chagrin, avides de carnage,<br>
	Par la sinistre mal�diction de la liche leurs force diminu�es,<br>
	Ils combattent n�anmoins avec toujours plus de courage.<br>
	Les coups sencha�nent sans r�pit sur lindomptable cr�ature,<br>
	Port�s par jeunes et vieux, du plus humble au plus puissant.<br>
	Las ! Rien ne semble devoir entamer un peu son armure<br>
	Et d�j� les trolls commencent � douter, lespoir samenuisant.<br>
	Quoi ? Voil� quun troll se dresse, que rien ne semble troubler.<br>
	Cest Grognon le Rouge, le sage, le vaillant, h�ros v�n�r� !<br>
	Reprenant courage, les autres frappent � coups redoubl�s , ;<br>
	Grognon charge, faisant tomber au sol un cr�ne bris�.<br><br><br>
	
	Se fait entendre dans la grotte un derni�re g�missement.<br>
	Chacun peine � y croire : d�j�, la chair redevient poussi�re.<br>
	Les trolls hurlent leur joie, les morts-vivants larmoyants<br>
	Tentent de fuir, mais ceci personne ne les laisse faire.<br>
	Sur les cadavres ennemis, peuvent c�l�brer les vainqueurs<br>
	Les h�ros du jours ! Salut � toi Grognon, et toi le strat�ge,<br>
	B�ni soit Kkwet pour ta bravoure, que nul noublie ton ardeur !<br>
	Merci � toi aussi pour ton parchemin, et toi pour ton sortil�ge !<br>
	D�sormais, la mort ne r�dera plus dans les sombres souterrains ;<br>
	Le Hall sera n�tre, tant que nous combattrons aussi ardemment.<br>
	Face � des trolls d�cid�s, jamais une liche ne sera rien !<br><br><br>
	
	Se fait entendre dans une grotte un premier g�missement.<br>

	<?
	tutorial_haut_bas_droit("http://www.pipeshow.net/RM/avatars/Kasseroll_avatar_bleu.gif", "Kasseroll (18537)");
}

function hist_liche_Domfada()
{
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Domfada_avatar_bleu.gif", "DomFada (39684)");
	?>
	Que dire qui n'ait d�ja �t� dit ? Que rajouter aux verbe haut de Trulk, a la voix mielleuse de Kasseroll, aux �vocations fantastiques de Rouminch ? Peut-�tre simplement un r�cit de ce que j'ai vu et v�cu en ces jours de folie.<br><br>

	Pour nombre d'entre nous, le dernier mois fut... diff�rent. Chacun se livrait a ses habituelles occupations, chassant le monstre pour le r�ti du soir, ramassant champignons et gigots de gob', commer�ant avec d'autres trolls de passage. Mais au fur et a mesure que les jours passait, les regards se faisait plus lointains, les visages semblaient se fermer. Chacun savait que du voyage qui se pr�parait, bien peu reviendrait vivants.<br><br>

	L'ordre arriva. Se rendre en un certain lieu, a une certaine heure, et attendre que s'ouvre le portail. Le coeur s'acc�l�re, le sang commence a battre dans les tempes. Cette fois, c'est parti. Le portail pass�, je restais la, bouche b�e, ahuri par le nombre de trolls rassembl�. Et il en venait toujours plus, passant a travers le portail sans un mot. Alors commenca l'attente.<br><br>

	R�trospectivement, c'est ce qui fut le plus dur. Attendre, la, bien plus bas que la plupart n'avait jamais os� descendre, bien trop bas pour beaucoup, dont moi. Hallucin�, je me vis affronter des horreurs sans nom, d'une puissance suffisante pour me couper en deux d'un simple coup de griffe, me demandant a chaque instant si je verrai le terme du voyage. Enfin, il fut l'heure de passer le dernier portail, et d'affronter la Liche.<br><br>

	Sur le deroulement du combat, les mouvements de troupes, la coordination des attaquants, je ne dirais rien, car je n'en ai rien vu. Oh, j'entendais bien au loin la voix du Roi de la Classe qui hurlait des ordres, mais la peur m'emp�chait d'y rien comprendre.<br><br>

	Je passe le seuil, �merge dans une caverne aux murs couverts d'un lichen vert-de-gris. Cherchant des yeux la Liche, je m'apercois avec horreur qu'elle est loin, beaucoup trop loin. Je cours a m'en faire crever les poumons, zigzaguant entre les trolls, en pi�tinant souvent. J'arrive sur elle, et plante mon regard dans le sien. La terreur me noue la gorge. Moi ? Hypnotiser CA ? cette terreur venue du fond des ages du Hall, cette... chose innommable qui vient d'eventrer un troll deux fois plus gros que moi ? Son corps est couvert de blessures profondes, elle ne semble plus tenir debout que par la force de sa volont�, et pourtant elle me rie au visage. Je suis trop �puis� par ma course folle pour utiliser le moindre pouvoir, alors, dans un geste d�sesp�r�, j'aggrippe une fiole de toxine qui ne tuerait m�me pas un rat g�ant, et m'appr�te a lui �craser sur la figure dans un dernier geste, assez d�risoire. Dans ses yeux, je lis la mort - la mienne.<br><br>

	Et soudain, je vois sa poitrine qui se d�forme, puis se d�chire, et la main gant�e de Grognon d�chire les chairs mortes et apparait devant moi. Son poing reste ferm� un instant, puis deux doigts se tendent, formant le V de la victoire.<br><br>

	Fini. D�ja. Je n'ai rien fait, pas port� un coup, rien. Et pourtant, j'ai le sentiment d'avoir particip� � quelque chose de splendide, de sauvage.<br><br>

	En regardant Grognon, qui sans attendre se tourne vers les monstres de la garde, je m'apercois qu'un liquide chaud coule le long de mes chausses...<br>

	<?
	tutorial_haut_bas_gauche();
}

function hist_liche_Bodega_2()
{
	tutorial_haut_bulle_droit();
	?>
	Merci � tous les <? echo RELAISMAGO ?>  pour les r�cits.<br><br>
	
	Il y a aussi d'autres r�cits sur cette fabuleuse histoire : <br>

	<img src="/images/puce.gif">  <a class="AllLinks" href='http://www.mountyhall.com/mountyhall/Forum/display_topic_threads.php?ForumID=11&TopicID=49763&PagePosition=1' >Journal d'un runeur de Liche, �crit par Rouminch (35708)</a>
	<br>
	<img src="/images/puce.gif">  <a class="AllLinks" href='http://experience-interdite.forumactif.com/ftopic450_Journal_des_Guerriers_de_la_Liche.htm'>Journal des Guerriers de la Liche</a>
	<br>
	<img src="/images/puce.gif">  <a class="AllLinks" href='http://www.mountyhall.com/mountyhall/Forum/display_topic_threads.php?ForumID=11&TopicID=49646&PagePosition=1'>Thread sur les forums Mountyhall</a>
	

	<?
	tutorial_haut_bas_droit("http://www.pipeshow.net/RM/avatars/Bodega_avatar_bleu.gif", "Bod�ga (49145)");
}
?>
