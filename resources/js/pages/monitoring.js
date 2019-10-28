window.axios = require('axios');

const connectionParamsForm = document.forms.connectionParamsForm;
const formData = new FormData(connectionParamsForm);

const url = '/params';

const getRequestData = () => {
    const requestData = {};

    ['ip', 'port', 'connection_type', '_token'].forEach(attribute => {
        requestData[attribute] = formData.get(attribute);
    });

    return requestData;
};

const getParmas = async () => {
    try {
        const response = await axios({
            url,
            'method': 'POST',
            'data': getRequestData()
        });
    } catch (error) {
        console.log(error.message);
    }
};

getParmas();
