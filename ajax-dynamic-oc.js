	/************************************************************************************************************
	(C) www.dhtmlgoodies.com, April 2006
	
	This is a script from www.dhtmlgoodies.com. You will find this and a lot of other scripts at our website.	
	
	Terms of use:
	You are free to use this script as long as the copyright message is kept intact. However, you may not
	redistribute, sell or repost it without our permission.
	
	Thank you!
	
	www.dhtmlgoodies.com
	Alf Magne Kalleland
	
	************************************************************************************************************/	

	var ajaxBox_offsetXOC = 0;
	var ajaxBox_offsetYOC = 0;
	var ajax_list_externalFileOC = 'ajax-list-oc.php';	// Path to external file
	var minimumLettersBeforeLookupOC = 1;	// Number of letters entered before a lookup is performed.
	
	var ajax_list_objectsOC = new Array();
	var ajax_list_cachedListsOC = new Array();
	var ajax_list_activeInputOC = false;
	var ajax_list_activeItemOC;
	var ajax_list_optionDivFirstItemOC = false;
	var ajax_list_currentLettersOC = new Array();
	var ajax_optionDivOC = false;
	var ajax_optionDiv_iframeOC = false;

	var ajax_list_MSIE = false;
	if(navigator.userAgent.indexOf('MSIE')>=0 && navigator.userAgent.indexOf('Opera')<0)ajax_list_MSIE=true;
	
	var currentListIndexOC = 0;
	
	function ajax_getTopPosOC(inputObj)
	{
		
	  var returnValue = inputObj.offsetTop;
	  while((inputObj = inputObj.offsetParent) != null){
	  	returnValue += inputObj.offsetTop;
	  }
	  return returnValue;
	}
	
	function ajax_list_cancelEventOC()
	{
		return false;
	}
	
	function ajax_getLeftPosOC(inputObj)
	{
	  var returnValue = inputObj.offsetLeft;
	  while((inputObj = inputObj.offsetParent) != null)returnValue += inputObj.offsetLeft;
	  
	  return returnValue;
	}
	
	function ajax_option_setValueOC(e,inputObj)
	{
		if(!inputObj)inputObj=this;
		var tmpValue = inputObj.innerHTML;
		if(ajax_list_MSIE)tmpValue = inputObj.innerText;else tmpValue = inputObj.textContent;
		if(!tmpValue)tmpValue = inputObj.innerHTML;
		ajax_list_activeInputOC.value = tmpValue;
		if(document.getElementById(ajax_list_activeInputOC.name + '_hidden'))document.getElementById(ajax_list_activeInputOC.name + '_hidden').value = inputObj.id; 
		ajax_options_hideOC();
	}
	
	function ajax_options_hideOC()
	{
		if(ajax_optionDivOC)ajax_optionDivOC.style.display='none';	
		if(ajax_optionDiv_iframeOC)ajax_optionDiv_iframeOC.style.display='none';
	}

	function ajax_options_rollOverActiveItemOC(item,fromKeyBoard)
	{
		if(ajax_list_activeItemOC)ajax_list_activeItemOC.className='optionDiv';
		item.className='optionDivSelectedOC';
		ajax_list_activeItemOC = item;
		
		if(fromKeyBoard){
			if(ajax_list_activeItemOC.offsetTop>ajax_optionDivOC.offsetHeight){
				ajax_optionDivOC.scrollTop = ajax_list_activeItemOC.offsetTop - ajax_optionDivOC.offsetHeight + ajax_list_activeItemOC.offsetHeight + 2 ;
			}
			if(ajax_list_activeItemOC.offsetTop<ajax_optionDivOC.scrollTop)
			{
				ajax_optionDivOC.scrollTop = 0;	
			}
		}
	}
	
	function ajax_option_list_buildListOC(letters,paramToExternalFile)
	{
		
		ajax_optionDivOC.innerHTML = '';
		ajax_list_activeItemOC = false;
		if(ajax_list_cachedListsOC[paramToExternalFile][letters.toLowerCase()].length<=1){
			ajax_options_hideOC();
			return;			
		}
		
		
		
		ajax_list_optionDivFirstItemOC = false;
		var optionsAdded = false;
		for(var no=0;no<ajax_list_cachedListsOC[paramToExternalFile][letters.toLowerCase()].length;no++){
			if(ajax_list_cachedListsOC[paramToExternalFile][letters.toLowerCase()][no].length==0)continue;
			optionsAdded = true;
			var div = document.createElement('DIV');
			var items = ajax_list_cachedListsOC[paramToExternalFile][letters.toLowerCase()][no].split(/###/gi);
			
			if(ajax_list_cachedListsOC[paramToExternalFile][letters.toLowerCase()].length==1 && ajax_list_activeInputOC.value == items[0]){
				ajax_options_hideOC();
				return;						
			}
			
			
			div.innerHTML = items[items.length-1];
			div.id = items[0];
			div.className='optionDiv';
			div.onmouseover = function(){ ajax_options_rollOverActiveItemOC(this,false) }
			div.onclick = ajax_option_setValueOC;
			if(!ajax_list_optionDivFirstItemOC)ajax_list_optionDivFirstItemOC = div;
			ajax_optionDivOC.appendChild(div);
		}	
		if(optionsAdded){
			ajax_optionDivOC.style.display='block';
			if(ajax_optionDiv_iframeOC)ajax_optionDiv_iframeOC.style.display='';
			ajax_options_rollOverActiveItemOC(ajax_list_optionDivFirstItemOC,true);
		}
					
	}
	
	function ajax_option_list_showContentOC(ajaxIndex,inputObj,paramToExternalFile,whichIndex)
	{
		if(whichIndex!=currentListIndexOC)return;
		var letters = inputObj.value;
		var content = ajax_list_objectsOC[ajaxIndex].response;
		var elements = content.split('|');
		ajax_list_cachedListsOC[paramToExternalFile][letters.toLowerCase()] = elements;
		ajax_option_list_buildListOC(letters,paramToExternalFile);
		
	}
	
	function ajax_option_resizeOC(inputObj)
	{
		ajax_optionDivOC.style.top = (ajax_getTopPosOC(inputObj) + inputObj.offsetHeight + ajaxBox_offsetYOC) + 'px';
		ajax_optionDivOC.style.left = (ajax_getLeftPosOC(inputObj) + ajaxBox_offsetXOC) + 'px';
		if(ajax_optionDiv_iframeOC){
			ajax_optionDiv_iframeOC.style.left = ajax_optionDivOC.style.left;
			ajax_optionDiv_iframeOC.style.top = ajax_optionDivOC.style.top;			
		}		
		
	}
	
	function ajax_showOptionsOC(inputObj,paramToExternalFile,e)
	{
		if(e.keyCode==13 || e.keyCode==9)return;
		if(ajax_list_currentLettersOC[inputObj.name]==inputObj.value)return;
		if(!ajax_list_cachedListsOC[paramToExternalFile])ajax_list_cachedListsOC[paramToExternalFile] = new Array();
		ajax_list_currentLettersOC[inputObj.name] = inputObj.value;
		if(!ajax_optionDivOC){
			ajax_optionDivOC = document.createElement('DIV');
			ajax_optionDivOC.id = 'ajax_listOfOptionsOC';	
			document.body.appendChild(ajax_optionDivOC);
			
			if(ajax_list_MSIE){
				ajax_optionDiv_iframeOC = document.createElement('IFRAME');
				ajax_optionDiv_iframeOC.border='0';
				ajax_optionDiv_iframeOC.style.width = ajax_optionDivOC.clientWidth + 'px';
				ajax_optionDiv_iframeOC.style.height = ajax_optionDivOC.clientHeight + 'px';
				ajax_optionDiv_iframeOC.id = 'ajax_listOfOptions_iframeOC';
				
				document.body.appendChild(ajax_optionDiv_iframeOC);
			}
			
			var allInputs = document.getElementsByTagName('INPUT');
			for(var no=0;no<allInputs.length;no++){
				if(!allInputs[no].onkeyup)allInputs[no].onfocus = ajax_options_hideOC;
			}			
			var allSelects = document.getElementsByTagName('SELECT');
			for(var no=0;no<allSelects.length;no++){
				allSelects[no].onfocus = ajax_options_hideOC;
			}

			var oldonkeydown=document.body.onkeydown;
			if(typeof oldonkeydown!='function'){
				document.body.onkeydown=ajax_option_keyNavigationOC;
			}else{
				document.body.onkeydown=function(){
					oldonkeydown();
				ajax_option_keyNavigationOC() ;}
			}
			var oldonresize=document.body.onresize;
			if(typeof oldonresize!='function'){
				document.body.onresize=function() {ajax_option_resizeOC(inputObj); };
			}else{
				document.body.onresize=function(){oldonresize();
				ajax_option_resizeOC(inputObj) ;}
			}
				
		}
		
		if(inputObj.value.length<minimumLettersBeforeLookupOC){
			ajax_options_hideOC();
			return;
		}
				

		ajax_optionDivOC.style.top = (ajax_getTopPosOC(inputObj) + inputObj.offsetHeight + ajaxBox_offsetYOC) + 'px';
		ajax_optionDivOC.style.left = (ajax_getLeftPosOC(inputObj) + ajaxBox_offsetXOC) + 'px';
		if(ajax_optionDiv_iframeOC){
			ajax_optionDiv_iframeOC.style.left = ajax_optionDivOC.style.left;
			ajax_optionDiv_iframeOC.style.top = ajax_optionDivOC.style.top;			
		}
		
		ajax_list_activeInputOC = inputObj;
		ajax_optionDivOC.onselectstart =  ajax_list_cancelEventOC;
		currentListIndexOC++;
		if(ajax_list_cachedListsOC[paramToExternalFile][inputObj.value.toLowerCase()]){
			ajax_option_list_buildListOC(inputObj.value,paramToExternalFile,currentListIndexOC);			
		}else{
			var tmpIndex=currentListIndexOC/1;
			ajax_optionDivOC.innerHTML = '';
			var ajaxIndex = ajax_list_objectsOC.length;
			ajax_list_objectsOC[ajaxIndex] = new sack();
			var url = ajax_list_externalFileOC + '?' + paramToExternalFile + '=1&letters=' + inputObj.value.replace(" ","+");
			ajax_list_objectsOC[ajaxIndex].requestFile = url;	// Specifying which file to get
			ajax_list_objectsOC[ajaxIndex].onCompletion = function(){ ajax_option_list_showContentOC(ajaxIndex,inputObj,paramToExternalFile,tmpIndex); };	// Specify function that will be executed after file has been found
			ajax_list_objectsOC[ajaxIndex].runAJAX();		// Execute AJAX function		
		}
		
			
	}
	
	function ajax_option_keyNavigationOC(e)
	{
		if(document.all)e = event;
		
		if(!ajax_optionDivOC)return;
		if(ajax_optionDivOC.style.display=='none')return;
		
		if(e.keyCode==38){	// Up arrow
			if(!ajax_list_activeItemOC)return;
			if(ajax_list_activeItemOC && !ajax_list_activeItemOC.previousSibling)return;
			ajax_options_rollOverActiveItemOC(ajax_list_activeItemOC.previousSibling,true);
		}
		
		if(e.keyCode==40){	// Down arrow
			if(!ajax_list_activeItemOC){
				ajax_options_rollOverActiveItemOC(ajax_list_optionDivFirstItemOC,true);
			}else{
				if(!ajax_list_activeItemOC.nextSibling)return;
				ajax_options_rollOverActiveItemOC(ajax_list_activeItemOC.nextSibling,true);
			}
		}
		
		if(e.keyCode==13 || e.keyCode==9){	// Enter key or tab key
			if(ajax_list_activeItemOC && ajax_list_activeItemOC.className=='optionDivSelectedOC')ajax_option_setValueOC(false,ajax_list_activeItemOC);
			if(e.keyCode==13)return false; else return true;
		}
		if(e.keyCode==27){	// Escape key
			ajax_options_hideOC();			
		}
	}
	
	
	document.documentElement.onclick = autoHideListOC;
	
	function autoHideListOC(e)
	{
		if(document.all)e = event;
		
		if (e.target) source = e.target;
			else if (e.srcElement) source = e.srcElement;
			if (source.nodeType == 3) // defeat Safari bug
				source = source.parentNode;		
		if(source.tagName.toLowerCase()!='input' && source.tagName.toLowerCase()!='textarea')ajax_options_hideOC();
		
	}