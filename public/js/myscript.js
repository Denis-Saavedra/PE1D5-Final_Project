document.getElementById("Enviar").onclick = function() {
    var iframe = document.getElementById("video");
    iframe.contentWindow.location.reload();  // Isso recarrega o iframe
};
