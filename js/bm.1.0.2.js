(function(){function a(a){return document.getElementById(a)}function b(b,c){a(b).style.display=c}function c(a,b){a=a||.1,b=b||16;var c=0,d=0,e=0,f=0,g=0,h=0;document.documentElement&&(c=document.documentElement.scrollLeft||0,d=document.documentElement.scrollTop||0),document.body&&(e=document.body.scrollLeft||0,f=document.body.scrollTop||0);var g=window.scrollX||0,h=window.scrollY||0,i=Math.max(c,Math.max(e,g)),j=Math.max(d,Math.max(f,h)),k=1+a;if(window.scrollTo(Math.floor(i/k),Math.floor(j/k)),i>0||j>0){var l="MGJS.goTop("+a+", "+b+")";window.setTimeout(l,b)}}function d(c,d,e,f,g,h){a(e).className=f,a(g).className=h;var i,j;j=c.split(",");for(var k=0;j.length>k;k++){var i=j[k];a(i)&&b(i,"block")}j=d.split(",");for(var k=0;j.length>k;k++)i=j[k],a(i)&&b(i,"none")}function e(){a("comment").onkeydown=function(b){var c=null;c=window.event?window.event:b,null!=c&&c.ctrlKey&&13==c.keyCode&&a("submit").click()},a("submit").value+=" (Ctrl+Enter)"}function f(a,b,c){c=c||document;var d="*"==b&&c.all?c.all:c.getElementsByTagName(b),e=Array();a=a.replace(/\-/g,"\\-");for(var g,f=RegExp("(^|\\s)"+a+"(\\s|$)"),h=0;d.length>h;h++)g=d[h],f.test(g.className)&&e.push(g);return e}window.MGJS={},window.MGJS.$=a,window.MGJS.setStyleDisplay=b,window.MGJS.goTop=c,window.MGJS.switchTab=d,window.MGJS.loadCommentShortcut=e,window.MGJS.getElementsByClassName=f})(),function(){function d(){for(var b="left",d=0;a=document.getElementsByTagName("link")[d];d++)"stylesheet"==a.getAttribute("rel")&&-1!=a.getAttribute("href").indexOf("rtl.1.0.2.css")&&(b="right");var e=document.getElementById("subscribe");e&&new c(e,b);var f=document.getElementById("menus");if(f)for(var g=f.getElementsByTagName("ul"),d=0;g.length>d;d++){var h=g[d].parentNode;h.parentNode===f?new c(h,b):(new c(h,b,1),h.firstChild.className+=" subtitle")}}var b={create:function(){return function(){this.initialize.apply(this,arguments)}}},c=b.create();if(c.prototype={initialize:function(a,b,c){this.obj=cleanWhitespace(a),this.align=b||"left",this.sub=c||-1,this.menu=this.obj.childNodes,2>this.menu.length||(this.title=this.menu[0],this.body=this.menu[1],cleanWhitespace(this.body).lastChild.getElementsByTagName("a")[0].className+=" last",setStyle(this.body,"visibility","hidden"),setStyle(this.body,"display","block"),addListener(this.obj,"mouseover",bind(this,this.activate),!1),addListener(this.obj,"mouseout",bind(this,this.deactivate),!1))},activate:function(){if(1==this.sub){var a=currentOffset(this.title),b=a[1]-1,c=getWidth(this.body)-2;if("right"==this.align)var c=-1*getWidth(this.body)}else{var a=cumulativeOffset(this.title),b=a[1]+getHeight(this.title),c=a[0];"right"==this.align&&(c+=getWidth(this.title)-getWidth(this.body))}/current/.test(this.title.className)||(this.title.className+=" current"),setStyle(this.body,"left",c+"px"),setStyle(this.body,"top",b+"px"),setStyle(this.body,"visibility","visible")},deactivate:function(){this.title.className=this.title.className.replace("current","");var a=this,b=setInterval(function(){return clearInterval(b),/current/.test(a.title.className)||setStyle(a.body,"visibility","hidden"),!1},400)}},$A=function(a){if(!a)return[];if(a.toArray)return a.toArray();for(var b=[],c=0;a.length>c;c++)b.push(a[c]);return b},bind=function(){var a=this.$A(arguments),b=a[a.length-1],c=b,d=a,e=d.shift();return function(){return c.apply(e,d.concat(a))}},getHeight=function(a){return a.offsetHeight},getWidth=function(a){return a.offsetWidth},setStyle=function(a,b,c){a.style[b]=c},cleanWhitespace=function(a){for(var b=a.firstChild;b;){var c=b.nextSibling;3!=b.nodeType||/\S/.test(b.nodeValue)||a.removeChild(b),b=c}return a},currentOffset=function(a){var b=a.offsetTop||0,c=a.offsetLeft||0;return[c,b]},cumulativeOffset=function(a){var b=0,c=0;do b+=a.offsetTop||0,c+=a.offsetLeft||0,a=a.offsetParent;while(a);return[c,b]},addListener=function(a,b,c,d){a.addEventListener?a.addEventListener(b,c,d):a.attachEvent&&a.attachEvent("on"+b,c)},document.addEventListener)document.addEventListener("DOMContentLoaded",d,!1);else if(/MSIE/i.test(navigator.userAgent)){document.write('<script id="__ie_onload_for_inove" defer src="javascript:void(0)"></script>');var e=document.getElementById("__ie_onload_for_inove");e.onreadystatechange=function(){"complete"==this.readyState&&d()}}else if(/WebKit/i.test(navigator.userAgent))var f=setInterval(function(){/loaded|complete/.test(document.readyState)&&(clearInterval(f),d())},10);else window.onload=function(){d()}}();