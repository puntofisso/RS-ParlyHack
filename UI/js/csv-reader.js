/**
 * fileName: URL (local or absolute)
 * successFunction(data): data is an Array[row][col]
 */
function retrieveCSV(fileName, successFunction) {
    $.ajax({
        type: "GET",
        url: fileName,
        dataType: "text",
        success: function(data) { successFunction(parseCSV(data)); }
     });
}

function parseCSV(input) {
    var lines = input.split("\t");
    var data = new Array();
    for (var i = 0; i < lines.length; i++) {
        data.push(lines[i].split(","));
    }
    return data;
}

