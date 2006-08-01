// Configuration
var URLTopMH = 'http://games.mountyhall.com';
var URLPack = '/mountyhall/installPack.php';
var URLVue = '/mountyhall/MH_Play/Play_vue.php';
var URLProfil = '/mountyhall/MH_Play/Play_profil.php';
var URLOption = '/mountyhall/MH_Play/Options/Play_o_Interface.php';
var URLMessageBot = '/mountyhall/Messagerie/ViewMessageBot.php';
var URLCompCdm = '/mountyhall/MH_Play/Actions/Competences/Play_a_Competence16b.php';
var URLSorts = '/mountyhall/MH_Play/Actions/Play_a_SortResult.php';
var URLNews = '/mountyhall/MH_Play/Play_news.php';
var URLTaniereDescription = '/mountyhall/MH_Play/Lieu_Description.php';
var URLTaniereAchat = '/mountyhall/MH_Play/Lieu_TaniereAchat.php';
var URLTaniereDepot = '/mountyhall/MH_Play/Lieu_TaniereDepot.php';
var URLTaniereVente = '/mountyhall/MH_Play/Lieu_TaniereVente.php';
var URLSuivantsProfil = '/mountyhall/MH_Follower/FO_Profil.php';
var URLSuivantsOrdres = '/mountyhall/MH_Follower/FO_Ordres.php';
var URLSuivantsEquipement = '/mountyhall/MH_Follower/FO_Equipement.php';
var URLSuivantsDescription = '/mountyhall/MH_Follower/FO_Description.php';
var URLEquipement = '/mountyhall/MH_Play/Play_equipement.php';
var URLCombat = '/mountyhall/MH_Play/Actions/Play_a_Combat.php';
var URLStockGT = '/mountyhall/MH_Comptoirs/Comptoir_o_Stock.php';
var URLListeVente = '/mountyhall/MH_Play/Liste_Vente/ListeVente_view.php';
var URLCompoChampi = '/mountyhall/MH_Play/Play_e_ChampComp.php';

// Modify HERE for local testing
var URLOutils = 'http://outils.relaismago.com/';
var URLTopJs = 'http://outils.relaismago.com/firemago_dev/';

var URLVueJs = 		URLTopJs + 'RM_vue.js';
var URLMessageBotJs = 	URLTopJs + 'RM_message_bot.js';
var URLProfilJs = 		URLTopJs + 'RM_profil.js';
var URLOptionJs = 		URLTopJs + '';
var URLCompCdmJs = 	URLTopJs + 'RM_comp_cdm.js';
var URLNewsJs = 		URLTopJs + 'RM_news.js';
var URLTaniereAchatJs =	URLTopJs + 'RM_taniere_achat.js';
var URLSuivantsJs =		URLTopJs + 'RM_suivants.js';
var URLSortsJs = 		URLTopJs + 'RM_sorts.js';
var URLEquipementJs = URLTopJs + 'RM_equipement.js';
var URLCombatJs = URLTopJs + 'RM_combat.js';
var URLStockGTJs = URLTopJs + 'RM_stock_gt.js';
var URLListeVenteJs = URLTopJs + 'RM_liste_vente.js';
var URLCompoChampiJs = URLTopJs + 'RM_compo_champi.js';

var URLBestiaire = 	URLOutils + 'bestiaire2/bestiaire.php?Monstre=';
var URLRGTroll = URLOutils + 'engine_view.php?troll=';
var URLRGGuilde = URLOutils + 'engine_view.php?guilde=';
var URLLoginRM = 	URLTopJs + 'FM_authent.php3';
var URLVtt = 		URLOutils + 'vtt/completer_profil.php';
var URLGgc = 		URLOutils + 'ggc/maj_profil.php';
var URLVue2D= 	URLOutils + 'get_vue.php3';
var URLGowap = URLOutils + 'engine_view.php?gowap=';

var URLTrollInfos = URLTopJs + 'trolls.php?';
var URLGuildeInfos = URLTopJs + 'guildes.php?';
var URLMonsterInfos = URLTopJs + 'monsters.php?';
var URLPlaceInfos = URLTopJs + 'places.php?';

var URLMessageProcessCompCdM = URLOutils + 'bestiaire2/MaJ/parse_cdm.php';
var URLMessageProcessSortAA = URLOutils + 'anatomique/anatomique.php?id_troll=new';

var URLMessageProcessCompInsulte = 	URLTopJs + 'msgProcessCompInsulte.php';
var URLMessageProcessAttaque = 		URLTopJs + 'msgProcessAttaque.php';
var URLMessageProcessDefense = 		URLTopJs + 'msgProcessDefense.php';

var bodyVue;
var documentVue;
var totaltab;
var x_monstres;
var x_trolls;
var x_tresors;
var x_lieux;

// Check JS to load depending on page parsed
if ( window.self.location.toString ().indexOf ( URLVue ) != -1 ) 
{
	includeScript ( window.self, URLVueJs );
} 
else if ( window.self.location.toString ().indexOf ( URLMessageBot ) != -1 ) 
{
	includeScript ( window.self, URLMessageBotJs );
}
else if ( window.self.location.toString ().indexOf( URLProfil ) != -1 ) 
{
	includeScript ( window.self, URLProfilJs );
}
else if ( window.self.location.toString ().indexOf( URLOption ) != -1 ||  window.self.location.toString().indexOf ( URLPack ) != -1 ) 
{
	// includeScript ( window.self, URLOptionJs );
}
else if ( window.self.location.toString ().indexOf( URLCompCdm ) != -1 ) 
{
	includeScript ( window.self, URLCompCdmJs );
} 
else if ( window.self.location.toString ().indexOf( URLTaniereAchat ) != -1 ) 
{
	includeScript ( window.self, URLTaniereAchatJs );
}
else if ( window.self.location.toString ().indexOf( URLNews ) != -1 ) 
{
	window.location.href = URLTopMH + URLProfil;
} 
else if ( window.self.location.toString ().indexOf( URLSuivantsProfil ) != -1 ) 
{
  includeScript ( window.self, URLSuivantsJs );
}
else if ( window.self.location.toString ().indexOf( URLSuivantsOrdres ) != -1 )
{
	includeScript ( window.self, URLSuivantsJs );
}
else if ( window.self.location.toString ().indexOf( URLSuivantsEquipement ) != -1 ) 
{
	includeScript ( window.self, URLSuivantsJs );
}
else if ( window.self.location.toString ().indexOf( URLSuivantsDescription ) != -1 ) 
{
	includeScript ( window.self, URLSuivantsJs );
}
else if ( window.self.location.toString ().indexOf( URLSorts ) != -1 ) 
{
	includeScript ( window.self, URLSortsJs );
}
else if ( window.self.location.toString ().indexOf( URLEquipement ) != -1 )
{
  includeScript ( window.self, URLEquipementJs );
}
else if ( window.self.location.toString ().indexOf( URLCombat ) != -1 )
{
  includeScript ( window.self, URLCombatJs );
}
else if ( window.self.location.toString ().indexOf( URLStockGT ) != -1 )
{
	includeScript ( window.self, URLStockGTJs );
}
else if ( window.self.location.toString ().indexOf( URLListeVente ) != -1 )
{
  includeScript ( window.self, URLListeVenteJs );
}
else if ( window.self.location.toString ().indexOf( URLCompoChampi ) != -1 )
{
  includeScript ( window.self, URLCompoChampiJs );
}

function includeScript ( win, scriptURL )
{
	var currentDocument = window.self.document;
	if ( ! currentDocument.getElementById ( 'RMScriptInclude' ) )
	{
		var newScript = currentDocument.createElement( 'script' );
		newScript.setAttribute ( 'language', 'JavaScript' );
		newScript.setAttribute ( 'id', 'RMScriptInclude' );
		newScript.setAttribute ( 'src', scriptURL );

		var insertPoint = currentDocument.getElementsByTagName ('body')[0];
		try {
			insertPoint.parentNode.appendChild ( newScript );
		} catch ( e ) { alert ( 'Could not display FireMago page-specific script : ' + e ); }
	}
}
