'use strict'
//RICARDO HERNÁNDEZ 1090-18-4098
// document.getElementById('formulario').onsubmit

function validar(){
   const nombre = document.getElementById('nombre').value;
   const apellido = document.getElementById('apellido').value;
   const dpi2 = document.getElementById('dpi').value;
//    const imagen = document.getElementById('imagen').value;

    if(nombre == '' || apellido == '' || dpi2 == ''){
        alert('LLene todos los campos');
        window.event.stopPropagation();
        window.event.preventDefault();
        return false;
    }else{
     
        if(dpi2.length < 13){
            alert('DPI incompleto');
            window.event.stopPropagation();
        window.event.preventDefault();
        return false;
        }
    }

}

function succesCase(case_name){
    messegue = "Caso "+case_name+" creado exitósamente!";
    alert(messegue);
}