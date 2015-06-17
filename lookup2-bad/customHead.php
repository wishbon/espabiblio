<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 *
 * JavaScript & CSS Material contained here is unigue to the content of
 * this directory folder. It is incorporated into loading programs via the
 * '../shared/header_top file'.
 *
 * Provisions to include material unique to a particular portion is
 * at the end of thie file.
 */
	require_once("../shared/common.php");
?>

<style>
fieldset {	width: 50%;	}
h4 {	margin: 0; padding: 0; text-align: left; color: blue;	}
h5 {	margin: 0; padding: 0; text-align: left; color: blue;	}
h5#updateMsg {	color: red;	}
table#showList tr {	height: 1.3em;	}
th.colHead {  text-align: top; white-space: nowrap;	}
td.lblFld {  white-space: nowrap;	}
td.inptFld {  vertical-align: top;	}
td.btnFld {  text-align: center;	}
.editBtn {	margin: 0; padding: 0; height: 1.5em; text-align:center;	}
</style>

<!-- load common jQuery library -->
<script src="../scripts/jquery.js" type="text/javascript"></script>

<script language="JavaScript1.4" >
//console.log('js file loaded');

//license data object
lookup = {
	version:		'2.0.9',
	author:			'Fred LaPlante',
	date:       '08 Sept 2009',
	license:		'http://www.gnu.org/licenses/lgpl.txt Lesser GNU Public License',
	copyright:	'2004,5,6,7,8,9 All Rights Reserved.',
	email:			'flaplante at flos-inc dot com',
	comment:    'add-on/plugin for OpenBiblio v0.6+'
}

//------------------------------------------------------------------------------
// jQuery plugins for lookup
// element enable/disable - 'jQuery in Action', p12, 22Aug2008 - fl
$.fn.disable = function () {
	return this.each(function () {
//					if (typeof this.disabled != "undefined)") this.disabled = true;
					if (typeof this.disabled != "undefined)") $(this).attr('disabled',true);
				 });
};
$.fn.enable = function () {
	return this.each(function () {
//					if (typeof this.disabled != "undefined)") this.disabled = false;
					if (typeof this.disabled != "undefined)") $(this).attr('disabled',false);
				 });
};
//------------------------------------------------------------------------------
// flos-lib stuff for lookup
// get/set selected value or text
flos = {
	getSelectBox: function  (boxId, getText/*boolean*/) {
		if (typeof(boxId) === 'string')
			sel = $('#'+boxId);
		else
	   	sel = boxId;
		var choice = sel[0].selectedIndex;
		if(getText)
			rslt = sel[0].options[choice].text;
		else
			rslt = sel[0].options[choice].value;
		return rslt;
	},
/* --------------------------------- */
	setSelectBox: function  (boxId,optText,exactMatch) {
		var theBox;
		if (typeof(boxId) === 'string')
			theBox = $('#'+boxId);
		else
	   	theBox = boxId;
		//console.log('theBox is '+theBox);

		if (!theBox)alert('cant find select box with ID='+boxId);
		var opts = theBox[0].options;
		if (exactMatch == null) exactMatch = true;
		//console.log('in select box: '+boxId+'; match='+exactMatch+'; look for '+optText);
		for (var i=0; i<opts.length; i++) {
			//console.log('want:'+optText+'; have:'+opts[i].text+' ('+opts[i].value+'); #'+i+' of '+opts.length);
			if (opts[i].selected) opts[i].selected=false;
			if (exactMatch == 'useId') {
				//console.log('with useId"');
			  if (opts[i].value == optText) {
					opts[i].selected = true;
					return;
				}
			} else if (exactMatch == true) {
				//console.log('w/exact, want:'+optText+'; have:'+opts[i].text+' ('+opts[i].value+'); #'+i+' of '+opts.length);
				if (opts[i].text.replace(/ /g,'') == optText.replace(/ /g,'')) {
					opts[i].selected = true;
					return;
				}
			} else {
				//console.log('w/???');
				//alert('want:'+optText+'; have:'+opts[i].text+' ('+opts[i].value+'); #'+i+' of '+opts.length);
			   if (optText == '-') return;
				if (opts[i].text.indexOf(optText)>0) {
					opts[i].selected = true;
					return;
				}
		  }
		}
	}
}
//$(document).ready(flos.init);
</script>

<?php
$thisPgm = pathinfo($_SERVER[SCRIPT_FILENAME]);
/*
echo "</br>";
echo "</br>";
echo "thisPgm name: $thisPgm[basename]<br /><br />";

echo "</br>";
echo $thisPgm[basename] ; //joanlaga quitar
echo "</br>";
echo "<pre>";
print_r($thisPgm);
echo "</pre>";
*/
//switch ($_SERVER[PHP_SELF]) {
switch ($thisPgm[basename]) {
//	case '/openbiblio/lookup2/lookup.php':
	case 'lookup.php':
		require_once(REL(__FILE__, "lookupJs.php"));
	  break;
//	case '/openbiblio/lookup2/lookup.php':
	case 'lookup2/lookup.php':
		require_once(REL(__FILE__, "lookupJs.php"));
	  break;

//	case '/openbiblio/lookup2/lookupHostsForm.php':
	case 'lookupHostsForm.php':
		require_once(REL(__FILE__, "lookupHostsJs.php"));
		break;
//	case '/openbiblio/lookup2/lookupHostsForm.php':
	case 'lookup2/lookupHostsForm.php':
		require_once(REL(__FILE__, "lookupHostsJs.php"));
		break;

//	case 'lookupHostsForm.php':
	case 'lookupOptsForm.php':
		require_once(REL(__FILE__, "lookupOptsJs.php"));
		break;

//	case '/openbiblio/lookup2/lookupOptsForm.php':
	case 'lookup2/lookupOptsForm.php':
		require_once(REL(__FILE__, "lookupOptsJs.php"));
		break;
		
	default:
	  echo "debug of customHead.php  Ooops! Something is wrong! You should never get here. If you do <br />".
	  		 "it is most likely that a directory name is not correct.<br /><br />".
				 "Debug information:<br />".
				 "Server Document Root: $_SERVER[DOCUMENT_ROOT] <br />".
				 "Web path to program:  $_SERVER[SCRIPT_FILENAME] <br />".
				 "php_self:  $_SERVER[PHP_SELF] <br />".
				 "<br />Please check your directory name spelling.";
}
