

$("#send").on('click', function(){

    correctUser= "phpInnclod"
    correctClave ="1nncl0d*"

    console.log()
    
    if($("#user").val()=== '' || $("#clave").val() === ''){
            
        console.log(`vacio \n username: ${$("#user").val()} \n clave: ${$("#clave").val()}`);
            
        if ($("#user").val()=== '') {
            $("#user").css("border","2px solid red");
        }
        if ($("#clave").val()=== '') {
            $("#clave").css("border","2px solid red");
        }
        if ($("#user").val() === correctUser) {
            $("#user").css("border","");
        }
        
        if ($("#clave").val() === correctClave) {
            $("#clave").css("border","");
        }  
  
    }
    else {
        if ($("#user").val() !== correctUser) {
            $("#user").css("border","2px solid red");
        }
        else{
            $("#user").css("border","");
        }
        if ($("#clave").val() !== correctClave) {
            $("#clave").css("border","2px solid red");
        }  
        else{
            $("#clave").css("border","");
        }

        if ($("#user").val() !== correctUser && $("#clave").val() !== correctClave) {
            $("#user").css("border","2px solid red");
            $("#clave").css("border","2px solid red");
            alert("Credenciales de acceso incorrectas, intente nuevamente.")
        }  

        else if ($("#user").val() === correctUser && $("#clave").val() === correctClave){

            console.log(`ENTRO \n username: ${$("#user").val()} \n clave: ${$("#clave").val()}`);
            localStorage.setItem('sesion', true);
            window.location.href = "crud.php"; 
        }
        }
    
    $("#user").val('');
    $("#clave").val('');
})