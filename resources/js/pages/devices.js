window.axios = require('axios');

const devicesList = document.querySelector('.main-content');

const deleteDeviceHandler = async event => {
    const deviceBox = event.target.closest('.device-box');
    if (deviceBox) {
        event.preventDefault();

        const url = deviceBox.action;
        const STATUS_SUCCESS = 200;

        try {
            const response = await axios({
                url,
                'method': 'delete'
            });

            if (response.status == STATUS_SUCCESS) {
                deviceBox.parentElement.removeChild(deviceBox);
            }
        } catch {
            console.log('We failed');
        }
    }
}

devicesList.addEventListener('submit', deleteDeviceHandler);
