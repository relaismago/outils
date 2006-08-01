<?php
global $HTTP_GET_VARS;

include('../top.php');

afficher_titre_tableau("L'analyseur de troll<br/>", "");

?>


<script src="./analyseur_trt.js" />

<script type="text/javascript">

</script>

<form action="" method="" name="analyseur" style="text-align:center">
<table align="center" class='mh_tdborder' width="90%">
	<tr class='mh_tdtitre'>
		<td align="center" colspan="4">Race</td>
	</tr>
	<tr class='mh_tdpage'>
		<td align="center" width="25%"><input type="radio" name="race" value="tom" onChange="changeRace(this)" />Tomawak</td>
		<td align="center" width="25%"><input type="radio" name="race" value="durak" onChange="changeRace(this)" />Durakuir</td>
		<td align="center" width="25%"><input type="radio" name="race" value="kastar" onChange="changeRace(this)" />Kastar</td>
		<td align="center" width="25%"><input type="radio" name="race" value="skrim" onChange="changeRace(this)" />Skrim</td>
	</tr>
</table>

<br />

<table align="center" class='mh_tdborder' width="90%">
	<tr class='mh_tdtitre'>
		<td align="center" colspan="4">Profil</td>
	</tr>
	<tr class='mh_tdpage'>
		<td align="left" width="50%">
			<table style="margin-left:35%; margin-right:20%; width:45%;">
				<tr>
					<td>Attaque :</td>
					<td>
						<input type="text" size="5" id="ATT" onFocus="modifier(this,'ATT')" />
						<span id="boutonsATT"><input type="button" value="-" onClick="decr(this,'ATT');" />
						<input type="button" value="+" onClick="incr(this,'ATT');" /></span>
						<div id="autresBoutonsATT" style="visibility:hidden; position:absolute;"><input type="button" value="Valider"  onClick="valider('ATT');" style="width:52px;"/></div>
					</td>
				</tr>
				<tr>
					<td>Esquive :</td>
					<td>
						<input type="text" size="5" id="ESQ" onFocus="modifier(this,'ESQ')" />
						<span id="boutonsESQ"><input type="button" value="-" onClick="decr(this,'ESQ');" />
						<input type="button" value="+" onClick="incr(this,'ESQ');" /></span>
						<div id="autresBoutonsESQ" style="visibility:hidden; position:absolute;"><input type="button" value="Valider" onClick="valider('ESQ');" style="width:52px;"/></div>
					</td>
				</tr>
				<tr>
					<td>Dégats :</td>
					<td>
						<input type="text" size="5" id="DEG" onFocus="modifier(this,'DEG')" />
						<span id="boutonsDEG"><input type="button" value="-" onClick="decr(this,'DEG');" />
						<input type="button" value="+" onClick="incr(this,'DEG');" /></span>
						<div id="autresBoutonsDEG" style="visibility:hidden; position:absolute;"><input type="button" value="Valider"  onClick="valider('DEG');" style="width:52px;"/></div>
					</td>
				</tr>
				<tr>
					<td>Régénération :</td>
					<td>
						<input type="text" size="5" id="REG" onFocus="modifier(this,'REG')" />
						<span id="boutonsREG"><input type="button" value="-" onClick="decr(this,'REG');" />
						<input type="button" value="+" onClick="incr(this,'REG');" /></span>
						<div id="autresBoutonsREG" style="visibility:hidden; position:absolute;"><input type="button" value="Valider"  onClick="valider('REG');" style="width:52px;"/></div>
					</td>
				</tr>
				<tr>
					<td>Vue :</td>
					<td>
						<input type="text" size="5" id="VUE" onFocus="modifier(this,'VUE')" />
						<span id="boutonsVUE"><input type="button" value="-" onClick="decr(this,'VUE');" />
						<input type="button" value="+" onClick="incr(this,'VUE');" /></span>
						<div id="autresBoutonsVUE" style="visibility:hidden; position:absolute;"><input type="button" value="Valider"  onClick="valider('VUE');" style="width:52px;"/></div>
					</td>
				</tr>
				<tr>
					<td>Points de Vie :</td>
					<td>
						<input type="text" size="5" id="PV" onFocus="modifier(this,'PV')" />
						<span id="boutonsPV"><input type="button" value="-" onClick="decr(this,'PV');" />
						<input type="button" value="+" onClick="incr(this,'PV');" /></span>
						<div id="autresBoutonsPV" style="visibility:hidden; position:absolute;"><input type="button" value="Valider"  onClick="valider('PV');" style="width:52px;"/></div>
					</td>
				</tr>
				<tr>
					<td>DLA :</td>
					<td>
						<input type="text" size="5" id="DLA" readonly="readonly"/>
						<span id="boutonsDLA"><input type="button" value="-" onClick="decr(this,'DLA');" />
						<input type="button" value="+" onClick="incr(this,'DLA');" /></span>
						<div id="autresBoutonsDLA" style="visibility:hidden; position:absolute;"><input type="button" value="Valider"  onClick="valider('DLA');" style="width:52px;"/></div>
					</td>
				</tr>
			</table>
		</td>
		<td align="left" width="50%">
			<table style="margin-left:20%; margin-right:35%; width:45%;">
				<tr style="color:#0000FF;">
					<td>Niveau réel :</td>
					<td><input type="text" id="nivReel" value="" onKeyUp="recalculePi(this)" /></td>
				</tr>
				<tr style="color:#0000FF;">
					<td>PI <span id="isPiReels">réels</span> :</td>
					<td><input type="text" id="piReel" value="" onKeyUp="recalculeNiv(this); recalculePiRestants(); setPiReel(true)" /></td>
				</tr>
				<tr style="color:#FF0000;">
					<td>Niveau nécessaire :</td>
					<td><input type="text" id="nivNecessaire" readonly="readonly" value="1" /></td>
				</tr>
				<tr style="color:#FF0000;">
					<td>PI nécessaires :</td>
					<td><input type="text" id="piNecessaires" readonly="readonly" value="0" /></td>
				</tr>
				<tr style="color:#000000;">
					<td>PI restants :</td>
					<td><input type="text" id="piRestants" readonly="readonly" value="0" /></td>
				</tr>

			</table>
		</td>
	</tr>
</table>

<br />

<table align="center" class='mh_tdborder' width="90%" id="competences">
	<tr class='mh_tdtitre'>
		<td align="center" colspan="2">Compétences</td>
	</tr>
	<tr class='mh_tdpage'>
		<td width="50%">
			<input type="checkbox" checked="checked" disabled="disabled" />
			<span id="compRace">Compétence de race</span>
			<span id="dataCompRace"></span>
		</td>
		<td width="50%"><input type="checkbox" checked="checked" disabled="disabled" />Identification des Champignons</td>
	</tr>
	<tr class='mh_tdpage'>
		<td><input type="checkbox" id="AP" value="50" onChange="coche(this)">Attaque Précise<span id="dataAp"></span></td>
		<td><input type="checkbox" id="Alchimie" value="150" onChange="coche(this)">Alchimie</td>
	</tr>
	<tr class='mh_tdpage'>
		<td><input type="checkbox" id="Charger" value="50" onChange="coche(this)">Charger<span id="dataCharger"></span></td>
		<td><input type="checkbox" id="Bidouille" value="20" onChange="coche(this)">Bidouille</td>
	</tr>
	<tr class='mh_tdpage'>
		<td><input type="checkbox" id="CdM" value="10" onChange="coche(this)">Connaissance des Monstres</td>
		<td><input type="checkbox" id="Dressage" value="20" onChange="coche(this)">Dressage</td>
	</tr>
	<tr class='mh_tdpage'>
		<td><input type="checkbox" id="Piege" value="50" onChange="coche(this)">Construire un Piège<span id="dataPiege"></span></td>
		<td><input type="checkbox" id="EM" value="100" onChange="coche(this)">Ecriture Magique</td>
	</tr>
	<tr class='mh_tdpage'>
		<td><input type="checkbox" id="CA" value="20" onChange="coche(this)">Contre-Attaquer<span id="dataCa"></span></td>
		<td><input type="checkbox" id="Grattage" value="30" onChange="coche(this)">Grattage</td>
	</tr>
	<tr class='mh_tdpage'>
		<td><input type="checkbox" id="CdB" value="50" onChange="coche(this)">Coup de butoir<span id="dataCdb"></span></td>
		<td><input type="checkbox" id="Melange" value="40" onChange="coche(this)">Mélange Magique</td>
	</tr>
	<tr class='mh_tdpage'>
		<td><input type="checkbox" id="DE" value="20" onChange="coche(this)">Déplacement Eclair</td>
		<td><input type="checkbox" id="Miner" value="10" onChange="coche(this)">Miner</td>
	</tr>
	<tr class='mh_tdpage'>
		<td><input type="checkbox" id="Frenesie" value="100" onChange="coche(this)">Frénésie</td>
		<td><input type="checkbox" id="Tailler" value="100" onChange="coche(this)">Nécromancie</td>
	</tr>
	<tr class='mh_tdpage'>
		<td><input type="checkbox" id="Insultes" value="10" onChange="coche(this)">Insultes</td>
		<td><input type="checkbox" id="Pistage" value="10" onChange="coche(this)">Pistage</td>
	</tr>
	<tr class='mh_tdpage'>
		<td><input type="checkbox" id="LdP" value="30" onChange="coche(this)">Lancer de Potions<span id="dataLdp"></td>
		<td><input type="checkbox" id="Shamaner" value="50" onChange="coche(this)">Shamaner</td>
	</tr>
	<tr class='mh_tdpage'>
		<td><input type="checkbox" id="Parer" value="20" onChange="coche(this)">Parer<span id="dataParer"></td>
		<td><input type="checkbox" id="Tailler" value="10" onChange="coche(this)">Tailler</td>
	</tr>
</table>

<br />

<table align="center" class='mh_tdborder' width="90%" id="sortileges">
	<tr class='mh_tdtitre'>
		<td align="center" colspan="2">Sortilèges</td>
	</tr>
	<tr class='mh_tdpage'>
		<td width="50%">
			<input type="checkbox" checked="checked" disabled="disabled" />
			<span id="sortRace">Sortilège de race</span>
			<span id="dataSortRace"></span>
		</td>
		<td width="50%"><input type="checkbox" checked="checked" disabled="disabled" />Identification des Trésors</td>
	</tr>
	<tr class='mh_tdpage'>
		<td><input type="checkbox" id="AE" value="0" onChange="coche(this)">Armure Ethérée<span id="dataAe"></span></td>
		<td><input type="checkbox" id="AA" value="0" onChange="coche(this)">Analyse Anatomique</td>
	</tr>
	<tr class='mh_tdpage'>
		<td><input type="checkbox" id="AdA" value="0" onChange="coche(this)">Augmentation de l'Attaque<span id="dataAda"></span></td>
		<td><input type="checkbox" id="BAM" value="0" onChange="coche(this)">Bulle d'Anti-Magie</td>
	</tr>
	<tr class='mh_tdpage'>
		<td><input type="checkbox" id="AdE" value="0" onChange="coche(this)">Augmentation de l'Esquive<span id="dataAde"></span></td>
		<td><input type="checkbox" id="BuM" value="0" onChange="coche(this)">Bulle Magique</td>
	</tr>
	<tr class='mh_tdpage'>
		<td><input type="checkbox" id="AdD" value="0" onChange="coche(this)">Augmentation des Dégâts<span id="dataAdd"></span></td>
		<td><input type="checkbox" id="Invisi" value="0" onChange="coche(this)">Invisibilité</td>
	</tr>
	<tr class='mh_tdpage'>
		<td><input type="checkbox" id="Explo" value="0" onChange="coche(this)">Explosion<span id="dataExplo"></span></td>
		<td><input type="checkbox" id="Sacro" value="0" onChange="coche(this)">Sacrifice</td>
	</tr>
	<tr class='mh_tdpage'>
		<td><input type="checkbox" id="FP" value="0" onChange="coche(this)">Faiblesse Passagère<span id="dataFp"></span></td>
		<td><input type="checkbox" id="TK" value="0" onChange="coche(this)">Télékinésie<span id="dataTk"></span></td>
	</tr>
	<tr class='mh_tdpage'>
		<td><input type="checkbox" id="FA" value="0" onChange="coche(this)">Flash Aveuglant<span id="dataFa"></span></span></td>
		<td>
			<input type="checkbox" id="TP" value="0" onChange="coche(this)">
			Téléportation (MM <input type="text" id="MM" value="0" size="3" onKeyUp="setDataTp()" />)
			<span id="dataTp"></span></td>
	</tr>
	<tr class='mh_tdpage'>
		<td><input type="checkbox" id="Glue" value="0" onChange="coche(this)">Glue<span id="dataGlue"></span></td>
		<td><input type="checkbox" id="VA" value="0" onChange="coche(this)">Vision accrue<span id="dataVa"></span></td>
	</tr>
	<tr class='mh_tdpage'>
		<td><input type="checkbox" id="GdS" value="0" onChange="coche(this)">Griffe du Sorcier<span id="dataGds"></span></td>
		<td><input type="checkbox" id="VL" value="0" onChange="coche(this)">Vision lointaine</td>
	</tr>
	<tr class='mh_tdpage'>
		<td><input type="checkbox" id="Projection" value="0" onChange="coche(this)">Projection</td>
		<td><input type="checkbox" id="VlC" value="0" onChange="coche(this)">Voir le caché<span id="dataVlc"></span></td>
	</tr>
	<tr class='mh_tdpage'>
		<td><input type="checkbox" id="VT" value="0" onChange="coche(this)">Vue Troublé<span id="dataVt"></span></td>
		<td></td>
	</tr>
</table>

</form>

<?php

include('../foot.php');

?>