console.log('le fichier js est bien chargé');

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

// Gestion de la création du compte
const buttonAccepter = document.getElementById('buttonAccepter');
const form = document.querySelector('form');

buttonAccepter.addEventListener('click', () => {
  // Empêcher le rechargement de la page
  console.log('bouton cliqué  ')
  event.preventDefault();

  // Créer un objet FormData avec les données du formulaire
  const formData = new FormData(form);

  // Envoyer les données au fichier PHP
  fetch('form.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(data => {
    // Gérer la réponse du serveur
    console.log(data);
    // Vous pouvez afficher un message de succès ou d'erreur ici
  })
  .catch(error => {
    console.error('Erreur :', error);
    // Gérer les erreurs ici
  });
});