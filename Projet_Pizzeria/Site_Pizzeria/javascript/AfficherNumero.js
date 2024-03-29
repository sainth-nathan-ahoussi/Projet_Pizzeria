document.addEventListener('DOMContentLoaded', function () {
    // Sélectionnez l'élément li avec l'id "copierNumero"
    var copierNumero = document.getElementById('copierNumero');

    // Ajoutez un gestionnaire d'événement au clic
    copierNumero.addEventListener('click', function () {
        // Numéro de téléphone à copier
        var numeroTelephone = '0652394657';

        // Créez un élément input pour stocker le numéro
        var input = document.createElement('input');
        input.value = numeroTelephone;
        document.body.appendChild(input);

        // Sélectionnez le contenu de l'input
        input.select();
        document.execCommand('copy');

        // Supprimez l'input car il n'est plus nécessaire
        document.body.removeChild(input);

        // Affichez un message de succès
        alert('Le numéro a été copié avec succès !');
    });
});