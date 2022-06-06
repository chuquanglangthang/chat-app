const form = document.querySelector(".signup form");
const continueBtn = form.querySelector(".button input");
const errorText = form.querySelector(".error-txt");

form.onsubmit = (e)=>{
    e.preventDefault();
}

continueBtn.onclick = ()=>{
    // Start Ajax
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "/chat-app/php/signup.php", true);
    xhr.onreadystatechange = ()=>{
        if(xhr.readyState === 4){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "Success!"){
                    location.href = "users-list-page.php";
                    // alert("Successfully Signed In!")
                }else{
                    errorText.textContent = data;
                    errorText.style.display = "block";
                }
            }
        }
    }
    // Send the form data through ajax to php
    let formData = new FormData(form); // Create new formData Object
    console.log(formData);
    xhr.send(formData);// send the form data to php
}