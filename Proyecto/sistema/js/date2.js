fechaActual = (new Date()); // Fecha actual
fechaActual.setDate(fechaActual.getDate() + 1);
fechaActual = fechaActual.toISOString().split("T")[0];
document.getElementById("fecha").setAttribute("min", fechaActual);

function muestraSelect(str, id){
  var conexion;
  if(str == ""){
    document.getElementById("txtHint").innerHTML="";
    return;
  }
  if(window.XMLHttpRequest)conexion = new XMLHttpRequest();
  conexion.onreadystatechange = function(){
    if(conexion.readyState == 4 && conexion.status == 200){
      document.getElementById("horarios").innerHTML=conexion.responseText;
      console.log(str)
    }
  }
  conexion.open("GET", "../citas/checkTime.php?dia=" + str + "/" + id, true);
  conexion.send();
}