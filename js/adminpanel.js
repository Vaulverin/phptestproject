$(function(){
    $('.btn-danger').click(function() {
        var id = $(this).attr('data-button');
        bootbox.confirm("Удлаить запись?", function(confirmed){
            if (confirmed)
            {
                window.location.replace("/AdminPanel/Remove/?id="+id);
            }
        });
    });
});