var servResponse = document.querySelector('#response');



document.forms.formsRegister.onsubmit= function (e){
    e.preventDefault();

    email=document.forms.formsRegister.inputEmail.value;
    login=document.forms.formsRegister.inputLogin.value;
    password=document.forms.formsRegister.inputPassword.value;
    rePassword=document.forms.formsRegister.inputRePassword.value;

    if (password!==rePassword){
        alert("Passwords not coincidence");
    }
    else if (password===login){
        alert("Login similar password");
    }
    else if(!/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]+\.[a-z]{2,8}$/.test(email)){
        alert("Email not valid");
    }
    else{
    alert("email: "+email+ " login: "+login+ " password: "+password+ "rePassword: "+rePassword);
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

    objXMLHttpRequest.open('POST', '/post/register');
    objXMLHttpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    objXMLHttpRequest.send("&email= "+email+ "&login= "+login+ "&password= "+password);
}
}