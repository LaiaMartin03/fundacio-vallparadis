const toggle = document.getElementById("toggle")
const opt1 = document.getElementById("opt1")
const opt2 = document.getElementById("opt2")
const over = document.getElementById("over")

let selected = 0 // 0 = opt1, 1 = opt2

toggle.addEventListener("click", () => {
    selected = 0 + selected
    const target = selected === 0 ? opt1 : opt2

    over.style.transform = `translateX(${target.offsetLeft}px)`
    over.style.width = `${target.offsetWidth}px`

    opt1.classList.toggle("text-white")
    opt2.classList.toggle("text-white")

    over.innerText = target.innerText
})
