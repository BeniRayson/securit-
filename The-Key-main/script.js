function setActiveLink() {
  const currentPage = window.location.pathname.split('/').pop();
  document.querySelectorAll('.nav-link').forEach(link => {
      link.classList.remove('active');
  });

  if (currentPage === 'index.php') {
      document.getElementById('3').classList.add('active');
  } else if (currentPage === 'public.php') {
      document.getElementById('2').classList.add('active');
  } else if (currentPage === 'login.php') {
      document.getElementById('7').classList.add('active');
  } else if (currentPage === 'service.php') {
      document.getElementById('1').classList.add('active');
  } else if (currentPage === 'about.php') {
      document.getElementById('4').classList.add('active');
  } else if (currentPage === 'dashboard.php') {
      document.getElementById('5').classList.add('active');
  }
}

document.addEventListener('DOMContentLoaded', function() {
  function previewImage(event) {
      const input = event.target;
      const reader = new FileReader();
      reader.onload = function() {
          const preview = input.nextElementSibling.nextElementSibling;
          preview.src = reader.result;
          preview.style.display = 'block';
      };
      reader.readAsDataURL(input.files[0]);
  }

  const imageInputs = document.querySelectorAll('.image-input');
  imageInputs.forEach(input => {
      input.addEventListener('change', previewImage);
  });

  setActiveLink();
});

function showPub(pubElement) {
  pubElement.style.display = 'block';
}

function hidePub(pubElement) {
  pubElement.style.display = 'none';
}

function fetchFonctions(query) {
  fetch('fetch_fonctions.php?q=' + query)
  .then(response => response.json())
  .then(data => {
      const fonctionList = document.getElementById('fonction-list');
      fonctionList.innerHTML = '';
      data.forEach(fonction => {
          const option = document.createElement('option');
          option.value = fonction;
          fonctionList.appendChild(option);
      });
  })
  .catch(error => console.error('Error fetching fonctions:', error));
}

document.addEventListener('DOMContentLoaded', function() {
  const fonctionInput = document.getElementById('fonction');
  fonctionInput.addEventListener('input', function() {
      fetchFonctions(this.value);
  });
});

window.onload = setActiveLink;