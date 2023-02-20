//  при отключенном javascript кнопка формы будет состоянии 'disabled'
//      работающий javascript отключает эту опцию у формы

var _onload =
  window.onload ||
  function () {
    document.getElementById("submitBtn").disabled = false;
  };

_onload();
