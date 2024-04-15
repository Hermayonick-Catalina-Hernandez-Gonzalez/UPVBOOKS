const like = document.getElementById('like');

like.addEventListener('click', function(e){
    const dataId = this.dataset.id;
    console.log(dataId)
    
    const config = {
        method: 'POST', // El método HTTP a utilizar
        headers: {
          'Content-Type': 'application/json', // Especifica el tipo de contenido que se envía
        },
        body: JSON.stringify({ id: dataId }), // Convierte el id en formato JSON y lo incluye en el cuerpo de la solicitud
      };
    
      // Realiza la solicitud fetch
      fetch('../php/likes.php', config)
        .then((response) => {
          // Verifica si la respuesta es exitosa (código de estado 200-299)
          if (!response.ok) {
            throw new Error('Error en la solicitud: ' + response.statusText);
          }
          // Convierte la respuesta en JSON
          return response.json();
        })
        .then((data) => {
          // Maneja la respuesta del servidor (datos recibidos)
          console.log('Respuesta recibida:', data);
          location.reload;
          // Aquí puedes realizar más acciones según la respuesta del servidor
        })
        .catch((error) => {
          // Maneja los errores de la solicitud
          console.error('Error:', error);
        });
});