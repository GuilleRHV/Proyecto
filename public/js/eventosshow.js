function escondercomentarios(valor) {

   

    let separador = valor.split("padre")
    let id = separador[1];
    let subcomentarios = document.getElementsByClassName("subcomentarios"+id);

    for(let i = 0; i <subcomentarios.length; i++) {
        if(subcomentarios[i].style.display == 'none'){
            subcomentarios[i].style.display = 'block';
        }else{
            subcomentarios[i].style.display = 'none';
        }
    }

  
    
 
}


/*
function escondercomentarios() {
    
   let botones= document.getElementsByClassName("boton");
   let todos = document.target.id;
   window.alert(todos.id);
    let idboton = botones.target.id;
    window.alert("has clicado");
        window.alert(idboton);
         

}*/