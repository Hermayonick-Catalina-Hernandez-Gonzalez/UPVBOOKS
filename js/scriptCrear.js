document.getElementById('foto').addEventListener('change', function (event) {
  const file = event.target.files[0];
  const fotoPreview = document.querySelector('.foto-preview');
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      fotoPreview.style.backgroundImage = `url(${e.target.result})`;
      fotoPreview.style.backgroundSize = 'cover';
    };
    reader.readAsDataURL(file);
  } else {
    fotoPreview.style.backgroundImage = '';
  }
});

document.getElementById('seleccionar-foto').addEventListener('click', function () {
  document.getElementById('foto').click();
});

document.getElementById('formCrear').addEventListener("submit", function (e) {
  e.preventDefault();
  var formData = new FormData(this);

  fetch('../php/guardar_archivo.php', {
    method: 'POST',  // Usa el método POST
    body: formData,  // Envía el objeto FormData como cuerpo de la solicitud
  }).then(response => {
    if (!response.ok) {
      // Si el estado HTTP no es OK, lanza un error con el estado y el texto de la respuesta
      return response.text().then(text => {
        throw new Error(`HTTP error ${response.status}: ${text}`);
      });
    }
    return response.json();
  })
    .then(data => {
      // Maneja la respuesta JSON
    })
    .catch(error => {
      // Maneja cualquier error que pueda ocurrir durante la solicitud
      console.error('Error:', error);
    });
});