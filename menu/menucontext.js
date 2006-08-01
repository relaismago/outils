//Top Nav bar script v2.1- http://www.dynamicdrive.com/dynamicindex1/sm/index.htm

function showToolbar()
{
// AddItem(id, text, hint, location, alternativeLocation);
// AddSubItem(idParent, text, hint, location, linktarget);

	menu = new Menu();
	menu.addItem("webmasterid", "Web Building Sites", "Web Building Sites",  null, null);
	menu.addItem("newsid", "News Sites", "News Sites",  null, null);
	menu.addItem("freedownloadid", "Free Downloads", "Free Downloads",  null, null);
	menu.addItem("searchengineid", "Search Engines", "Search Engines",  null, null);
	menu.addItem("miscid", "Miscellaneous", "Miscellaneous",  null, null);

	menu.addSubItem("webmasterid", "Dynamic Drive", "Dynamic Drive",  "http://www.dynamicdrive.com/", "");
	menu.addSubItem("webmasterid", "JavaScript Kit", "JavaScript Kit",  "http://www.javascriptkit.com/", "");
	menu.addSubItem("webmasterid", "Web Review", "Web Review",  "http://www.webreview.com/", "");
	menu.addSubItem("webmasterid", "Freewarejava.com", "Freewarejava.com",  "http://www.freewarejava.com/", "_blank");
	menu.addSubItem("webmasterid", "Web Monkey", "Web Monkey",  "http://www.webmonkey.com/", "_blank");

	menu.addSubItem("newsid", "CNN", "CNN",  "http://www.cnn.com", "");
	menu.addSubItem("newsid", "ABC News", "ABC News",  "http://www.abcnews.com", "");
	menu.addSubItem("newsid", "MSNBC", "MSNBC",  "http://www.msnbc.com", "");
	menu.addSubItem("newsid", "CBS news", "CBS News",  "http://www.cbsnews.com", "");
	menu.addSubItem("newsid", "News.com", "News.com",  "http://news.com", "");
	menu.addSubItem("newsid", "Wired News", "Wired News",  "http://www.wired.com", "");
	menu.addSubItem("newsid", "TechWeb", "TechWeb",  "http://www.techweb.com", "");

	menu.addSubItem("freedownloadid", "Dynamic Drive", "Dynamic Drive",  "http://www.dynamicdrive.com/", "");
	menu.addSubItem("freedownloadid", "Download.com", "Download.com",  "http://download.com/", "");
	menu.addSubItem("freedownloadid", "Tucows", "Tucows",  "http://tucows.com/", "");

	menu.addSubItem("searchengineid", "Yahoo", "Yahoo",  "http://www.yahoo.com/", "");
	menu.addSubItem("searchengineid", "Google", "Google",  "http://www.google.com/", "");
	menu.addSubItem("searchengineid", "Excite", "Excite", "http://www.excite.com", "");
	menu.addSubItem("searchengineid", "HotBot", "HotBot",  "http://www.hotbot.com", "");

	menu.addSubItem("miscid", "Cnet", "Cnet",  "http://www.cnet.com/", "");
	menu.addSubItem("miscid", "RealAudio", "RealAudio",  "http://www.realaudio.com/", "");
	menu.addSubItem("miscid", "MP3.com", "MP3.com",  "http://www.mp3.com/", "");

	menu.showMenu();
}
