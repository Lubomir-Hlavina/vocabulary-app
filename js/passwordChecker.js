const password1 = document.querySelector(".password-first")
const password2 = document.querySelector(".password-second")
const paragraphText = document.querySelector(".result-text")

password1.addEventListener("input", () => {
    const password1Value = password1.value
    const password2Value = password2.value
    
    if (password1Value === password2Value){
        paragraphText.textContent = "Heslá sa zhodujú"
        paragraphText.classList.add("valid")
        paragraphText.classList.remove("invalid")
    } else {
        paragraphText.textContent = "Heslá sa nezhodujú"
        paragraphText.classList.add("invalid")
        paragraphText.classList.remove("valid")
    }

    if (password1Value === "" && password2Value === ""){
        paragraphText.textContent = ""
    }
})

password2.addEventListener("input", () => {
    const password1Value = password1.value
    const password2Value = password2.value

    if (password1Value === password2Value) {
        paragraphText.textContent = "Heslá sa zhodujú"
        paragraphText.classList.add("valid")
        paragraphText.classList.remove("invalid")
    } else {
        paragraphText.textContent = "Heslá sa nezhodujú"
        paragraphText.classList.add("invalid")
        paragraphText.classList.remove("valid")
    }

    if (password1Value === "" && password2Value === "") {
        paragraphText.textContent = ""
    }
})
