<?

/****** Varibables globales pour les scripts pubics *****/
/* Nombre de refresh maximum dans la cat�gorie classiques*/
define('NB_MAX_CLASSIQUES', 24);
 
/* Nombre de refresh maximum dans la cat�gorie equipement*/
define('NB_MAX_EQUIPEMENT', 8);

/* Nombre de refresh maximum dans la cat�gorie messages*/
define('NB_MAX_MESSAGES', 12);

/* Nombre de refresh maximum dans la cat�gorie compteurs_appels*/
define('NB_MAX_COMPTEURS_APPELS', 4);


/* Nombre de refresh autoris�s pour la guilde
=> soit un troll qui rafraichit la vue d'un autre troll
=> soit l'utilisation par les scripts publics */
define('NB_REFRESH_VUE_2D_BY_GUILDE', 4);


/* Nombre de refresh total autoris�s pour la vue2d
Ce nombre comprend le nombre de refresh par la guilde
Exemple : si la guilde rafraichit 4 fois, que le troll lui
m�me rafraichit 14 fois, alors, il n'est plus possible d'utiliser
les scripts publics pour rafraichir la vue.
*/
define('NB_REFRESH_VUE_2D_BY_TROLL', 18);

/* Nombre de refresh du magasin autoris�s pour la guilde.*/
define('NB_REFRESH_MAGASIN_BY_GUILDE','1');

/****** Varibables globales pour la vue 2d *****/
/* Limitation du brouillard de guerre � n case, pour �viter
   de charger le serveur */
define('LIMITE_CASES_BROUILLARD',10);

/** Taille de vue par d�faut dans la vue2d **/
define('LIMITE_VUE_DEFAUT',3);
/** Taille de vue maximum dans la vue2d **/
define('LIMITE_MAX_VUE',25);

/** Taille en PA du trollometer par d�faut (cockpit) **/
define('LIMITE_TAILLE_PA_DEFAUT',10);

/** Taille en PA du trollometer maximum **/
define('LIMITE_MAX_TAILLE_PA',25);

/****** Variables globales pour le magasin *****/
/*liste des gestionnaires des Grandes Tani�res*/
define('GGT','2690,5246,7497,32065,42637');

/*liste des grandes tani�res*/
define('GT_38965','La B�blyohtek');
define('GT_33931','Le Mag\'Hasin');
define('GT_34111','La Taverne');

/*positions des grandes tani�res*/
define('GT_POS_38965','-26 -80 -32');
define('GT_POS_33931','-32 -51 -15');
define('GT_POS_34111','-27 -30 -33');

/*images des grandes tani�res*/
define('GT_IMG_38965','biblyohtek.gif');
define('GT_IMG_33931','maghasin.gif');
define('GT_IMG_34111','taverne.gif');


/******* G�n�ral *********/
/* Num�ro MH de la guilde : 450 pour les Relais&Mago */
define('ID_GUILDE',450);

/*** Nom de la guilde ***
 peut �tre diff�rent que le nom MH : Exemple pour la
 guilde RELAIS&MAGO => NOM_GUILDE = Relais&Mago
 */
define('NOM_GUILDE',"Relais&Mago");

/*** Mot de passe externe md5 ***
 Utilis� pour l'appel aux scripts externes
*/
define('MD5_PASS_EXTERNE',"1583227674a477848b06c40803ccdc69");
?>
