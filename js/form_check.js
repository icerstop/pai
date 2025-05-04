// form_check.js
function isWhiteSpaceOrEmpty(str) {
    return /^\s*$/.test(str);
}

function isEmailInvalid(str) {
    let emailPattern = /^[a-zA-Z0-9._]+@[a-zA-Z0-9._]+\.[a-zA-Z]{2,}$/;
    return !emailPattern.test(str);
}

function checkStringAndFocus(obj, msg, validationFunction) {
    let str = obj.value;
    let errorFieldName = "e_" + obj.name.substr(2);
    if (errorFieldName === "e_email") {
        if (isEmailInvalid(str)) {
            document.getElementById(errorFieldName).innerHTML = msg;
            obj.focus();
            return false;
        } else {
            document.getElementById(errorFieldName).innerHTML = "";
            return true;
        }
    }
    if (validationFunction(str)) {
        document.getElementById(errorFieldName).innerHTML = msg;
        obj.focus();
        return false;
    } else {
        document.getElementById(errorFieldName).innerHTML = "";
        return true;
    }
}

function showElement(e) {
    document.getElementById(e).style.visibility = 'visible';
}

function hideElement(e) {
    document.getElementById(e).style.visibility = 'hidden';
}

function alterRows(i, e) {
    if (e) {
        if (i % 2 === 1) {
            e.style.backgroundColor = 'Aqua';
        }
        alterRows(i + 1, e.nextElementSibling);
    }
}

function validate(form) {
    let errors = form.querySelectorAll("span.err");
    errors.forEach(function(err) {
        err.innerHTML = "";
    });
    
    let valid = true;
    valid = checkStringAndFocus(form.elements["f_imie"], "Wpisz poprawne imię", isWhiteSpaceOrEmpty) && valid;
    valid = checkStringAndFocus(form.elements["f_nazwisko"], "Wpisz poprawne nazwisko", isWhiteSpaceOrEmpty) && valid;
    valid = checkStringAndFocus(form.elements["f_kod"], "Wpisz poprawny kod pocztowy", isWhiteSpaceOrEmpty) && valid;
    valid = checkStringAndFocus(form.elements["f_ulica"], "Wpisz poprawną ulicę", isWhiteSpaceOrEmpty) && valid;
    valid = checkStringAndFocus(form.elements["f_miasto"], "Wpisz poprawne miasto", isWhiteSpaceOrEmpty) && valid;
    valid = checkStringAndFocus(form.elements["f_email"], "Wpisz poprawny adres email", isWhiteSpaceOrEmpty) && valid;
    
    return valid;
}

window.onload = function() {
    let table = document.getElementsByTagName("table")[0];
    let firstRow = table.querySelector("tr");
    alterRows(1, firstRow);
};

function swapRows(button) {
    let table = button.previousElementSibling;
    let tBody = table.querySelector("tbody");
    let lastRow = tBody.lastElementChild;
    tBody.removeChild(lastRow);
    let firstRow = tBody.firstElementChild;
    tBody.insertBefore(lastRow, firstRow);
}

function cnt(textarea, msg, maxSize) {
    if (textarea.value.length > maxSize)
        textarea.value = textarea.value.substring(0, maxSize);
    else
        msg.innerHTML = maxSize - textarea.value.length;
}
