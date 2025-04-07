function isEmpty(str) {
    return str.length == 0;
}

function validate(form) {

    let errorFields = document.getElementsByClassName("err");
    for (let i = 0; i<errorFields.length; i++) {
        errorFields[i].innerHTML = "";
    }
    
    let valid = true;
    
    if (!checkStringAndFocus(form.elements["f_imie"], "Podaj imię!", "e_imie")) {
        valid = false;
    }
    
    if (!checkStringAndFocus(form.elements["f_nazwisko"], "Podaj nazwisko!", "e_nazwisko")) {
        valid = false;
    }

    if (!checkStringAndFocus(form.elements["f_kod"], "Podaj kod pocztowy!", "e_kod")) {
        valid = false;
    }

    if (!checkStringAndFocus(form.elements["f_ulica"], "Podaj ulicę/osiedle!", "e_ulica")) {
        valid = false;
    }
    
    if (!checkStringAndFocus(form.elements["f_miasto"], "Podaj miasto!", "e_miasto")) {
        valid = false;
    }

    if (!checkStringAndFocus(form.elements["f_email"], "e_email")) {
        valid = false;
    }

    
    return valid;
}

function isWhiteSpaceOrEmpty(str) { 
    return /^[\s\t\r\n]*$/.test(str); 
}

function checkString(str, msg) {
    if (isEmpty(str) || isWhiteSpaceOrEmpty(str)) {
        alert(msg);
        return false;
    }
    return true;
}

function checkEmail(str) {
    let email = /^[a-zA-Z_0-9\.]+@[a-zA-Z_0-9\.]+\.[a-zA-Z][a-zA-Z]+$/;
    if (email.test(str)) {
        return true;
    }
    else {
        alert("Podaj właściwy e-mail");
        return false;
    }
}

function checkStringAndFocus(obj, msg, errorId) { 
    let str = obj.value.trim(); 
    let errorElement = document.getElementById(errorId);
    if (isWhiteSpaceOrEmpty(str)) { 
        errorElement.innerHTML = msg;
        alert(msg);
        obj.focus(); 
        return false; 
    } 
    else {
        errorElement.innerHTML = "";
        return true; 
    } 
}

function checkEmailAndFocus(obj, msg) {
    let str = obj.value;
    let errorFieldName = "e_" + obj.name.substr(2);
    let emailPattern = /^[a-zA-Z0-9._]+@[a-zA-Z0-9._]+\.[a-zA-Z]{2,}$/;

    if (!emailPattern.test(str)) {
        document.getElementById(errorFieldName).innerHTML = msg;
        alert(msg);
        obj.focus();
        return false;
    } else {
        document.getElementById(errorFieldName).innerHTML = "";
        return true;
    }
}

