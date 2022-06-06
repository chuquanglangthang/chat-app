const searchBar = document.querySelector(".users .search input");
const searchBtn = document.querySelector(".users .search button");
const usersList = document.querySelector(".users .users-list");


searchBtn.onclick = ()=>{
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active");
    searchBar.value = "";// thiết lập giá trị trong searchbar là rỗng để không lưu lại giá trị đã search
}

searchBar.onkeyup = ()=>{
    let searchTerm = searchBar.value;

    // trong cùng 1 file thì ajax chạy tới 2 lần, 1 lần cho việc hiển thị những người đang online, 1 lần hiển thị những người ta search
    // nên chúng bị đè lên nhau
    // do đó ta cần thêm 1 class active để khi người dùng search thì chỉ chạy setInterval Ajax nếu ko có active class

    if(searchTerm != ""){
        searchBar.classList.add("active");
    }else{
        searchBar.classList.remove("active");
    }
    // Start Ajax
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "/chat-app/php/search.php", true); // nhận data với GET
    xhr.onreadystatechange = ()=>{
        if(xhr.readyState === 4){
            if(xhr.status === 200){
                let data = xhr.response;
                usersList.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm); // send users search term to php file with ajax
}

setInterval(()=>{
    // Start Ajax
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("GET", "/chat-app/php/users.php", true); // nhận data với GET
    xhr.onload = ()=>{
        if(xhr.readyState === 4){
            if(xhr.status === 200){
                let data = xhr.response;
                // console.log(data);
                if(!searchBar.classList.contains("active")){
                    usersList.innerHTML = data;
                }
            }
        }
    }
    xhr.send();
},500); // this function will run frequently after 500ms