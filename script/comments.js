let servResponse = document.querySelector('#response');

document.forms.formAddComments.onsubmit = function (e) {
    let author = document.forms.formAddComments.name.value;
    let message = document.forms.formAddComments.message.value;
    e.preventDefault();
    if (author == "" || message == "") {
        alert("Не все поля заполнены")
    } else {
        document.forms.formAddComments.name.value = "";
        document.forms.formAddComments.message.value = "";
        let objXMLHttpRequest = new XMLHttpRequest();
        objXMLHttpRequest.onreadystatechange = function () {
            if (objXMLHttpRequest.readyState === 4) {
                if (objXMLHttpRequest.status === 200) {
                    loadComments()
                } else {
                    alert('Error Code: ' + objXMLHttpRequest.status);
                    alert('Error Message: ' + objXMLHttpRequest.statusText);
                }
            }
        }
        objXMLHttpRequest.open('POST', '/post/addComments');
        objXMLHttpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        objXMLHttpRequest.send("&author=" + author + "&msg=" + message);
    }
}

document.forms.formAddChildComments.onsubmit = function (e) {
    let author = document.forms.formAddChildComments.name.value;
    let message = document.forms.formAddChildComments.message.value;
    let parentId = document.forms.formAddChildComments.parentId.value;
    e.preventDefault();

    if (author == "" || message == "" || parentId == "") {
        alert("Не все поля заполнены")
    } else {
        document.forms.formAddChildComments.name.value = "";
        document.forms.formAddChildComments.message.value = "";
        document.forms.formAddChildComments.parentId.value = "";
        let objXMLHttpRequest = new XMLHttpRequest();
        objXMLHttpRequest.onreadystatechange = function () {
            if (objXMLHttpRequest.readyState === 4) {
                if (objXMLHttpRequest.status === 200) {
                    let res = objXMLHttpRequest.responseText;
                    let comments = document.getElementsByClassName('comments')[0];
                    let innerDiv = document.getElementsByClassName('form-add-child-comments')[0];
                    console.log(innerDiv)
                    let temp = document.getElementsByClassName("tempAddClass")[0];
                    console.log(temp)
                    temp.before(innerDiv)
                    innerDiv.style.display = "none";
                    loadComments();
                } else {
                    alert('Error Code: ' + objXMLHttpRequest.status);
                    alert('Error Message: ' + objXMLHttpRequest.statusText);
                }
            }
        }
        objXMLHttpRequest.open('POST', '/post/addComments');
        objXMLHttpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        objXMLHttpRequest.send("&author=" + author + "&msg=" + message + "&parentId=" + parentId);
    }
}

function addParentComment(id) {
    document.getElementById('parentId').value = id;
    let innerDiv = document.getElementsByClassName('form-add-child-comments')[0];
    let btn = document.getElementById("btn" + id);
    btn.style.display = "none"
    let parent = document.getElementById(id);
    btn.before(innerDiv)
    innerDiv.style.display = "block";
    console.log(parent)
}

function loadComments() {
    let comments = document.getElementsByClassName('comments')[0];
    let objXMLHttpRequest = new XMLHttpRequest();
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                let res = objXMLHttpRequest.responseText;
                comments.innerHTML = res;
            } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
                alert('Error Message: ' + objXMLHttpRequest.statusText);
            }
        }
    }
    objXMLHttpRequest.open('GET', '/loadComments');
    objXMLHttpRequest.send();

}

