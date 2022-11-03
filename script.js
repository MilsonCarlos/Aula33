var exibe = document.getElementById("exibe")

if(document.cookie.indexOf(['atualizado'])>=0) {
    exibe.innerHTML = "Atualizado com Sucesso!"
    exibe.style.backgroundColor = "orange"
    exibe.style.color = "white"
    exibe.className = "show"
    setTimeout(()=>{
        exibe.style.display = 'none'
    }, 3000)

 document.cookie = "atualizado=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/Aula3"
}


if(document.cookie.indexOf(['deletado'])>=0) {
    exibe.innerHTML = "Deletado com Sucesso!"
    exibe.style.backgroundColor = "red"
    exibe.style.color = "white"
    exibe.className = "show"
    setTimeout(()=>{
        exibe.style.display = 'none'
    }, 3000)

    document.cookie = "deletado=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/Aula3" 
}