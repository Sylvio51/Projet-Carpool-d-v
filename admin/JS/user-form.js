console.log('le fichier js est bien chargé');

const img = document.getElementById('photoLabel');
const inputFile = document.querySelector('.inputFile');

img.addEventListener('click', () => {
  inputFile.click();
});

inputFile.addEventListener('change', (event) => {

  const file = inputFile.files[0];

  const imageType = /image.*/; 
  if (!file.type.match(imageType)) {
    alert('Le fichier doit être une image');
    return;
  }

  const validExts = ['jpeg', 'jpg', 'png'];
  const fileExt = file.name.split('.').pop();
  if (!validExts.includes(fileExt)) {
    alert('Le fichier doit être au format JPEG, JPG ou PNG');
    return;
  }

  const reader = new FileReader();
  reader.onload = function(event) {
    img.setAttribute('src', event.target.result); 
  }
  reader.readAsDataURL(file);

});

const buttonAccepter = document.getElementById('buttonAccepter');
const form = document.querySelector('form');

buttonAccepter.addEventListener('click', () => {
  console.log('bouton cliqué  ')
  event.preventDefault();

  const formData = new FormData(form);

  fetch('form.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(data => {
    console.log(data);
  })
  .catch(error => {
    console.error('Erreur :', error);
  });
});

const passwordFields = document.querySelectorAll('input[type="password"]');

passwordFields.forEach(passwordField => {
  const toggleEye = document.createElement('span');
  toggleEye.classList.add('toggle-eye');
  toggleEye.innerHTML = '<i class="fas fa-eye"></i>';

  passwordField.parentNode.insertBefore(toggleEye, passwordField.nextSibling);

  toggleEye.addEventListener('click', () => {
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    toggleEye.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
  });
});

const passwordField = document.querySelectorAll('.password-field');

passwordField.forEach(passwordField => {
  const passwordInput = passwordField.querySelector('input[type="password"]');
  const toggleEye = passwordField.querySelector('.toggle-eye');

  toggleEye.addEventListener('click', () => {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    toggleEye.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
  });
});