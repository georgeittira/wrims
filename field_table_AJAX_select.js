function get_data(value,id,name,iter,form) {
    //alert(value);
    var field = id.split(',')[0];
    var table = id.split(',')[1];
    var option = name + "_sel";
    var xmlhttp;
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
            element = document.getElementById(option);
            while (element.firstChild) {
                element.removeChild(element.firstChild);
            }
            var text = xmlhttp.responseText;
            text = text.split('\n');
            var i =0;
            while (text[i] !== undefined){
                var node = document.createElement("OPTION");
                node.id = option + "_" + i;
                //node.addEventListener("mousedown", update_input(node.id));
                var textnode = document.createTextNode(text[i]);
                node.appendChild(textnode);
                element.appendChild(node);
                i= i+1;
            };
            element.removeChild(element.lastChild);

        }
      }
    if(iter>0){
        var prevtext= (document.getElementById("usi,master_tl," + form)).value;
        field += ",usi";
        value += "," + prevtext;
        //console.log(field,value);
    }
    if(iter>1){
        var prevtext= (document.getElementById("type,master_tl," + form)).value;
        field += ",type";
        value += "," + prevtext;
        //console.log(field,value);
    }
    if(iter>2){
        var prevtext= (document.getElementById("type_id,master_tl," + form)).value;
        field += ",type_id";
        value += "," + prevtext;
        //console.log(field,value);
    }
    if(iter>3){
        var prevtext= (document.getElementById("strip_id,master_tl," + form)).value;
        field += ",strip_id";
        value += "," + prevtext;
        //console.log(field,value);
    }
    if(iter>4){
        var prevtext= (document.getElementById("tl_no,master_tl," + form)).value;
        field += ",tl_no";
        value += "," + prevtext;
        //console.log(field,value);
    }
    xmlhttp.open("GET","field_table_AJAX_select.php?text=" + value + "&field=" + field + "&table=" + table + "&iter=" +iter,true);
    xmlhttp.send();
}

function update_input(element){
    var idin = element.id.replace(/_sel/,"");
    input_tag = document.getElementsByName(idin)[0];
    input_tag.value = element.options[element.selectedIndex].text;
    //console.log(element.options[element.selectedIndex].text);
}

function editHandler(element,check) {
	var N = element.id.split('#')[1];
	var wri = N;
	document.getElementById('check').value = check;
	document.getElementById('wri_key').value = N;
	var unit = document.getElementById('unit#'+N).innerHTML;
	document.getElementById('unique_id,master_tl,0').value = document.getElementById('unique_id_from#'+N).innerHTML;
	document.getElementById('wire_no').value = document.getElementById('wire_no#'+N).innerHTML;
	document.getElementById('cable_no,master_cable_schedule,0').value = document.getElementById('cable_no#'+N).innerHTML;
	var cablebinder = document.getElementById('cable_binder#'+N).innerHTML;
	document.getElementById('col_code,cable_col_code,0').value = document.getElementById('color_code#'+N).innerHTML;
	document.getElementById('unique_id,master_tl,1').value = document.getElementById('destination#'+N).innerHTML;
	var remarks = document.getElementById('remarks#'+N).innerHTML;
	document.getElementById('drawing_no,drawing_schedule,0').value = document.getElementById('drawing_no#'+N).innerHTML.replace(/&amp;/g, '&');
	
}