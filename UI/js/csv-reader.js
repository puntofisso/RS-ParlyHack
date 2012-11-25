/**
 * fileName: URL (local or absolute)
 * successFunction(data): data is an Array[row][col]
 */
function retrieveCSV(fileName, successFunction) {
    try {

        var jqxhr = $.get(fileName, function() {
            alert("success");
        })
            .success(function() { alert("second success"); })
            .error(function() { alert("error"); })
            .complete(function() { alert("complete"); });

        /*    
        $.get(fileName, function(data) {
            var parsed = parseCSV(data);
            successFunction(data);
        });
        */
    
    } catch(e) { alert(e); }
}

function parseCSV(input) {
    try {
        var lines = input.split("\t");
        var data = new Array();
        for (var i = 0; i < lines.length; i++) {
            data.push(lines[i].split(","));
        }
        return data;
    } catch (e) { alert(e); }
    return null;
}
