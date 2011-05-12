var compos = $('html>body>table>tbody>tr:eq(1)>td>table>tbody>tr>td:eq(1)>form>table>tbody>tr:eq(1)>td>table>tbody');

var arrayCompo = "";
$('>tr',compos).each(function(index) {
	arrayCompo += "index[]="+index+"&nomCompos[]="+$('>td:eq(1)>a',this).text()+"&";
});	

if (arrayCompo != "") {
	newEventScript = document.createElement('script');
	newEventScript.setAttribute('language', 'JavaScript');
	newEventScript.setAttribute('src', URLCompoEqInfos + arrayCompo);
	document.body.appendChild(newEventScript);
}