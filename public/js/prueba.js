$(document).ready(function() {
    $(".votaciones").click(function(){
       // alert("Votacion");
        var id = $(this).attr("id");
       // console.log("id: "+id);
        

       
        var numId = id.split("votar");
        //console.log(numId[1]);
        var numero = numId[1];
            window.open("votaciones/"+numero+"/edit","ventanaEmergente","width=300px,height=300px");
     
});
    });