let app = {};

app.appendInputs = () => {
    let form, allInputWrappers, lastInputWrapper ,lastInputsId, nextInputsId, elements;

    form = document.getElementById("fields");
    allInputWrappers = document.getElementsByClassName("inputField");

    if(allInputWrappers.length > 0){
        lastInputsId = parseInt(allInputWrappers[allInputWrappers.length-1].getAttribute("id"));
    }else{
        lastInputsId = 0;
    }

    nextInputsId = "0" + parseInt(lastInputsId+1);

    elements = {
        "DIV#inputWrapper": {
            'id': nextInputsId,
            'class' : 'inputField'
        }
    };
    app.elementCreate(elements,form);

    lastInputWrapper = allInputWrappers[allInputWrappers.length-1];

    elements = {
        "INPUT#fields" : {
            'type' : 'text',
            'name' : 'fields[]',
            'placeholder' : 'Fields Name',
            'required' : 'required',
        },
        "INPUT#values" : {
            'type' : 'text',
            'name' : 'values[]',
            'placeholder' : 'Value',
            'required' : 'required',
        },
        "INPUT#hidden" : {
            'type' : 'hidden',
            'name' : 'ids[]',
            'value' : '0',
        },
        "Button#delete" : {
            'type' : 'button',
            'class' : 'button action delete',
            'name' : 'delete',
            'onclick' : 'app.removeAttr("'+nextInputsId+'")',
        },
    };

    app.elementCreate(elements,lastInputWrapper);

    document.getElementById(nextInputsId).querySelector(".delete").innerHTML="DELETE";

};

app.formSubmit = (type) => {

    let url,params;

    document.querySelector("form").addEventListener("submit",function (event) {
        event.preventDefault();
    });

    url = document.getElementById(type).getAttribute("action");

    params = {
        "email" : document.querySelector("#"+type+" input[name='email']").value,
        "password" : document.querySelector("#"+type+" input[name='password']").value
        };

    if(type == "register"){
        params.name = document.querySelector("#"+type+" input[name='name']").value;
    }

    app.postRequest(url,params, function (response) {

       let parseResponse = JSON.parse(response);

       if (parseResponse.success == "1"){
           window.location.href = parseResponse.redirect;
       }else{
           animation.messageShow(parseResponse.messages);
       }

    });

};

app.removeAttr = (id) => {
    if (id[0] == 0){
        app.elementRemove(id);
    }else{
        let url= "/user/attr/"+id;
        app.getRequest(url,function (response) {
            app.elementRemove(id);
        });
    }
};

app.getRequest = (url, callback) => {

    const Http = new XMLHttpRequest();
    Http.open("GET", url);
    Http.send();

    Http.onreadystatechange = (e) => {
        if (Http.responseText == "1"){
            return callback(Http.responseText)
        }
    }

};


app.postRequest = (url, params, callback) => {

    const Http = new XMLHttpRequest();
    let body = '';

    for(let key in params){
        body = body+key+"="+params[key]+"&";
    }

    Http.open("POST", url, true);
    Http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    Http.send(body);
    Http.onload = (e) => {
        if (Http.readyState === 4) {
            if (Http.status === 200) {
                return callback(Http.responseText)
            } else {
                console.error(Http.statusText);
            }
        }
    }


};


app.elementCreate = (elements,parent) => {

    for (let element in elements){

        let elementType = element.split("#")[0];
        let newElement = document.createElement(elementType);

        for (let attr in elements[element]){
            newElement.setAttribute(attr,  elements[element][attr] );
        }

        parent.appendChild(newElement);
    }

};

app.elementRemove= (id) => {
    let form = document.getElementById("fields");
    let attr = document.getElementById(id);
    form.removeChild(attr);
};


