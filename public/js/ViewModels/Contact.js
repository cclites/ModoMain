function buildContact()
{
  var str = "";
  
	str += "<div id='contactModal'>";
  str += "  <h3>Please send any questions, comments, or suggestions</h3>\n";
  
  str += "  <form>\n";
  str += "    <div><label>ContractAddress:</label><input id='cAddress'></div>\n";
  str += "      <br>\n";
  str += "    <div><label>Subject:</label><input id='cSubject'></div>\n";
  str += "      <br>\n";
  str += "    <div><label>Message:</label><textarea id='cMessage' data-bind='text: model.contact.contactMessage'></textarea></div>\n";
  str += "      <br>\n";
  str += "    <div id='contactSubmit' class='divAsButton'>Submit</div>";
  str += "  </form>\n";
	str += "</div>";

  return str;
}
