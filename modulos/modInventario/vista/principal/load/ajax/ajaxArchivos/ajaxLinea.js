// JavaScript Document
function loadXMLDoc()
	{
	var xmlhttp;
	var n=document.getElementById('bqLineas').value;

	if(n==''){
		document.getElementById("loadTblLineas").innerHTML="";
		return;
	}

	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
		{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
			xmlhttp.onreadystatechange=function()
		{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("loadTblLineas").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST","load/ajax/resultados/resLineas.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("q="+n);
}