console.log(data);
// main

var main = document.getElementById("main");
var estado = (data.estado=='true')?'Verdadero': 'Falso';
var finalizado = (data.finalizado=='true')?'Verdadero': 'Falso';
var html = `
            <div clas="uuid_class"><b>UUID de la Solicitud: </b> ${data.requestUuid}</div>
            <div>
              <ul>
                  <li><b>Estado: </b>${estado}</li>
                  <li><b>Finalizado: </b>${finalizado}</li>
                  <li><b>Mensaje: </b>${data.mensaje}</li>
                  <li><b>UUID de la blockchain: </b>${data.uuidBlockchain}</li>
                  <li><b>Codigo transaccion blockchain:  </b>${data.transactionCode}</li>
                  <li> <a href="${data.linkVerificacionUnico}"> Link de verificacion del documento </a> </li>
             </ul>
             <b>Link de verificacion: </b> <a href="${data.linkVerificacion}">${data.linkVerificacion}</a>
           </div>`;

main.innerHTML = html;

// <li><b>Codigo de la transaccion en la blockchain:  </b>${data.transactionCode}</li>
