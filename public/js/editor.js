let editor = document.querySelector("#write")
let write = document.querySelector("#write")
let writeContent = document.querySelector("#writeContent")

let submit = document.querySelector("#submit")

keyList = {}
editor.addEventListener("keypress", (event) => {
    //event.preventDefault()
    keyList[event.keyCode] = event.key 
    

    if(event.shiftKey && event.key == "Enter"){
        keyList = {}
        alert("pulou com shift")
    }

    if(event.key == "Enter"){
        event.preventDefault();
    }
})

submit.onclick = () => {
    writeContent.innerHTML = write.innerHTML
    
    return true
}