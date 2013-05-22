/*
Author: linjl
Update: 2013/15/18
Author URI: http://linjunlong.com
 */
//base.js
(function() {
	function $(id) {
		return document.getElementById(id);
	}

	function setStyleDisplay(id, status) {
		$(id).style.display = status;
	}

	function goTop(a, t) {
		a = a || 0.1;
		t = t || 16;

		var x1 = 0;
		var y1 = 0;
		var x2 = 0;
		var y2 = 0;
		var x3 = 0;
		var y3 = 0;

		if (document.documentElement) {
			x1 = document.documentElement.scrollLeft || 0;
			y1 = document.documentElement.scrollTop || 0;
		}
		if (document.body) {
			x2 = document.body.scrollLeft || 0;
			y2 = document.body.scrollTop || 0;
		}
		var x3 = window.scrollX || 0;
		var y3 = window.scrollY || 0;

		var x = Math.max(x1, Math.max(x2, x3));
		var y = Math.max(y1, Math.max(y2, y3));

		var speed = 1 + a;
		window.scrollTo(Math.floor(x / speed), Math.floor(y / speed));
		if (x > 0 || y > 0) {
			var f = "MGJS.goTop(" + a + ", " + t + ")";
			window.setTimeout(f, t);
		}
	}

	function switchTab(showPanels, hidePanels, activeTab, activeClass, fadeTab,
			fadeClass) {
		$(activeTab).className = activeClass;
		$(fadeTab).className = fadeClass;

		var panel, panelList;
		panelList = showPanels.split(',');
		for ( var i = 0; i < panelList.length; i++) {
			var panel = panelList[i];
			if ($(panel)) {
				setStyleDisplay(panel, 'block');
			}
		}
		panelList = hidePanels.split(',');
		for ( var i = 0; i < panelList.length; i++) {
			panel = panelList[i];
			if ($(panel)) {
				setStyleDisplay(panel, 'none');
			}
		}
	}

	function loadCommentShortcut() {
		$('comment').onkeydown = function(moz_ev) {
			var ev = null;
			if (window.event) {
				ev = window.event;
			} else {
				ev = moz_ev;
			}
			if (ev != null && ev.ctrlKey && ev.keyCode == 13) {
				$('submit').click();
			}
		}
		$('submit').value += ' (Ctrl+Enter)';
	}

	function getElementsByClassName(className, tag, parent) {
		parent = parent || document;

		var allTags = (tag == '*' && parent.all) ? parent.all : parent
				.getElementsByTagName(tag);
		var matchingElements = new Array();

		className = className.replace(/\-/g, '\\-');
		var regex = new RegExp('(^|\\s)' + className + '(\\s|$)');

		var element;
		for ( var i = 0; i < allTags.length; i++) {
			element = allTags[i];
			if (regex.test(element.className)) {
				matchingElements.push(element);
			}
		}

		return matchingElements;
	}

	window['MGJS'] = {};
	window['MGJS']['$'] = $;
	window['MGJS']['setStyleDisplay'] = setStyleDisplay;
	window['MGJS']['goTop'] = goTop;
	window['MGJS']['switchTab'] = switchTab;
	window['MGJS']['loadCommentShortcut'] = loadCommentShortcut;
	window['MGJS']['getElementsByClassName'] = getElementsByClassName;

})();

//menu.js
(function() {

var Class = {
	create: function() {
		return function() {
			this.initialize.apply(this, arguments);
		}
	}
}

var GhostlyMenu = Class.create();
GhostlyMenu.prototype = {

	initialize: function(target, align, sub) {
		this.obj = cleanWhitespace(target);
		this.align = align || 'left';
		this.sub = sub || -1;

		this.menu = this.obj.childNodes;
		if (this.menu.length < 2) { return; }

		this.title = this.menu[0];
		this.body = this.menu[1];

		cleanWhitespace(this.body).lastChild.getElementsByTagName('a')[0].className += ' last';

		setStyle(this.body, 'visibility', 'hidden');
		setStyle(this.body, 'display', 'block');

		addListener(this.obj, 'mouseover', bind(this, this.activate), false);
		addListener(this.obj, 'mouseout', bind(this, this.deactivate), false);
	},

	activate: function() {
		if(this.sub == 1) {
			var pos = currentOffset(this.title);
			var top = pos[1] - 1;
			var left = getWidth(this.body) - 2;
			if (this.align == 'right') {
			var left = getWidth(this.body) * (-1);
			}
		} else {
			var pos = cumulativeOffset(this.title);
			var top = pos[1] + getHeight(this.title);
			var left = pos[0];
			if (this.align == 'right') {
				left += getWidth(this.title) - getWidth(this.body);
			}
		}

		if(!/current/.test(this.title.className)) {
			this.title.className += ' current';
		}

		setStyle(this.body, 'left', left + 'px');
		setStyle(this.body, 'top', top + 'px');
		setStyle(this.body, 'visibility', 'visible');
	},

	deactivate: function(){
		this.title.className = this.title.className.replace('current', '');
		var thismenu = this;
		var tid = setInterval( function() {
			clearInterval(tid);
			if (!/current/.test(thismenu.title.className)) {
				setStyle(thismenu.body, 'visibility', 'hidden');
			}
			return false;
		}, 400);
	}
}

$A = function(iterable) {
	if(!iterable) {
		return [];
	}
	if(iterable.toArray) {
		return iterable.toArray();
	} else {
		var results = [];
		for(var i = 0; i < iterable.length; i++) {
			results.push(iterable[i]);
		}
		return results;
	}
}

bind = function() {
	var array = this.$A(arguments);
	var func = array[array.length - 1];
	var method = func, args = array, object = args.shift();
	return function() {
		return method.apply(object, args.concat(array));
	}
}

getHeight = function(element) {
	return element.offsetHeight;
}

getWidth = function(element) {
	return element.offsetWidth;
}

setStyle = function(element, key, value) {
	element.style[key] = value;
}

cleanWhitespace = function(list) {
	var node = list.firstChild;
	while (node) {
		var nextNode = node.nextSibling;
		if(node.nodeType == 3 && !/\S/.test(node.nodeValue)) {
			list.removeChild(node);
		}
		node = nextNode;
	}
	return list;
}

currentOffset = function(element) {
	var valueT = element.offsetTop  || 0;
	var valueL = element.offsetLeft || 0;
	return [valueL, valueT];
}

cumulativeOffset = function(element) {
	var valueT = 0, valueL = 0;
	do {
		valueT += element.offsetTop  || 0;
		valueL += element.offsetLeft || 0;
		element = element.offsetParent;
	} while (element);
	return [valueL, valueT];
}

addListener = function(element, name, observer, useCapture) {
	if(element.addEventListener) {
		element.addEventListener(name, observer, useCapture);
	} else if(element.attachEvent) {
		element.attachEvent('on' + name, observer);
	}
}

function loadMenus() {
	var align = 'left';
	for(var i = 0; (a = document.getElementsByTagName('link')[i]); i++) {
		if((a.getAttribute('rel') == 'stylesheet') && (a.getAttribute('href').indexOf('rtl.1.0.2.css') != -1)) {
			align = 'right';
		}
	}

	var subscribe = document.getElementById('subscribe');
	if (subscribe) {
		new GhostlyMenu(subscribe, align);
	}

	var menubar = document.getElementById('menus');
	if (menubar) {
		var list = menubar.getElementsByTagName('ul');
		for (var i = 0; i < list.length; i++) {
			var menu = list[i].parentNode;
			if(menu.parentNode === menubar) {
				new GhostlyMenu(menu, align);
			} else {
				new GhostlyMenu(menu, align, 1);
				menu.firstChild.className += ' subtitle';
			}
		}
	}
}

if (document.addEventListener) {
	document.addEventListener("DOMContentLoaded", loadMenus, false);

} else if (/MSIE/i.test(navigator.userAgent)) {
	document.write('<script id="__ie_onload_for_linove" defer src="javascript:void(0)"></script>');
	var script = document.getElementById('__ie_onload_for_linove');
	script.onreadystatechange = function() {
		if (this.readyState == 'complete') {
			loadMenus();
		}
	}

} else if (/WebKit/i.test(navigator.userAgent)) {
	var _timer = setInterval( function() {
		if (/loaded|complete/.test(document.readyState)) {
			clearInterval(_timer);
			loadMenus();
		}
	}, 10);

} else {
	window.onload = function(e) {
		loadMenus();
	}
}
})();
//search.js
var searchbox = MGJS.$("searchbox");
var searchtxt = MGJS.$("search_textfield");
var searchbtn = MGJS.$("search_button");
var tiptext = "在这里输入文本搜索";
if(searchtxt.value == "" || searchtxt.value == tiptext) {
	searchtxt.className += " searchtip";
	searchtxt.value = tiptext;
}
searchtxt.onfocus = function(e) {
	if(searchtxt.value == tiptext) {
		searchtxt.value = "";
		searchtxt.className = searchtxt.className.replace(" searchtip", "");
	}
}
searchtxt.onblur = function(e) {
	if(searchtxt.value == "") {
		searchtxt.className += " searchtip";
		searchtxt.value = tiptext;
	}
}
searchbtn.onclick = function(e) {
	if(searchtxt.value == "" || searchtxt.value == tiptext) {
		return false;
	}
}

//SidebarFollow
SidebarFollow = function() {

	this.config = {
		element: null, // 处理的节点
		distanceToTop: 0 // 节点上边到页面顶部的距离
	};

	this.cache = {
		originalToTop: 0, // 原本到页面顶部的距离
		prevElement: null, // 上一个节点
		parentToTop: 0, // 父节点的上边到顶部距离
		placeholder: document.createElement('div') // 占位节点
	}
};

SidebarFollow.prototype = {

	init: function(config) {
		this.config = config || this.config;
		var _self = this;
		var element = document.getElementById(_self.config.element);
		//var prevElement =  document.getElementById(_self.config.prevElement);

		// 如果没有找到节点, 不进行处理
		if(!element) {
			return;
		}

		// 获取上一个节点
		var prevElement = _self._getPrevElement(element);
		while(prevElement.offsetHeight < 0) {
			prevElement = _self._getPrevElement(prevElement);
			if(!prevElement) {
				break;
			}
		}
		_self.cache.prevElement = prevElement;

		// 计算父节点的上边到顶部距离
		var parent = element.parentNode;
		var parentToTop = _self._getCumulativeOffset(parent).top;
		var parentBorderTop = parseInt(parent.style.borderTop, 10);
		var parentPaddingTop = parseInt(parent.style.paddingTop, 10);
		_self.cache.parentToTop = parentToTop + parentBorderTop + parentPaddingTop;

		// 滚动屏幕
		_self._addListener(window, 'scroll', function() {
			_self._scrollScreen({element:element, prevElement:prevElement, _self:_self});
		});

		// 改变屏幕尺寸
		_self._addListener(window, 'resize', function() {
			_self._scrollScreen({element:element, prevElement:prevElement, _self:_self});
		});
	},

	/**
	 * 修改节点位置
	 */
	_scrollScreen: function(args) {
		var _self = args._self;
		var element = args.element;
		var prevElement = args.prevElement;
		var toTop = _self.config.distanceToTop;

		// 如果 body 有 top 属性, 消除这些位移
		var bodyToTop = parseInt(document.getElementsByTagName('body')[0].style.top, 10);
		if(!isNaN(bodyToTop)) {
			toTop += bodyToTop;
		}

		var elementToTop = 0;
		if(element.style.position === 'fixed') {
			elementToTop = _self._getScrollY();
		} else {
			elementToTop = _self._getCumulativeOffset(element).top - toTop;
		}
		var elementToPrev = _self._getCumulativeOffset(prevElement).top + _self._getVisibleSize(prevElement).height;

		// 当节点进入跟随区域, 跟随滚动
		if(_self._getScrollY() > elementToTop) {
			// 添加占位节点
			var elementHeight = _self._getVisibleSize(element).height;
			_self.cache.placeholder.style.height = elementHeight + 'px';
			element.parentNode.insertBefore(_self.cache.placeholder, element);
			// 记录原位置
			_self.cache.originalToTop = elementToTop;
			// 修改样式
			element.style.top = toTop + 'px';
			element.style.position = 'fixed';
		// 否则回到原位
		} else if(_self.cache.originalToTop > elementToTop || elementToPrev > elementToTop) {
			var parent = _self.cache.placeholder.parentNode;
			if(parent) {
				// 删除占位节点
				parent.removeChild(_self.cache.placeholder);
				// 修改样式
				element.style.position = 'static';
			}
		}
	},

	/**
	 * 获取累计偏移量, 即元素到页面左上角的横行和纵向距离
	 */
	_getCumulativeOffset: function(element) {
		var offset = {
			left:0,
			top:0
		};

		do {
			offset.left += element.offsetLeft || 0;
			offset.top += element.offsetTop  || 0;
			element = element.offsetParent;
		} while (element);

		return offset;
	},

	/**
	 * 获取元素可见尺寸 (包括边线和滚动条)
	 */
	_getVisibleSize: function(element) {
		var dimension = {
			width:0,
			height:0
		};

		dimension.width = element.offsetWidth;
		dimension.height = element.offsetHeight;

		return dimension;
	},

	/**
	 * 获得滚动条纵向距离
	 */
	_getScrollY: function() {
		if(typeof window.pageYOffset != 'undefined') {
			return window.pageYOffset;
		}

		if(typeof document.compatMode != 'undefined' && document.compatMode != 'BackCompat') {
			return document.documentElement.scrollTop;
		}

		return document.body.scrollTop;
	},

	/**
	 * 添加监听事件
	 */
	_addListener: function(node, type, listener) {
		if(node.addEventListener) {
			node.addEventListener(type, listener, false);
			return true;
		} else if(node.attachEvent) {
			node['e' + type + listener] = listener;
			node[type + listener] = function() {
				node['e' + type + listener](window.event);
			};
			node.attachEvent('on' + type, node[type + listener]);
			return true;
		}
		return false;
	},

	/**
	 * 获取上一个节点
	 */
	_getPrevElement: function(element) {
		var prev = element.previousSibling;
		while(prev.nodeType !== 1) {
			prev = prev.previousSibling;
		}
		return prev;
	}
};

//comment.js

(function() {

function reply(authorId, commentId, commentBox) {
	var author = MGJS.$(authorId).innerHTML;
	var insertStr = '<a href="#' + commentId + '">@' + author.replace(/\t|\n|\r\n/g, "") + ' </a> \n';

	appendReply(insertStr, commentBox);
}

function quote(authorId, commentId, commentBodyId, commentBox) {
	var author = MGJS.$(authorId).innerHTML;
	var comment = MGJS.$(commentBodyId).innerHTML;

	var insertStr = '<blockquote cite="#' + commentBodyId + '">';
	insertStr += '\n<strong><a href="#' + commentId + '">' + author.replace(/\t|\n|\r\n/g, "") + '</a> :</strong>';
	insertStr += comment.replace(/\t/g, "");
	insertStr += '</blockquote>\n';

	insertQuote(insertStr, commentBox);
}

function appendReply(insertStr, commentBox) {
	if(MGJS.$(commentBox) && MGJS.$(commentBox).type == 'textarea') {
		field = MGJS.$(commentBox);

	} else {
		alert("The comment box does not exist!");
		return false;
	}

	if (field.value.indexOf(insertStr) > -1) {
		alert("You've already appended this reply!");
		return false;
	}

	if (field.value.replace(/\s|\t|\n/g, "") == '') {
		field.value = insertStr;
	} else {
		field.value = field.value.replace(/[\n]*$/g, "") + '\n\n' + insertStr;
	}
	field.focus();
}

function insertQuote(insertStr, commentBox) {
	if(MGJS.$(commentBox) && MGJS.$(commentBox).type == 'textarea') {
		field = MGJS.$(commentBox);

	} else {
		alert("The comment box does not exist!");
		return false;
	}

	if(document.selection) {
		field.focus();
		sel = document.selection.createRange();
		sel.text = insertStr;
		field.focus();

	} else if (field.selectionStart || field.selectionStart == '0') {
		var startPos = field.selectionStart;
		var endPos = field.selectionEnd;
		var cursorPos = startPos;
		field.value = field.value.substring(0, startPos)
					+ insertStr
					+ field.value.substring(endPos, field.value.length);
		cursorPos += insertStr.length;
		field.focus();
		field.selectionStart = cursorPos;
		field.selectionEnd = cursorPos;

	} else {
		field.value += insertStr;
		field.focus();
	}
}

window['MGJS_CMT'] = {};
window['MGJS_CMT']['reply'] = reply;
window['MGJS_CMT']['quote'] = quote;

})();


//viewHistory
ViewHistory = function() {

	this.config = {
		limit: 10,
		storageKey: 'viewHistory',
		primaryKey: 'url'
	};

	this.cache = {
		localStorage:  null,
		userData:  null,
		attr:  null
	};
};

ViewHistory.prototype = {

	init: function(config) {
		this.config = config || this.config;
		var _self = this;

		// define localStorage
		if (!window.localStorage && (this.cache.userData = document.body) && this.cache.userData.addBehavior && this.cache.userData.addBehavior('#default#userdata')) {
			this.cache.userData.load((this.cache.attr = 'localStorage'));

			this.cache.localStorage = {
				'getItem': function(key) {
					return _self.cache.userData.getAttribute(key);
				},
				'setItem': function(key, value) {
					_self.cache.userData.setAttribute(key, value);
					_self.cache.userData.save(_self.cache.attr);
				}
			};

		} else {
			this.cache.localStorage = window.localStorage;
		}
	},

	addHistory: function(item) {
		var items = this.getHistories();
		for(var i=0, len=items.length; i<len; i++) {
			if(item[this.config.primaryKey] && items[i][this.config.primaryKey] && item[this.config.primaryKey] === items[i][this.config.primaryKey]) {
				items.splice(i, 1);
				break;
			}
		}

		items.push(item);

		if(this.config.limit > 0 && items.length > this.config.limit) {
			items.splice(0, 1);
		}

		var json = JSON.stringify(items);
		this.cache.localStorage.setItem(this.config.storageKey, json);
	},

	getHistories: function() {
		var history = this.cache.localStorage.getItem(this.config.storageKey);
		if(history) {
			return JSON.parse(history);
		}
		return [];
	}
};


//footer function
function linove_sidebarFollow(elementId,distanceToTop){
	(new SidebarFollow()).init({
		element: elementId,
		distanceToTop: distanceToTop
	});
}
function linove_viewHistory(config){
	if(typeof localStorage !== 'undefined' && typeof JSON !== 'undefined') {
	    var viewHistory = new ViewHistory();
	    viewHistory.init({
	        limit: config.limit,
	        storageKey: config.storageKey,
	        primaryKey: config.primaryKey
	    });
	}
	// 如果
	var wrap = document.getElementById(config.storageKey);
	if(!viewHistory){
		if(wrap){
			wrap.style.display = 'none';
		}
		return;
	}
	// 如果 ViewHistory 的实例存在，并且外层节点存在，则可显示历史浏览记录
	if(viewHistory && wrap) {
   		// 获取浏览记录
    	var histories = viewHistory.getHistories();
   		 // 组装列表
    	var list = document.createElement('ul');
    	if(histories && histories.length > 0) {
	        for(var i=histories.length-1; i>=0; i--) {
	            var history = histories[i];
	            var item = document.createElement('li');
	            var link = document.createElement('a');
	            link.href = history.url;
	            link.innerHTML = history.title;
	            item.appendChild(link);
	            list.appendChild(item);
	        }
        	// 插入页面特定位置
       	 wrap.appendChild(list);
    	}
	}
	if( viewHistory && config.addHistory) {
	    var page = {
	        "title": document.getElementsByTagName('title')[0].innerHTML.split(config.titleSplit)[0],
	        "url": location.href // 这是 primaryKey
	        // "time": new Date()
	        // "author": ...
	        // 这里可以写入更多相关内容作为浏览记录中的信息
	    };
    	viewHistory.addHistory(page);
	}
}