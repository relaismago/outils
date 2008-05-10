<?

require_once('../top.php');
init();
require_once('../foot.php');

function init() 
{
	afficher_titre_tableau("La grève des Tenanciers");


	tutorial_haut();

	echo "<br><br>";

	hist_greve_Leroidelaclasse_1();
	hist_greve_HeSrkim_1();
	hist_greve_Leroidelaclasse_2();
	hist_greve_HeSrkim_2();
	hist_greve_Leroidelaclasse_3();
	hist_greve_HeSrkim_3();
	hist_greve_trollichon_1();
	hist_greve_silkette_1();
	hist_greve_trollichon_2();
	hist_greve_HeSrkim_4();
	hist_greve_Kapootroll_1();
	hist_greve_Mmago_1();
	hist_greve_Korskarn_1();
	hist_greve_Argowar_1();
	hist_greve_Lobo_1();
	hist_greve_HeSrkim_5();
	hist_greve_Leroidelaclasse_4();
	hist_greve_HeSrkim_6();
	hist_greve_Minhothort_1();
	hist_greve_Leroidelaclasse_5();
	hist_greve_HeSrkim_7();
	
	echo "<br><br>";
	echo "<br><br>";
	tutorial_bas();
}


function hist_greve_Leroidelaclasse_1()
{
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Leroidelaclasse_avatar_bleu.gif", "Leroidelaclasse (36452)");
	?>Mais comment se fait-il qu'il n'y ait pas de lumière là-dedans !? D'habitude, la Bibliotek est toujours éclairée des lampes à huile et animée des éclats de rires de nos camarades Relais & Mago !<br><br>
	  Où sont-ils donc tous !? surtout qu'il est largement temps de se pencher sur la scribiture du prochain mundidey !<br> 
<br>
<i><b>Leroidelaclasse</b> s'étonnait de cette obscurité et de ce silence inhabituels et entendit soudain un léger frémissement dans l'un des recoins de l'imposante tanière.</i>
<?
	tutorial_haut_bas_gauche();
}

function hist_greve_HeSrkim_1()
{
	tutorial_haut_bulle_droit();
	?>
Je suis ici cher ami.
Je suis seul dans cette pièce depuis déjà de trop nombreux jours.<br><br>
Personne n'est venu, personne n'a répondu à mes appels.<br><br>
L'art de vivre des scribes me semble révolu : même les précurseurs <b>Grognon</b> et <b>Kassonade</b> se sont épuisés à la tâche 
et ont fini par abandonner.<br> Ah, si seulement on pouvait assurer leur relève...<br><br>
Mais ce n'est pas avec les rares plumes de phoenix qui traînent dans l'armoire et ces pauvres parchemins
encore tout gribouillés que nous pourrons nous en montrer dignes.
Nous avons de moins en moins d'ingrédients pour la scribiture.<br>
<br>
Je me sens si abandonné par tous... aaaaaaah<br><br>
<i>Et c'est 
  dans un souffle qui en disait long sur son atterrement qu'il rebaissa 
  la tête...</i> <b><i>Hé Skrim</i></b><i>, à la silhouette si digne 
  et élégante n'était devenu que l'ombre d'un vieux fantôme, 
  affaissé sur le bord d'une table...</i>
<?
	tutorial_haut_bas_droit("http://www.pipeshow.net/RM/avatars/Heskrim_avatar_bleu.gif", "Hé ! Skrim !!!! (26038)");
}

function hist_greve_Leroidelaclasse_2()
{
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Leroidelaclasse_avatar_bleu.gif", "Leroidelaclasse (36452)");
	?>Mais comment notre guilde, si brillante et dynamique auparavant, en est-elle arrivée là ?<?
	tutorial_haut_bas_gauche();
}

function hist_greve_HeSrkim_2()
{
	tutorial_haut_bulle_droit();
	?>Oh, il ne suffit de pas grand chose.<br><br>
	Regardez le nombre de nos compagnons qui ne partagent plus leur butin de chasse,
	qui ne grattent plus sous prétexte que leurs gigots de gob sont devenus importants pour leurs enchantements
	personnels, leurs négociations privées... Mais ils sont bien contents de nous trouver quand on peut leur
	rendre service : la guilde est gangrenée par l'individualisme de certains !<br><br>
	Et dire que le Conseil ne répond pas à nos multiples appels...
<?
	tutorial_haut_bas_droit("http://www.pipeshow.net/RM/avatars/Heskrim_avatar_bleu.gif", "Hé ! Skrim !!!! (26038)");
}

function hist_greve_Leroidelaclasse_3()
{
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Leroidelaclasse_avatar_bleu.gif", "Leroidelaclasse (36452)");
	?>Il est vrai qu'avant, chaque groupe avait son gratteur, alors que maintenant tout le monde 
	économise pour son enchantement. 
	<br><br><i>Un instant de nostalgie flotta au-dessus de leurs têtes avant que Hé Skrim ne se 
	lève brusquement.</i><?
	tutorial_haut_bas_gauche();
}

function hist_greve_HeSrkim_3()
{
	tutorial_haut_bulle_droit();
	?>Nous n'avons qu'à faire la Grève ! C'est un vieux concept employé dans les cas d'extrême urgence comme
	 celui-ci : ça consiste à volontairement pourrir la vie de nos collègues de Guilde pour obtenir de la 
	 reconnaissance mais surtout des moyens. Tout ceci dans le but de déclencher une prise de conscience 
	 collective de nos problèmes qui sont d'ailleurs aussi leurs problèmes.

<br><br>Il va nous falloir du renfort dans cette opération, les clés des Grandes Tanières de la guilde par 
exemple, je me charge de suite de la Bibliotek mais nous devrions en parler à Messire <b>troll'ichon</b>, voir ce 
qu'il en pense du côté  de la Taverne.... Je lui fais parvenir une de mes plus belles chauves souris et 
attends son point de vue la dessus. 

<br><br><i>L'esprit de <b>Hé ! Skrim !!!</b> s'emballait et ses mots retentissaient en même temps que ses 
pensées, donnant une impression d'énergie capable de réchauffer cette pièce encore si froide.</i>
<?
	tutorial_haut_bas_droit("http://www.pipeshow.net/RM/avatars/Heskrim_avatar_bleu.gif", "Hé ! Skrim !!!! (26038)");
}

function hist_greve_trollichon_1()
{
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Trollichon_avatar_bleu.gif", "Troll'ichon (42637)");
	?><i>Comme à son habitude de si beau matin, <b>trollich</b> faisait ses comptes en observant du coin de l'oeil 
	si le derrière de  <b>silkette</b> nettoyait avec toujours autant d'enthousiasme les vieux gros morceaux de
	bois qui servent de tables à la Taverne. Il fut interrompu par un petit cri qu'il reconnaissait entre 
	mille : une chauve-souris s'était engouffrée par l'une des fenêtres ouvertes de la Taverne 
	pour parvenir jusqu'au comptoir où <b>trollich</b> s'était assis. Il n'avait pas besoin d'ouvrir la missive 
	pour deviner qui en était son expéditeur : la chauve souris était on ne peut plus polie, avec un joli 
	ruban pourpre autour du cou et une délicate odeur de parfum se dégageait de derrière ses oreilles... 
	Il la remercia et la fit patienter le temps de lire les intentions de son maître...</i> 
	<br><br>LA GREVE A LA BIBLIO !? ET LES SCRIBES EN PLUS... EN RAISON DU MANQUE DE MOYENS ET DE 
	RECONNAISSANCE DE NOS CLIENTS !?!
	<br><br>T'entends ça <b>Silkette</b> ?! Messire <b>Hé ! Skrim !!!</b> et les scribes de la biblio sont en grève depuis hier soir !!
	<?
	tutorial_haut_bas_gauche();
}

function hist_greve_silkette_1()
{
	tutorial_haut_bulle_droit();
	?><i>Les mains collées sur ses oreilles, et hochait la tête en signe d'affirmation...</i><br><br>
	ça ne nous ferait pas de mal non plus de s'arrêter et de montrer à nos ivrognes que boire est une chose, 
	mais qu'aider la communauté en est une autre !!
<?
	tutorial_haut_bas_droit("http://www.pipeshow.net/RM/avatars/Silkette_avatar_bleu.gif", "Silkette (21304)");
}

function hist_greve_trollichon_2()
{
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Trollichon_avatar_bleu.gif", "Troll'ichon (42637)");
	?>C'est exactement ce que j'allais te proposer ! Rallions-nous à leur mouvement en signe de solidarité !!
	 Je les comprends les pauvres scribes, au service de la guilde, de plus en plus sollicités... 
	 et pour quoi ? pour se faire engueuler quand une attribution ne plait pas à certains.<br><br> 

<i>Et c'est la mine décidée que <b>trollich</b> fit alors le tour de la taverne, 
   coupa les robinets des différentes barriques de calvok, rangea les tabourets au placard, 
   ferma les volets des fenêtres, et barra la porte sans oublier avant de placarder un petit écriteau :</i>  

<br><br><center>"GREVE DES TENANCIERS POUR FOUTAGE DE GUEULE"</center> 
	<?
	tutorial_haut_bas_gauche();
}

function hist_greve_HeSrkim_4()
{
	tutorial_haut_bulle_droit();
	?><i><b>Hé ! Skrim !!!</b> allongé sur un vieux reste de peau de Behemoth regardait le plafond, l'air absent
	 lorsqu'il vit une chauve-souris tenter un "touch-and-go" approximatif...</i> 
	<br><br>Tiens, revoici Tontine, ma précieuse messagère envoyé il y a peu chez Messire <b>troll'ichon</b>.
	Mais, diantre de saperlipopette de sacreubleu de crénom de bonsoir, dans quel état te trouves-tu 
	ma Tontine !?!?! Encore Messire <b>troll'ichon</b> qui t'a fait passer un sale quart d'heure de chauve souris
	 éthylique... Aaaahhh ce troll'ich incurable avec son calvok de seconde zone... Heureusement qu'il n'a 
	 pas trouvé tous les fûts de la réserve spéciale la dernière fois. Tiens Tontine est porteuse d'un 
	 message...
	<br> <br>
	Messire <b>Leroi</b>, c'est une grande nouvelle !!!!! Messire <b>troll'ichon</b> et Dame <b>Silkette</b> nous rejoignent
	dans notre action, n'est ce point là une excellente nouvelle ? Je savais que l'on pouvait compter sur 
	eux ! Ils partagent les mêmes valeurs que nous et que celle de la guilde !
	<br><br>
	Il serait désormais fort important que  Messire <b>Uthal</b> nous rejoigne lui aussi : nous pourrons ainsi 
	fermer toutes les GTs... Je n'aime décidément pas ces pratiques mais il semble que ce soit hélas la 
	meilleure solution de faire réagir ces satanés bourricots de trolls ! Oups, si Messire <b>troll'ichon</b> 
	m'entendait, cela l'insupporterait que je parle ainsi de son fidèle destrier...
<?
	tutorial_haut_bas_droit("http://www.pipeshow.net/RM/avatars/Heskrim_avatar_bleu.gif", "Hé ! Skrim !!!! (26038)");
}

function hist_greve_Kapootroll_1()
{
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Kapootroll_avatar_bleu.gif", "KapooTroll (13236)");
	?><i>Toujours fidèle au poste 
  pour dépanner au comptoir et vider un tonnal de calvok, le vieux </i>
  <b><i>Kapootroll</i></b><i> était un peu la mémoire vivante de 
  la guilde...</i><br>
  <p align="justify">N'ayez crainte 
  Messire, je suis certain que les R&amp;M ont un bon fond et qu'ils comprendront 
  très vite ce qui se trame pour agir en conséquence et donner du meilleur 
  d'eux pour que notre guilde retrouve enfin toute sa splendeur !</p>

	<?
	tutorial_haut_bas_gauche();
}

function hist_greve_Mmago_1()
{
	tutorial_haut_bulle_droit();
	?><i>En haut de la Taverne, 
  dans une petite chambre, un troll ronfle. La soirée avait été arrosée, 
  le crâne de </i><b><i>Mmago</i></b><i> vrombit quand il ouvrit un 
  oeil</i>
  <p align="justify"><i>Descendant 
  les marches de la Taverne d'un air hagard, il repassa devant les grandes 
  toiles représentant les heures glorieuses de la Guilde. Que de temps, 
  que d'aventures vécues. D'un coup, une chose percuta son esprit. Rien. 
  Pas de bruit. La salle principale était vide, il n'y avait plus personne, 
  les fûts étaient fermés, le bar recouvert. </i>
  <b><i>Silkette</i></b><i> n'était pas en vue, aucune marmite ne mijotait 
  sur le feu éteint.</i></p>
  <p align="justify"><i>Il se dirigea 
  vers la porte. Il déverrouilla le loquet, arracha ce qu'il reconnut 
  avec stupéfaction comme des planches barrant la porte et regarda médusé 
  un écriteau.</i>&nbsp;<br></p>

  <p>Ben alors quoi ? Qu'est-ce 
  qui est écrit ici ??&nbsp;<br></p>
  <p align="center">"GREVE 
  DES TENANCIERS POUR FOUTAGE DE GUEULE"&nbsp;<br></p>
  <p align="justify"><i>&nbsp;<br>
  </i>EN GREVE ????? Quoi en grève ? Comment ça en grève ? Mais ce 
  n'est pas POSSIBLE d'être en grève. C'est terrible, nous allons finir 
  comme le Clan des Trolls d'Hassan Céhef, le blocage de la guilde pendant 
  des semaines, les TP bloqués, les services fermés, les Tanières inaccessibles.</p>
<?
	tutorial_haut_bas_droit("http://www.pipeshow.net/RM/avatars/Mmago_avatar_bleu.gif", "Mmago (68726)");
}

function hist_greve_Korskarn_1()
{
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Korskarn_avatar_bleu.gif", "kor-skarn (69322)");
	?><i>Ses compagnons de chambrée </i>
  <b><i>kor-skarn </i></b><i>et </i><b><i>Argowar </i></b>
  <i>furent les premiers avertis de la nouvelle.</i><b><i> 
  Kor-Skarn</i></b><i> n'aimait pas être réveillé en sursaut.... encore 
  moins quand il avait trop bu de calvok la veille&nbsp;: il avait l'impression 
  que des dizaines de shaïs sautillaient à l'intérieur de son crâne. 
  Faut dire qu'avec ses amis de la </i><font color="#008000" size="2"><b><i>Garde 
  Emeraude</i></b></font><i>, ils 
  avaient dignement fêté leur nouveau stage de bronzage.</i>&nbsp;<br>

  <p align="justify">Une nouvelle 
  comme ça fait sacrement vite décuver&nbsp;! Même si je ne comprends rien 
  à la scribiture, j'ai un profond respect pour les scribes de la Guilde&nbsp;: 
  ils passent leur temps à se tordre les méninges, à se lancer dans 
  de drôles de transe et à griffonner sur des parchemins. Tout ce que 
  je sais, c'est que ça permet d'augmenter considérablement les 
  capacités des autres trolls qui en bénéficient.
	<?
	tutorial_haut_bas_gauche();
}

function hist_greve_Argowar_1()
{
	tutorial_haut_bulle_droit();
	?><i>Avec </i>
  <b><i>Mmago </i></b><i>tous 3 rejoignirent la Bibliotek pour obtenir 
  plus d'informations et accoururent vers leur </i>
  <b><i>Vénéré Chef</i></b><i> </i>
  <b><i>Lobo</i></b><i> qui était sur le seuil de la porte.&nbsp;<br>
  </i>

  <p><b>Chef, Chef,</b> faut faire 
  quelque chose, les scribes font grève, il n'y a plus de compos prios, 
  plus de parchos vierges. Il faut qu'on aille en chercher, viiiite !! 
  On peut pas rester comme ça !!!
  <?
	tutorial_haut_bas_droit("http://www.pipeshow.net/RM/avatars/Argowar_avatar_bleu.gif", "Argowar (36881)");
}

function hist_greve_Lobo_1()
{
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Lobo_avatar_bleu.gif", "Lobo (10866)");
	?><i>Ne les ayant pas entendu 
  s'approcher, </i><b><i>Lobo </i></b>
  <i>sursauta à leur arrivée et manqua de peu de s'étrangler...</i>&nbsp;<br>
  <p align="justify">Comment ça 
  les GTs fermées&nbsp;!? Pas d'inquiétude, j'ai les clefs...Mmmhh ! Où 
  est ce que j'ai foutu mes clés de la Biblio ? </p>
  <p align="justify">Ho He ! Ouvrez, 
  c'est moi, <b>Lobo</b> ! Arhh c'est pas vrai ça ! BLAM BLAM BLAM ! 
  Mais vous allez ouvrir ou faut casser la porte ! Je sais bien que je 
  sais à peine lire mais en tant que Chef j'ai tout de même le droit 
  d'entrer dans la Bibliothèque !! &nbsp;<br></p>

  <p align="justify">Tiens, mais 
  qu'est-ce qui est inscrit sur ce morceau de papier cloué à la porte&nbsp;!? </p>
  <p align="justify">Ggggg.... 
  Grrrrr.... Greuuuuu.... Greuveu. Greuveu ? GRÈVE !! Ils sont en grève 
  ! Ah ben c'est la meilleure celle là ! </p>
  <p align="justify">VOUS ETES 
  PAS BIEN ICI ??? ENFERMES DANS CES MURS A RECOPIER des sorts pour les 
  autres plutôt que tuer des monstres... </p>
  <p align="justify">M'ouais... 
  je ne peux pas leur en vouloir... Ils ont quand même un boulot de chien 
  ! Eux aussi ils ont le droit d'aller se dégourdir les mollets après 
  tout. Et puis quand le reste de la Guilde réclamera des sorts, elle 
  se bougera peut être l'oignon pour leur fournir ce qu'il faut... </p>
  <p align="justify">BON ! J'Y 
  VAIS MOI ! CHANGEZ VOUS L'ESPRIT ! On a encore besoin de vous quand 
  même...
	<?
	tutorial_haut_bas_gauche();
}

function hist_greve_HeSrkim_5()
{
	tutorial_haut_bulle_droit();
	?>BLAM BLAM BLAM !&nbsp;<br>
  <p align="justify">Diantre de 
  saperlipopette, n'auraient ils pas encore compris ! Je savais ces trolls 
  avilis par tant de chasse aléatoire, tant de recherche assidue de ces 
  satanés Gigots de Gob... Mais de là à tambouriner de la sorte sur 
  cette pauvre porte qui n'a rien fait à personne...</p>
  <p align="justify">Sacreubleu, 
  Messire <b>leroi</b> ! Notre retranchement et notre action sont déjà 
  arrivés au sommet de notre guilde ! Voila Monseigneur <b>Lobo</b> en 
  personne qui frappe à la porte... et il semble comprendre notre mouvement 
  ! Je n'ose y croire !&nbsp;<br></p>
  <p align="justify">Attendez cher 
  ami, voilà que je reçois un message de mon Porc-Table&nbsp;: et devinez 
  quoi Messire <b>leroi</b>, ne voilà-t-il pas que l'on me demande si 
  je compte copier "Invisibilité" !!!! </p>

  <p align="justify">N'est elle 
  pas excellente celle ci ??? Attendez, je lis la deuxième parce que 
  si elles sont toutes dans ce goût-là, on a pas fini de se frapper 
  la panse Messire <b>leroi</b> !
<?
	tutorial_haut_bas_droit("http://www.pipeshow.net/RM/avatars/Heskrim_avatar_bleu.gif", "Hé ! Skrim !!!! (26038)");
}

function hist_greve_Leroidelaclasse_4()
{
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Leroidelaclasse_avatar_bleu.gif", "Leroidelaclasse (36452)");
	?>
	<i>Messire </i>
  <b><i>leroi</i></b><i> esquissa un léger sourire regroupant consternation 
  et amusement.</i>&nbsp;<br>
  &nbsp;<br>
  Allez y, ouvrez la deuxième, sûrement l'annonce de PVs en arrivée 
  non ?
	<?
	tutorial_haut_bas_gauche();
}

function hist_greve_HeSrkim_6()
{
	tutorial_haut_bulle_droit();
	?>Saperlipopette, on en est 
  loin Messire&nbsp;!! Ouh là, alors là, c'est du lourd Messire, si vous me 
  permettez l'expression... Et si je vous disais qu'un déserteur vient 
  d'un coup de refaire surface pour quémander qu'on lui débloque quelques 
  items de la Biblio ? Et qu'en plus, il m'informe du caractère urgent 
  de sa demande !
  <p align="justify">Je tairai 
  son nom Messire, nous ne sommes pas délateurs non plus... une chose 
  est certaine, grand est ce zumain qui chante : "On reconnaît le 
  bonheur parait-il, au bruit qu'il fait quand il s'en va" </p>
  <p align="justify">&nbsp;<br>
  Maintenant, je vais faire un peu de rangement dans la Bibly, classer, 
  déclasser, reclasser, préparer, trier, aligner, dénombrer tout ce 
  stock. Je m'en vais préparer quelques packs pour gratteurs, faire le 
  point sur les compos critiques manquants.. Bref, mon boulot quoi ! Et 
  j'attendrais que chacun fasse le sien avant de réfléchir à autre 
  chose...
<?
	tutorial_haut_bas_droit("http://www.pipeshow.net/RM/avatars/Heskrim_avatar_bleu.gif", "Hé ! Skrim !!!! (26038)");
}

function hist_greve_Minhothort_1()
{
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Minhothort_avatar_bleu.gif", "Minh O'Thort (58454)");
	?>
	<i>Plusieurs trolls se regroupaient 
  devant la porte bloquée de la Tanière, surpris de ne pas trouver l'accueil 
  chaleureux habituel. </i><b><i>Hé Skrim</i></b><i> était capable de 
  reconnaître chacun d'eux au son de leurs voix tellement c'étaient 
  des habitués de son comptoir. Il entendit la voix de </i>
  <b>Minh O'Thort</b><i>.</i>&nbsp;<br>
  <p align="justify">Ben, c'est 
  calme ici, qu'est-ce que vous faites ?! On ne peut plus entrer dans 
  la biblio&nbsp;!?! En grève, on a plus qu'à écouter les chansons d'<b>Argowar</b> 
  et sa mandoline...
	<?
	tutorial_haut_bas_gauche();
}

function hist_greve_Leroidelaclasse_5()
{
	tutorial_haut_bulle_droit();
	?>Il nous reste un peu plus 
  de deux Mundideys avant le prochain Mundidey du Goblin très favorable 
  à la scribiture. Des décisions fortes doivent être prises pour restaurer 
  l'esprit de Guilde que beaucoup semblent avoir perdu. Si la grève doit 
  durer elle durera.
  <p align="center"><br>
  Un jour viendra notre Guilde se réveillera&nbsp;<br>
  Solidarité et cohésion elle retrouvera.&nbsp;<br>
  Et tous ensemble nous fêterons&nbsp;<br>
  Le retour des sortilèges à profusion.
<?
	tutorial_haut_bas_droit("http://www.pipeshow.net/RM/avatars/Leroidelaclasse_avatar_bleu.gif", "Leroidelaclasse (36452)");
}

function hist_greve_HeSrkim_7()
{
	tutorial_haut_bulle_gauche("http://www.pipeshow.net/RM/avatars/Heskrim_avatar_bleu.gif", "Hé ! Skrim !!!! (26038)");
	?><i>Hé ! 
  Skrim !!!!</i></b><i> acquiesça en dodelinant du chef, les paroles 
  de Messire </i><b><i>leroi</i></b><i> et rajouta d'un ton ferme et déterminé, 
  interceptant par la même occasion une nouvelle chauve-souris :</i>
  <p align="justify">&nbsp;<br>
  Vous avez grandement raison, le Goblin à venir sera décisif pour 
  la poursuite de notre petite entreprise qui hélas, connaît à ce jour 
  la crise.</p>
  <p align="justify">DIANTRE !!!!!! 
  QUE LIS-JE ???????...&nbsp;"Si on plus rien à attendre de la guilde, 
  autant faire notre business tranquillement dans notre coin !"</p>

  <p align="justify">Mais diantre 
  de saperlipopette ils sont fous ces trolls ou bien ? Faire leur business 
  dans leur coin en se servant allègrement dans le stock de la guilde 
  ! Messire <b>leroi</b>, est-ce moi ou bien ceci est un grave manquement 
  aux règles essentielles de la guilde qui se veulent prôner partage 
  et travail d'équipe ?</p>
  <p align="justify">Comment osent-ils 
  ? Comment en sont ils arrivés là ?<i> </i></p>
  <p align="justify">en tout cas, 
  je ne saurais en porter la responsabilité comme Maitre Scribe aussi, 
  peut être est il temps pour moi de réfléchir plus précisément à 
  la suite des évènements... Mais sachez que ma décision est prise, 
  le Goblin prochain sera décisif...
<?
	tutorial_haut_bas_gauche();
}

?>
