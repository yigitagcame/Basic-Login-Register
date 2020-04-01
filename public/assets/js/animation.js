let animation = {};

animation.formWrapper = document.getElementsByClassName("whiteBox")[0];
animation.loginForm = document.getElementById("login");
animation.signUpForm = document.getElementById("register");


animation.slideForm = (state) => {

    let forms = animation.formWrapper.classList;
    let loginForm = animation.loginForm.classList;
    let signUpForm = animation.signUpForm.classList;
    let headLine = document.getElementById("headline");

    if (state == 1){

        forms.remove("login");
        forms.add("singUp");
        loginForm.add("hide");

        setTimeout(function () {
            animation.loginForm.style.display = "none";
            animation.signUpForm.style.display = "block";
            headLine.innerText = headLine.getAttribute("data-register-text");
            signUpForm.remove("hide");
        },300);


    }else{

        forms.remove("singUp");
        forms.add("login");
        loginForm.remove("hide");
        signUpForm.add("hide");

        setTimeout(function () {
            animation.loginForm.style.display = "block";
            animation.signUpForm.style.display = "none";

            headLine.innerText = headLine.getAttribute("data-login-text");
        },300);

    }

};

animation.messageShow = (message) => {

    let messageBox = document.getElementById("message");

    messageBox.style.display = 'block';
    messageBox.innerText = message;


};

animation.messageHide = () =>{

    setTimeout(function () {
        let messageBox = document.getElementsByClassName("message");
        if(messageBox.length > 0){
            messageBox[0].style.display = "none";
        }
    },3000)

};


