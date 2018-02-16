var RequestHelper = {};

/**
 * Encode une URL et ses paramètres
 * @param string uri 
 * @param object datas 
 * @return string
 */
RequestHelper.buildHttpRequest = function(uri, datas) {
    if(Object.keys(datas).length) {
        var esc = encodeURIComponent;
        var query = Object.keys(datas)
            .map(k => esc(k) + '=' + esc(datas[k]))
            .join('&');
        return uri + "?" + query;
    } else {
        return uri;
    }
}

module.exports = RequestHelper;