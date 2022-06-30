'use strict'

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('form'),
          formWrapper = document.querySelector('.form-wrapper');
    form.addEventListener('submit', formSend);
    let formReq = document.querySelectorAll('.form-req');



    async function formSend(e) {
        e.preventDefault();

        let error = formValidate(form);

        let formData = new FormData(form);

        if(error === 0) {
            formWrapper.classList.add('sending');
            let response = await fetch('sendmail.php', {
                method: 'POST',
                headers: {
                    'Content-type': 'application/json'
                },
                body: formData
            });
            if(response.ok) {
                let result = await response.json();
                alert(result.message);
                form.reset();
                formWrapper.classList.remove('sending');
            } else {
                alert('Ошибка');
                formWrapper.classList.remove('sending');
            }
        } else {
            alert('Заполните обязательные поля');
        }
    }

    function formValidate(form) {
        let error = 0;
        let formReq = document.querySelectorAll('.form-req');

        for (let i = 0; i < formReq.length; i++) {
            const input = formReq[i]
            formRemoveError(input);

            if(input.classList.contains('form-req')) {
                if(input.value == '') {
                    formAddError(input);
                    error++;
                }
            }
        }
        return error;
    }


    function formAddError(input) {
        // input.parentElement.classList.add('error');
        input.classList.add('error')
    }
    function formRemoveError(input) {
        // input.parentElement.classList.remove('error');
        input.classList.remove('error')
    }
})