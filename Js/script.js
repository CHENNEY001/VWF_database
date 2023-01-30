const signinBtn = document.getElementById("signin");
const signupBtn = document.getElementById("signup");
const firstform = document.getElementById("form1");
const secondform = document.getElementById("form2");
const container = document.querySelector(".container")

signinBtn.addEventListener("click", ()=>{
    container.classList.remove("right-panel-active")
})

signupBtn.addEventListener("click", ()=>{
    container.classList.add("right-panel-active")
})

firstform.addEventListener("submit", (e) => e.preventDefault())
secondform.addEventListener("submit", (e) => e.preventDefault())