function getUrlParameters() {
    const url = window.location.href;

    const queryString = url.split('?')[1];
    if (!queryString) {
        return {};
    }

    const params = queryString.split('&');
    const result = {};

    params.forEach(param => {
        const [key, value] = param.split('=');
        result[decodeURIComponent(key)] = decodeURIComponent(value || '');
    });

    return result;
}

function getFormData(form) {
    const formData = new FormData(form);
    const jsonData = {};
    const arrayFields = new Set();

    for (let element of form.elements) {
        if (element.name && element.name.endsWith('[]')) {
            arrayFields.add(element.name);
        }
    }

    arrayFields.forEach(name => {
        jsonData[name] = [];
    });

    formData.forEach((value, key) => {
        const trimmed = value.trim();

        if (arrayFields.has(key)) {
            if (trimmed !== '') {
                jsonData[key].push(trimmed);
            }
        } else {
            jsonData[key] = trimmed !== '' ? trimmed : null;
        }
    });

    return jsonData;
}

function apiGet(url, data = null){
    var responseData = null;
    $.ajax({
        method: "GET",
        url: (typeof apiUrl !== 'undefined' ? apiUrl : '') + 'api' + url,
        headers: {
            "Content-Type": "application/json",
        },
        xhrFields: {
            withCredentials: true
        },
        data: data,
        async: false,
        complete: function(response) {
            try {
                responseData = JSON.parse(response.responseText);
            } catch(e) {
                responseData = response.responseText;
            }
        }
    });

    return responseData;
}

function apiPost(url, data = null){
    var requestData;
    var requestHeaders;
    var processData = true;
    var contentType;
    if (data instanceof FormData) {
        requestData = data;
        requestHeaders = {};
        processData = false;
        contentType = false;
    } else {
        requestData = JSON.stringify(data);
        requestHeaders = {
            "Content-Type": "application/json",
        }
    }
    $.ajax({
        method: "POST",
        url: (typeof apiUrl !== 'undefined' ? apiUrl : '') + 'api' + url,
        data: requestData,
        headers: requestHeaders,
        xhrFields: {
            withCredentials: true
        },
        processData: processData,
        contentType: contentType,
        async: false,
        complete: function(response) {
            responseData = JSON.parse(response.responseText);
        }
    });

    return responseData;
}

function apiPut(url, data = null){
    var requestData;
    var requestHeaders;
    var processData = true;
    var contentType;
    if (data instanceof FormData) {
        requestData = data;
        requestHeaders = {};
        processData = false;
        contentType = false;
    } else {
        requestData = JSON.stringify(data);
        requestHeaders = {
            "Content-Type": "application/json",
        }
    }
    $.ajax({
        method: "PUT",
        url: (typeof apiUrl !== 'undefined' ? apiUrl : '') + 'api' + url,
        data: requestData,
        headers: requestHeaders,
        xhrFields: {
            withCredentials: true
        },
        processData: processData,
        contentType: contentType,
        async: false,
        complete: function(response) {
            responseData = JSON.parse(response.responseText);
        }
    });

    return responseData;
}

function apiDelete(url, data = null){
    var requestData;
    var requestHeaders;
    var processData = true;
    var contentType;
    if (data instanceof FormData) {
        requestData = data;
        requestHeaders = {};
        processData = false;
        contentType = false;
    } else {
        requestData = JSON.stringify(data);
        requestHeaders = {
            "Content-Type": "application/json",
        }
    }
    $.ajax({
        method: "DELETE",
        url: (typeof apiUrl !== 'undefined' ? apiUrl : '') + 'api' + url,
        data: requestData,
        headers: requestHeaders,
        xhrFields: {
            withCredentials: true
        },
        processData: processData,
        contentType: contentType,
        async: false,
        complete: function(response) {
            responseData = JSON.parse(response.responseText);
        }
    });

    return responseData;
}