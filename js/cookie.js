/**
 * Función de Javascript que comprueba si están aceptadas las cookies de seguimiento para los datos 
 */

(function () {
  $(function () {
    if (!localStorage.getItem("cookies-aceptadas")) {
      $("#aviso-cookies").modal("show");
    }
  });
})();
