tab = document.getElementsByClassName("tablinks")[0].click();

function openTab(evt, tabName) {
    var i, k, tabcontent, tablinks;

    // Oculta todos los contenidos de las pestañas
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    // Desactiva todos los botones de las pestañas
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    // Muestra el contenido de la pestaña seleccionada
    document.getElementById(tabName).style.display = "block";

    // Agrega la clase "active" al botón de la pestaña seleccionada
    evt.currentTarget.className += " active";

  }