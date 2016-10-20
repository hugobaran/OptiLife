function centerModal(id){
    var modal = document.getElementById(id);
    var heightModal = modal.offsetHeight;
    var heightUser = window.innerHeight;
    var marginTop = (heightUser - heightModal) / 2;
    modal.style.marginTop = marginTop+'px';
}

function ouvrir_modal(windows){
    centerModal(windows+'Modal');
    var popup=document.getElementById(windows);
    popup.style.backgroundColor="rgba(0, 0, 0, 0.5)";
    popup.style.visibility="visible";
}

function fermer_modal(id){
    var popup = document.getElementById(id);
    popup.style.visibility="hidden";
}