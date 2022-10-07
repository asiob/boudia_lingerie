window.onload= () => {
//gestion des liens "supprimer"

let links = document.querySelectorAll("[data-delete]")


//on va bouclier sur links
for(link of links) { 
        //ecouter le clic
        link.addEventListener("click", function(e){
        //on empeche la navigation
        e.preventDefault()
        //on demande une confirmation 
        if(confirm("voulez-vous supprimer cette image?")){
            //on envoie une requete Ajax vers le href du lien avec la methose DELETE
                fetch(this.getAttribute("href"),{
                    method: " DELETE",
                    headers: {
                        'X-Requested-With':"XMLHttpRequest",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({"_token": this.dataset.token})
                }).then(
                    //on recupere la reponse en json
                    response => response.json()
                ).then(data => {
                    if(data.success)
                        this.parentElement.remove()
                        else    
                            alert(data.error)
                })

            }
        })
    }   
}