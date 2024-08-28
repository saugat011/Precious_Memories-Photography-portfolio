// JavaScript for the file upload input
const fileInput = document.getElementById('fileInput');
const chooseFileButton = document.getElementById('chooseFileButton');

chooseFileButton.addEventListener('click', () => {
  fileInput.click();
});

fileInput.addEventListener('change', () => {
  const fileName = fileInput.files[0].name;
  chooseFileButton.textContent = fileName;
});



