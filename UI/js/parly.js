$(function() {
   try {
    
        $('.hide-on-click').click(function() {
             $(this).hide();    
        });
     
        $('.toggle-text-on-click').click(function() {
             var currentText = $(this).text();
             var toggleText = $(this).attr('data-text');
             
             $(this).text(toggleText);
             $(this).attr('data-text', currentText);
        });
        
        $('img.centered').load(function() { $(this).center(); });
   
   } catch(e) { alert(e); }
});

function spinner(on) {
    if (on) {
        $('#spinner').modal('show');
    } else {
        $('#spinner').modal('hide');
    }
}
