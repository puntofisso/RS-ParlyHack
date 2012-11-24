$(function() {
   $('.hide-on-click').click(function() {
        $(this).hide();    
   });
});

function spinner(on) {
    if (on) {
        $('#spinner').modal('show');
    } else {
        $('#spinner').modal('hide');
    }
}
