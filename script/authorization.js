var servResponse = document.querySelector('#response');

document.forms.formsLogin.onsubmit= function (e){
    email=document.forms.formsLogin.inputEmail.value;
    password=document.forms.formsLogin.inputPassword.value;
    alert("email= "+email+ "password= "+password)
    e.preventDefault();
    var objXMLHttpRequest = new XMLHttpRequest();

    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                alert(objXMLHttpRequest.responseText);
            } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
                alert('Error Message: ' + objXMLHttpRequest.statusText);
            }
        }
    }

    objXMLHttpRequest.open('POST', '/post/auth');
    objXMLHttpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    objXMLHttpRequest.send("&email= "+email+ "&password= "+password);
}