window.axios = require('axios');

const formDataToObject = (formData) => {
    const requestData = {};

    for (const [key, value] of formData.entries()) {
        requestData[key] = value;
    }

    return requestData;
};

class Btn {
    constructor(queryStr) {
        this.domElement = document.querySelector(queryStr);
    }

    toggleAppearance(monitoringActive) {
        this.domElement.classList.toggle('is-success');
        this.domElement.classList.toggle('is-warning');

        this.domElement.textContent = monitoringActive ? 'Остановить мониторинг' : 'Начать мониторинг';
    }
}

class DeviceParams {
    constructor() {
        this.url = '/params';
        this.data = {};

        const form = document.forms.connectionParamsForm;
        this.formDataObject = formDataToObject(new FormData(form));
    }

    async refreshData() {
        const { data } = await axios.post(this.url, this.formDataObject);
        this.data = data;
    }

    render() {
        for (let [key, value] of Object.entries(this.data)) {
            document.querySelector(`.value-${key}`).textContent = value;
        }
    }
}

class ErrMessage {
    constructor() {
        this.container = document.querySelector('.main-content');
        this.referenceElement = document.querySelector('.monitoring-box');
    }

    template(message) {
        return `
            <div class="message-header">
                <p>Ошибка</p>
                <button class="delete" aria-label="delete"></button>
            </div>
            <div class="message-body">
                ${message}
            </div>`.trim();
    }

    render(message) {
        const errorHtml = this.template(message);

        const mainElement = document.createElement('article');
        mainElement.className = 'message is-warning';
        mainElement.innerHTML = errorHtml;

        this.container.insertBefore(mainElement, this.referenceElement);

        this.container.addEventListener('click', (ev) => {
            if (ev.target.closest('.delete')) {
                this.container.removeChild(mainElement);
            }
        })
    }
}

class MonitoringApp {
    constructor() {
        this.btn = new Btn('.monitoringBtn');
        this.params = new DeviceParams();
        this.errMessage = new ErrMessage();
        this.monitoringActive = false;
        this.timer = null;
    }

    init() {
        this.btn.domElement.addEventListener('click', this.toggleMonitroing.bind(this));
    }

    renderError(message) {
        this.errMessage.render(message);
    }

    startMonitoring() {
        this.timer = setTimeout(async () => {
            try {
                await this.params.refreshData();

                this.params.render();

                this.startMonitoring();
            } catch (error) {
                this.stopMonitroing();
                this.renderError(error.message);
            }
        }, 1000);
    }

    stopMonitroing() {
        this.monitoringActive = false;
        this.btn.toggleAppearance(this.monitoringActive);
        clearTimeout(this.timer);
    }

    toggleMonitroing(ev) {
        if (this.monitroingActive) {
            this.stopMonitroing();
        } else {
            this.startMonitoring();
            this.monitoringActive = true;
            this.btn.toggleAppearance(this.monitoringActive);
        }
    }
}

const app = new MonitoringApp();
app.init();