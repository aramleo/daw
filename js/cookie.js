(function () {
  $(function () {
    if (!localStorage.getItem("cookies-aceptadas")) {
      $("#aviso-cookies").modal("show");
    }
  });
})();
