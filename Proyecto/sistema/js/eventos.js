
fechaActual = (new Date()); // Fecha actual
fechaActual.setDate(fechaActual.getDate() + 1);
fechaActual = fechaActual.toISOString().split("T")[0];
document.getElementById("fechaEvento").setAttribute("min", fechaActual);
// Obtener la fecha actual
var fechaActual = new Date();
// Crear una nueva fecha sumando 30 días a la fecha actual
var fechaLimite = new Date(fechaActual.getTime() + (30 * 24 * 60 * 60 * 1000));
fechaLimite = fechaLimite.toISOString().split("T")[0];

function ocupada(str){
        var conexion;
        var ocupadas;
        if(str == ""){
            document.getElementById("txtHint").innerHTML="";
            return;
        }
        if(window.XMLHttpRequest)conexion = new XMLHttpRequest();
            conexion.onreadystatechange = function(){
        if(conexion.readyState == 4 && conexion.status == 200){
            ocupadas = document.getElementById("fechaEvento");
            if(conexion.responseText == 'true'){
                alert("Esta fecha se encuentra ocupada!");
                ocupadas.value = "";
            }

        }
        }
        conexion.open("GET", "evento/fechaEvento.php?dia=" + str, true);
        conexion.send();
        return ocupadas;
  }

document.getElementById("fechaEvento").addEventListener("change", function() {
    fecha = this.value;
    console.log(fecha);
    console.log(ocupada(fecha));
    console.log(fechaLimite);
    if (fecha <= fechaLimite) {
        alert("El evento se tiene que registrar con un mes de anticipación!");
        this.value = "";
    }
});