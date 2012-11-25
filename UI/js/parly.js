

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

function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}