$(document).ready(function() {

    var bindSortable = function() {
        $('.articles-table__content').sortable({
            placeholder: 'articles-table__row--placeholder',
            helper: 'articles-table__row--active',
            beforeStop: function(e, ui) {
                var id = ui.helper.attr('data-id');
                var currentPosition = ui.helper.attr('data-position');
                var newPosition = ui.helper.index();
                var path = $('.articles__table').attr('data-path');

                if (newPosition != currentPosition) {
                    $('.articles__table').fadeTo('medium', 0);

                    $.ajax({
                        url: path,
                        method: 'POST',
                        data: {
                            'id': id,
                            'position': newPosition
                        }
                    }).done(function(data) {
                        $('.articles__table').html(data);
                        $('.articles__table').fadeTo('medium', 1);

                        bindSortable();
                    }).done(function(msg) {
                        console.log(msg);
                    });
                }
            }
        });
    }

    bindSortable();

});
