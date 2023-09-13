let btn = document.getElementById("ievadit")
btn.addEventListener("click", () =>{
    let fname = document.getElementById("ievade").nodeValue;
    document.getElementById("teksts").innerHTML = fname;
    let square = document.querySelector(".square");
});