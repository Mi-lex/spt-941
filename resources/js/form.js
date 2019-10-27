const mainForm = document.forms.connection;

const deviceActions = document.querySelector('.deviceActions');

const formSubmitHandler = event => {
    event.preventDefault();
    if (event.target.closest('.button')) {
        mainForm.action = event.target.dataset.action;
        mainForm.submit();
    }
}

deviceActions.addEventListener('click', formSubmitHandler);


