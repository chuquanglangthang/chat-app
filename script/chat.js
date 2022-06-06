const form = document.querySelector(".typing-area");
const sendBtn = form.querySelector("button");
const inputField = form.querySelector(".input-field");
const chatBox = document.querySelector(".chat-box");

form.onsubmit = (e)=>{
    e.preventDefault();
}

sendBtn.onclick = ()=>{
    // Start Ajax
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "/chat-app/php/insert-chat.php", true);
    xhr.onreadystatechange = ()=>{
        if(xhr.readyState === 4){
            if(xhr.status === 200){
                inputField.value = "";// khi tin nhắn được lưu vào trong database thì để lại khoảng trắng ở phần soạn tin
                scrollToBottom();
            }
        }
    }
    // Send the form data through ajax to php
    let formData = new FormData(form); // Create new formData Object
    xhr.send(formData);// send the form data to php    
}

//prevent automatically scrolled to bottom
chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}
chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(()=>{
    // Start Ajax
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "/chat-app/php/get-chat.php", true); 
    xhr.onload = ()=>{
        if(xhr.readyState === 4){
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")){ // if active class not contains in chatbox, then scrolltobottom
                    scrollToBottom();
                }
            }
        }
    }
    // Send the form data through ajax to php
    let formData = new FormData(form); // Create new formData Object
    xhr.send(formData);// send the form data to php   
},500); // this function will run frequently after 500ms


// hiển thị tin nhắn mớI nhất ở dưới cùng
// tuy nhiên do ajax chạy mỗi 500ms nên sẽ ko thể kéo lên trên được mà nó sẽ tự động kéo xuống dưới
function scrollToBottom (){
    chatBox.scrollTop = chatBox.scrollHeight;
}