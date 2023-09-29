//Declaramos la función cambiarAlbum(id) con el para metro "id" referenciando la id del  evento seleccionado en la
//galeria de eventos.
function cambiarAlbum(id){
  //Declaramos una varible llamada conexión que más adelante usaremos para el estado de conexión.
  var conexion;
  // Comprueba si el parámetro 'id' está vacío.
  if(id == ""){
    // Si está vacío, borra el contenido del elemento con el id "txtHint".
    document.getElementById("txtHint").innerHTML="";
    return;
  }
  // Comprueba si el navegador admite XMLHttpRequest
  if(window.XMLHttpRequest)conexion = new XMLHttpRequest();
    // Define la función a ejecutar cuando cambia el estado de la conexión.
    conexion.onreadystatechange = function(){
    // Comprueba si la conexión se ha completado y se ha recibido una respuesta válida.
    if(conexion.readyState == 4 && conexion.status == 200){
      // Divide la respuesta en un arreglo de fotos separadas por "%%"
      fotos = conexion.responseText.split("%%");
      // Actualiza las imágenes en el documento HTML con las fotos recibidas por el archivo carrusel.php
      for(i=0; i < fotos.length; i++)document.getElementById("fotos"+i).src=fotos[i];
      //En este momento es cuando se introducen las imágenes en la pagina galeria de eventos
      //en el carrusel de fotos situado en la derecha de la pagina.
      console.log(id)
      console.log(conexion.responseText);
    }
  }
  //Aquí es donde se abre y se manda manda la petición de conexión el archivo carrusel.php
  //que es de donde se sacan las imagenes del album, junto con el id del evento seleccionado
  conexion.open("GET", "carrusel.php?id=" + id, true);
  conexion.send();
}
