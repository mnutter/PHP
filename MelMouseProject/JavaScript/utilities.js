function isEmpty(s) {
    if (s == null || s.length == 0)
        return true;

    // The test returns true if there is at least one non-
    // whitespace, meaning the string is not empty. If the
    // test returns true, the string is empty.
    return !/\S/.test(s);
}

function looksLikeEmail(field) {
    var _s = field.value;

    if (isEmpty(_s))
    {
        return false;
    }

    if (/[^@]+@\w+/.test(_s))
        return true;

    return false;
}

function isInteger(field) {
    var _s = field.value;
    if (isEmpty(_s))    {
        return false;
    }

    if (!(/^-?\d+$/.test(_s))) {
        return false;
    }
    return true;
}
function isStateCode(s){
    //Validate against the list of U.S. Postal Codes for states, territories and armed forces

    var _delimeter = "|";
    var _USStateCodes = "AL|AK|AS|AZ|AR|CA|CO|CT|DE|DC|FM|FL|GA|GU|HI|ID|IL|IN|IA|KS|KY|LA|ME|MH|MD|MA|MI|MN|MS|MO|MT|NE|" +
                        "NV|NH|NJ|NM|NY|NC|ND|MP|OH|OK|OR|PW|PA|PR|RI|SC|SD|TN|TX|UT|VT|VI|VA|WA|WV|WI|WY|AE|AA|AE|AE|AP"

    if (isStateCode.arguments.length == 1){
        if (typeof(s) == 'string'){
            if (isEmpty(s)){
                return false;
            }
            if (s.length !=2){
                return false;
            }
        }
        else{
            alert("Parameter must be of type string for isStateCode");
            return false;
        }
    }
    else{
        alert("Only one parameter is allowed for isStateCode");
        return false;
    }


    //indexOf is case sensitive so UpperCase s
    s = s.toUpperCase();


    //Check the input to make sure it is found but not the delimiter
    return ( (_USStateCodes.indexOf(s) != -1) && (s.indexOf(_delimeter) == -1) );

}

function isPhone(field){
    //The phone number must be valid

   var _s = field.value;
    if (isEmpty(_s))    {
        return false;
    }

    if (!(/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/.test(_s))) {
        return false;
    }
    return true;
}

function isDate(field){
    //The date must be valid

   var _s = field.value;
    if (isEmpty(_s))    {
        return false;
    }

    if (!(/^\d{1,2}\/\d{1,2}\/\d{4}$/.test(_s))) {
        return false;
    }
    return true;
}
function isDecimal(field){
    var _s = field.value;
    if (isEmpty(_s))    {
        return false;
    }

    if (!(/^\s*-?[1-9]\d*(\.\d{1,2})?\s*$/.test(_s))) {
        return false;
    }
    return true;
}

function isValidCreditCard(type, ccnum) {
        //Validate the credit card

        return checkCreditCard(ccnum,type);
}

function isNumberInput(field, event) {
    //Check to see if the input is a number
    var key, keyChar;
    //Check to see if there's a window event
    if (window.event)
        key = window.event.keyCode;
    else if (event)
        key = event.which;
    else
        return true;
    //Check for special characters like backspace
    if (key == null || key == 0 || key == 8 || key == 13 || key == 27)
        return true;
    // Check to see if it's a number
    keyChar = String.fromCharCode(key);
    if (/\d/.test(keyChar)) {
        window.status = "";
        return true;
    }
    else {
        window.status = "Field accepts numbers only.";
        return false;
    }
}

 
function validate() {
    var i;
    var checkToMake;
    var field;
    var message;
    var errorField;
    
     
    for (i = 0; i < validations.length; i++) {
        field = eval(validations[i][0]);
        checkToMake = validations[i][1];
        message = validations[i][2];
        errorField = validations[i][3];
        
        //Set the error message
        document.getElementById(errorField).textContent = message;
        
        switch (checkToMake) {
            case 'notblank':
                if (isEmpty(field.value)) {            
                    document.getElementById(errorField).style.visibility = 'visible';
                    field.focus();
                    return false;
                }
                else {
                    document.getElementById(errorField).style.visibility = 'hidden';
                }
                break;
            case 'validstate':
                if (!isStateCode(field.value)) {
                    document.getElementById(errorField).style.visibility = 'visible';
                    field.focus();
                    return false;
                }
                else {
                    document.getElementById(errorField).style.visibility = 'hidden';
                }
                break;
            case 'validphone':
                if (!isPhone(field)) {
                    document.getElementById(errorField).style.visibility = 'visible';
                    field.focus();
                    return false;
                }
                else {
                    document.getElementById(errorField).style.visibility = 'hidden';
                }
                break;
            case 'validdate':
                if (!isDate(field)) {
                    document.getElementById(errorField).style.visibility = 'visible';
                    field.focus();
                    return false;
                }
                else {
                    document.getElementById(errorField).style.visibility = 'hidden';
                }
                break;

            case 'validemail':
                if (!looksLikeEmail(field)) {
                    document.getElementById(errorField).style.visibility = 'visible';
                    field.focus();
                    return false;
                }
                else {
                    document.getElementById(errorField).style.visibility = 'hidden';
                }
                break;
            case 'validcreditcard':
                var _el = document.getElementById("cardtype");
                var _cardtype = _el.options[_el.selectedIndex].value;
                if (!isValidCreditCard(_cardtype,field.value)) {
                    document.getElementById(errorField).style.visibility = 'visible';
                    field.focus();
                    return false;
                }
                else {
                    document.getElementById(errorField).style.visibility = 'hidden';
                }
                break;
            case 'isInteger':
                if (!isInteger(field)) {
                    document.getElementById(errorField).style.visibility = 'visible';
                    field.focus();
                    return false;
                }
                else {
                    document.getElementById(errorField).style.visibility = 'hidden';
                }
                break;
            case 'isDecimal':
                if (!isDecimal(field)) {
                    document.getElementById(errorField).style.visibility = 'visible';
                    field.focus();
                    return false;
                }
                else {
                    document.getElementById(errorField).style.visibility = 'hidden';
                }
                break;

        }
    }
    return true;
}
