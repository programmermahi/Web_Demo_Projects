
document.addEventListener('DOMContentLoaded',() => {
    var element = document.querySelector('.size')
    console.log(element)
    element.addEventListener('click',() => {
        element.innerHTML = 'Hello from Js'
    })
})