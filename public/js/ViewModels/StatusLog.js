function statusLogView()
{
	str = "";
	str += "<div class='statusLog' style='float: left;'>";
	str += " <div><i onclick='li.clearLog()' title='Clear Status Log' class='fa fa-strikethrough'></i>Status:</div>";
	str += "  <textarea id='statusLogContent'></textarea>";
	//str += "  <div class='close' id='logClear'></div>"
	str += "</div>";
	return str;
}


                
                
			