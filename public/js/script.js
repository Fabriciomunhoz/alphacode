function confirmDelete(id) {
    $.confirm({
        title: 'Confirmar Exclusão',
        content: 'Tem certeza que deseja excluir este contato?',
        buttons: {
            confirm: {
                text: 'Excluir',
                action: function () {
                    window.location.href = 'index.php?action=delete&id=' + id;
                }
            },
            cancel: {
                text: 'Cancelar',
                action: function () {
                }
            }
        }
    });
}
$(document).ready(function() {
    $('.input-bottom-only').on('focus', function() {
        $(this).prev('.lbl-input').addClass('focused');
    }).on('blur', function() {
        $(this).prev('.lbl-input').removeClass('focused');
    });
});
