function searchForCards(query) {
    delay(function() {
        callPhpFunction("searchForCards", "query="+query, function(result) {
            // do something with the result.
            console.log(result);
        });
    }, 500);
}

// #region Helper methods
function callPhpFunction(functionName, param, successCallback) {
    $.ajax({
        type: "GET",
        url: "php/requestHandler.php",
        data: "functionname=" + functionName + "&" + param,
        success: successCallback
    });
}

var delay = (function() {
    var timer = 0;
    return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
    };
    })();
// #endregion