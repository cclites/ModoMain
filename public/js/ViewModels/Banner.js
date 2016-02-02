var buildBannerView = function(registered)
{
    var str = '',
	    bannerContent = {};
		
	if(registered == true)
	{
		bannerContent = registeredView();
	}
	else
	{
		bannerContent = notRegisteredView();
	}
	
	str += '    <div class="bannerContent">';
	str += '      <div id="bannerLeft">';
	str += bannerContent.bannerLeftContent;
	str += '      </div>';
	str += '      <div id="bannerCenter">';
	str += bannerContent.bannerCenterContent;
	str += '      </div>';
	str += '      <div id="bannerRight">';
	str += bannerContent.bannerRightContent;
	str += '      </div>';
	str += '    </div>';

	return str;
};

var notRegisteredView = function()
{
    var str = '',
	    bannerLeftContent = "",
		bannerRightContent = "",
		bannerCenterContent = "",
		viewObject = {};
		
	bannerLeftContent += buildLogInView();
	bannerCenterContent += '&nbsp;';
	bannerRightContent += '<span id="forumLink" onclick="window.location=\'https://www.modobot.com/forum\'">Forum</span>';
	bannerRightContent += '<span id="newAccount" onclick="li.newAccount()">New Account</span>';
		
	viewObject.bannerLeftContent = bannerLeftContent;
	viewObject.bannerCenterContent = bannerCenterContent;
	viewObject.bannerRightContent = bannerRightContent;
	
	return viewObject;
};

var registeredView = function()
{
	var bannerLeftContent = "",
		bannerRightContent = "",
		bannerCenterContent = "",
		viewObject = {};
		
	bannerLeftContent += '<div id="account" onclick="updateAccount()">Account</div>';	
	bannerLeftContent += '<div id="logOut" onclick="logOut();">Log Out</div>';	
	bannerCenterContent += '&nbsp;';
	bannerRightContent += '<span id="forumLink" onclick="window.location=\'https://www.modobot.com/forum\'">Forum</span>';	
	
	
	viewObject.bannerLeftContent = bannerLeftContent;
	viewObject.bannerCenterContent = bannerCenterContent;
	viewObject.bannerRightContent = bannerRightContent;
	
	return viewObject;
};