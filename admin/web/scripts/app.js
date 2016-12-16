$(document).ready(function() {

    $('.articles-table__content').sortable({
        placeholder: 'articles-table__row--placeholder',
        helper: 'articles-table__row--active',
        beforeStop: function(e, ui) {
            // Mettre à jour la position de l'article "drag and droppé"
            // Ne rien faire si on a remis l'élément à la même position
                // Utiliser un data-position sur le tr
                // Comparer la position de l'article dans le tableau par rapport à data-position
            console.log(ui.helper.index());

            // Utiliser le data-id pour savoir quel élément on a sélectionné
            console.log(ui.helper.attr('data-id'));

            // En ajax, renvoyer vers une action qui va permettre de mettre à jour les positions des articles
            // -> modifier la position de l'article sélectionné + des articles suivants dans la liste
            // -> créer une méthode spécifique pour cela dans ArticleDAO
            // -> renvoyer seulement le template du contenu du tableau avec la nouvelle liste d'article
            // Afficher le contenu avec un fadeout / fadein
        }
    });

});
