var servResponse = document.querySelector('#response');

document.forms.formAdddComments.onsubmit= function (e){
    author=document.forms.formAdddComments.name.value;
    message=document.forms.formAdddComments.message.value;
    e.preventDefault();
    var objXMLHttpRequest = new XMLHttpRequest();
    alert(author, message);
    objXMLHttpRequest.onreadystatechange = function () {
        if (objXMLHttpRequest.readyState === 4) {
            if (objXMLHttpRequest.status === 200) {
                let res= objXMLHttpRequest.responseText;
                alert(res)
                switch (parseInt(res)) {
                    case 1:
                        servResponse.style.color = "blue";
                        servResponse.textContent = "Успешный вход";
                        // window.location.href = '/successAuth'
                        break;
                    case 2:
                        servResponse.style.color = "red";
                        servResponse.textContent = "Вы ввели не верные данный/ пользователь не существует";
                        break;
                    case 3:
                        break;
                }
            } else {
                alert('Error Code: ' + objXMLHttpRequest.status);
                alert('Error Message: ' + objXMLHttpRequest.statusText);
            }
        }
    }

    objXMLHttpRequest.open('POST', '/post/addComments');
    objXMLHttpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    objXMLHttpRequest.send("&author="+author+ "&msg="+msg);
}









let items = [{
    "Id": "1",
    "Name": "abc",
    "Parent": "2"
}, {
    "Id": "2",
    "Name": "abc",
    "Parent": ""
}, {
    "Id": "3",
    "Name": "abc",
    "Parent": "5"
}, {
    "Id": "4",
    "Name": "abc",
    "Parent": "2"
}, {
    "Id": "5",
    "Name": "abc",
    "Parent": ""
}, {
    "Id": "6",
    "Name": "abc",
    "Parent": "2"
}, {
    "Id": "7",
    "Name": "abc",
    "Parent": "6"
},{
    "Id": "7",
    "Name": "abc",
    "Parent": "6"
},{
    "Id": "7",
    "Name": "abc",
    "Parent": "6"
},{
    "Id": "7",
    "Name": "abc",
    "Parent": "6"
},{
    "Id": "7",
    "Name": "abc",
    "Parent": "6"
},{
    "Id": "7",
    "Name": "abc",
    "Parent": "6"
},{
    "Id": "7",
    "Name": "abc",
    "Parent": "6"
}, {
    "Id": "8",
    "Name": "abc",
    "Parent": "6"
}];

function buildHierarchy(arry) {

    var roots = [],
        children = {};

    // find the top level nodes and hash the children based on parent
    for (var i = 0, len = arry.length; i < len; ++i) {
        var item = arry[i],
            p = item.Parent,
            target = !p ? roots : (children[p] || (children[p] = []));
        console.log(item)
        target.push({

            value: item
        });
    }

    // function to recursively build the tree
    var findChildren = function (parent) {
        if (children[parent.value.Id]) {
            parent.children = children[parent.value.Id];
            for (var i = 0, len = parent.children.length; i < len; ++i) {
                findChildren(parent.children[i]);
            }
        }
    };

    // enumerate through to handle the case where there are multiple roots
    for (var i = 0, len = roots.length; i < len; ++i) {
        findChildren(roots[i]);
    }

    return roots;
}

var hierarchy = buildHierarchy(items);

HTMLElement.prototype.appendList = function (arr) {
    var list = document.createElement('ul');

    arr.forEach(function (li_obj) {
        var li = document.createElement('li');

        li.textContent = li_obj.value.Name;

        if (li_obj.children) {
            li.appendList(li_obj.children);
        }

        list.appendChild(li);
    });

    this.appendChild(list);
}

document.body.appendList(hierarchy);
