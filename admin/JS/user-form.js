const img = document.getElementById('photoLabel');
const inputFile = document.querySelector('.inputFile');

img.addEventListener('click', () => {
  inputFile.click();
});

inputFile.addEventListener('change', (event) => {

  const file = inputFile.files[0];

  // Vérifier l'extension
  const imageType = /image.*/; 
  if (!file.type.match(imageType)) {
    alert('Le fichier doit être une image');
    return;
  }

  // Vérifier le type
  const validExts = ['jpeg', 'jpg', 'png'];
  const fileExt = file.name.split('.').pop();
  if (!validExts.includes(fileExt)) {
    alert('Le fichier doit être au format JPEG, JPG ou PNG');
    return;
  }

  // Afficher l'image sélectionnée
  const reader = new FileReader();
  reader.onload = function(event) {
    img.setAttribute('src', event.target.result); 
  }
  reader.readAsDataURL(file);

});