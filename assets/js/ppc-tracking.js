/*
         * Retrive ppc querystring values, save in cookie and populate hidden form fields.
         * 
         * Updated August 1, 2016 by Digital Pi
         * 
         * This script should be placed in the body of the page below the form and before the </body> tag
         * ppcUrlCookiePart1 and ppcUrlCookiePart2 must be called, see bottom of script
         * update ppcUrlCookiePart2 and ppcUrlCookiePart2 to match your querystring and form field names
         * 
         */


//Leave this as true to always use querystring values if they exist, if no querystring will attempt to get cookie values
var ppcUseLatestValues = true; //set this to false to use cookie values if they exist (if false, will not check querystring first).

//function to grab params from cookie
function getCookie(param_name) {
    var i, x, y, cookie = document.cookie.split(";");
    for (i = 0; i < cookie.length; i++) {
        x = cookie[i].substr(0, cookie[i].indexOf("="));
        y = cookie[i].substr(cookie[i].indexOf("=") + 1);
        x = x.replace(/^\s+|\s+$/g, "");
        if (x == param_name) {
            return unescape(y);
        }
    }
}

//function to create cookie
function setCookie(param_name, value, exdays) {
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + exdays);
    //CHANGE DOMAIN BELOW TO MATCH SITE
    var c_value = escape(value) + ((exdays == null) ? "" : "; domain=presencelearning.com; path=/; expires=" + exdate.toUTCString());
    document.cookie = param_name + "=" + c_value;
}

//function to check if cookie exists and, if so, run the setCookie function
function checkCookie(param_name, param_url_name) {

    var param_value = getCookie(param_name);
    if ((param_value != null && param_value != "" && param_value != "undefined") && ppcUseLatestValues == false) {
        //this means the param name/value pair exists - and we don't want to use latest
    }
    else {
        //this means the param name/value pair does not exist - so create it 
        //grab values from URL
        var pageURL = window.location.search.substring(1);
        var URLVariables = pageURL.split('&');
        for (var i = 0; i < URLVariables.length; i++) {
            var parameterName = URLVariables[i].split('=');
            if (parameterName[0] == param_url_name) {
                //filter out "#" in case that is in the last URL param
                param_value = parameterName[1].split("#")[0];
            }
        }
            
        if (param_value != "undefined" && param_value != "" && param_value != null) {
            //create cookie
            setCookie(param_name, param_value, 365);
        }
    }
}


//function to setup the parameters and save the cookie values
function ppcUrlCookiePart1() {
    //setup list/array of parameters desired. names on right should match querystring names
    var param_names = new Array(
        'ppcSource;utm_source',
        'ppcMedium;utm_medium',
        'ppcCampaign;utm_campaign',
        'ppcAdGroup;utm_adgroup',
        'ppcKeyword;utm_term',
        'ppcContent;utm_content'
    );


    //loop through all params and create cookie
    for (i = 0; i < param_names.length; i++) {
        var param_object = param_names[i].split(";");//split out the cookie name and url name
        var param_name = param_object[0];
        var param_url_name = param_object[1];
        //start the cookie creation
        checkCookie(param_name, param_url_name);
    }
}



//function to grab cookie params
function mGetCookie(param_name) {
    var i, x, y, cookie = document.cookie.split(";");
    for (i = 0; i < cookie.length; i++) {
        x = cookie[i].substr(0, cookie[i].indexOf("="));
        y = cookie[i].substr(cookie[i].indexOf("=") + 1);
        x = x.replace(/^\s+|\s+$/g, "");
        if (x == param_name) {
            return unescape(y);
        }
    }
}

//function to check if cookie exists and, if so, fill out the corresponding form fields
function mCheckCookie(param_name, param_field_name) {
	var param_value = mGetCookie(param_name);
	if (param_value != null && param_value != "" && param_value != "undefined") {
        try
        {
            var obj1 = document.getElementsByName(param_field_name);
            obj1[0].value = param_value;
            return true;
        }
        catch (err) 
        {
            return false;
        }
	}
	return false;
}

//function to setup parameters and begin cookie value insertion into marketo form
function ppcUrlCookiePart2() {
    //setup list/array of parameters desired. names on right should match hidden form field names
    var param_names = new Array(
        'ppcSource;utm_source__c',
        'ppcMedium;utm_medium__c',
        'ppcCampaign;utm_campaign__c',
        'ppcAdGroup;utm_adgroup__c',
        'ppcKeyword;utm_term__c',
        'ppcContent;utm_content__c'
    );

    //loop through all params and create cookie
    for (i = 0; i < param_names.length; i++) {
        var param_object = param_names[i].split(";");//split out the cookie name and url name
        var param_name = param_object[0];
        var param_field_name = param_object[1];
        //start the cookie creation
        mCheckCookie(param_name, param_field_name);
    }
}

//ppcUrlCookiePart1 will grab values from the querystring and save them in cookies
ppcUrlCookiePart1();

//ppcUrlCookiePart2 will retrive values from the cookies and populate the hidden form fields - should be in the onload
try
{
    //attempt for Marketo form
    MktoForms2.whenReady(function (form){
     ppcUrlCookiePart2();
    });
}
catch (err) 
{
    //if error on Marketo form, try loading for regular form.
    ppcUrlCookiePart2();
}