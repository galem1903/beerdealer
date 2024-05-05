// Attendre que le document soit chargé avant d'exécuter le code
$(document).ready(function() {
    // Sélectionner le lien avec la classe "message a"
    $('.message a').click(function() {
        // Animer le formulaire en modifiant sa hauteur et son opacité
        $('form').animate({
            // Définir la hauteur du formulaire à "toggle"
            height: "toggle",
            // Définir l'opacité du formulaire à "toggle"
            opacity: "toggle"
        }, "slow"); // Définir la durée de l'animation à "slow" (600 millisecondes)
    });
});