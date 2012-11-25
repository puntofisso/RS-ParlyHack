/**
 * fileName: URL (local or absolute)
 * successFunction(data): data is an Array[row][col]
 */
function retrieveCSV(fileName, successFunction) {
    try {

        $.get(fileName, function(data) {
            var parsed = parseCSV(data);
            successFunction(parsed);
        });
    
    } catch(e) { alert(e); }
}

function parseCSV(input) {
    try {
        var lines = input.split("\n");
        var data = new Array();
        for (var i = 0; i < lines.length; i++) {
            var rowdata = lines[i].split(",");
            data.push(rowdata);
        }
        return data;
    } catch (e) { alert(e); }
    return null;
}
