// Fonction pour masquer le préchargeur
function hidePreloader() {
    const preloader = document.getElementById('preloader');
    preloader.style.display = 'none';
}

// Attendre que la page soit complètement chargée avant de masquer le préchargeur
window.addEventListener('load', hidePreloader);