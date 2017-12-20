startMenu = function() {
if (document.all&&document.getElementById) {
cssmenu = document.getElementById("csstopmenu");
for (i=0; i<cssmenu.childNodes.length; i++) {
node = cssmenu.childNodes[i];
if (node.nodeName=="LI") {
node.onmouseover=function() {
this.className+=" over";
}
node.onmouseout=function(){                  
this.className=this.className.replace(" over", "")
}
}
}
}
}

if (window.attachEvent)
window.attachEvent("onload", startMenu)
else
window.onload=startMenu;