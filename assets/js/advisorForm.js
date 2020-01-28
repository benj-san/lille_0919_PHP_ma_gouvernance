require('../scss/advisorForm.scss');

const secondButtonFirstQuestion = document.getElementById('secondButtonFirstQuestion');

const questions = document.querySelectorAll('div.question');
const buttonNext = document.querySelectorAll('div.nextOne');
const experienceYes = document.getElementById('experienceYes');
const experienceNo = document.getElementById('experienceNo');
const mandateYes = document.getElementById('mandateYes');
const mandateNo = document.getElementById('mandateNo');
const rgpdYes = document.getElementById('rgpdYes');
const rgpdNo = document.getElementById('rgpdNo');
const checkboxExperience = document.getElementById('advisor_gouvernanceExperience');
const checkboxMandate = document.getElementById('advisor_mandateState');
const checkboxRgpd = document.getElementById('advisor_rgpd');
const buttonsBack = document.querySelectorAll('div.lastQuestion');


// eslint-disable-next-line no-undef

for (let i = 0; i < buttonNext.length; i += 1) {
    buttonNext[i].addEventListener('click', () => {
        if (document.querySelectorAll('div.error').length === 1) {
            document.querySelectorAll('div.error')[0].parentNode.removeChild(document.querySelectorAll('div.error')[0]);
        }
        if (questions[i].children[1].tagName === 'INPUT' || questions[i].children[1].tagName === 'TEXTAREA') {
            if (questions[i].children[1].value === '') {
                if (document.querySelectorAll('div.error').length === 0) {
                    const errorMessage = document.createElement('div');
                    errorMessage.classList.add('error');
                    errorMessage.innerHTML = 'une réponse est requise pour les champs marqués par *';
                    questions[i].appendChild(errorMessage);
                }
            } else {
                if (document.querySelectorAll('div.error').length === 1) {
                    document.querySelectorAll('div.error')[0].parentNode.removeChild(document.querySelectorAll('div.error')[0]);
                }
                questions[i].classList.add('hideIt1');
                setTimeout(() => {
                    questions[i + 1].classList.remove('hideIt2');
                    questions[i].classList.add('hideIt2');
                    setTimeout(() => {
                        questions[i + 1].classList.remove('hideIt1');
                    }, 200);
                }, 200);
            }
        } else {
            questions[i].classList.add('hideIt1');
            setTimeout(() => {
                questions[i + 1].classList.remove('hideIt2');
                questions[i].classList.add('hideIt2');
                setTimeout(() => {
                    questions[i + 1].classList.remove('hideIt1');
                }, 200);
            }, 200);
        }
    });
}

for (let i = 0; i < buttonsBack.length; i += 1) {
    buttonsBack[i].addEventListener('click', () => {
        questions[i + 1].classList.add('hideIt1');
        questions[i].classList.remove('hideIt2');
        questions[i + 1].classList.add('hideIt2');
        questions[i].classList.remove('hideIt1');
    });
}

secondButtonFirstQuestion.addEventListener('click', () => {
    if (document.querySelectorAll('div.error').length === 0) {
        const errorMessage = document.createElement('div');
        errorMessage.classList.add('error');
        errorMessage.innerHTML = 'Vous devez répondre oui afin de continuer';
        questions[1].appendChild(errorMessage);
    }
});


experienceYes.addEventListener('click', () => {
    checkboxExperience.checked = true;
});


mandateYes.addEventListener('click', () => {
    checkboxMandate.checked = true;
});

rgpdYes.addEventListener('click', () => {
    checkboxRgpd.checked = true;
});

experienceNo.addEventListener('click', () => {
    checkboxExperience.checked = false;
    questions[8].classList.add('hideIt1');
    setTimeout(() => {
        questions[15].classList.remove('hideIt2');
        questions[8].classList.add('hideIt2');
        setTimeout(() => {
            questions[15].classList.remove('hideIt1');
        }, 200);
    }, 200);
});

mandateNo.addEventListener('click', () => {
    checkboxMandate.checked = false;
    questions[11].classList.add('hideIt1');
    setTimeout(() => {
        questions[12].classList.remove('hideIt2');
        questions[11].classList.add('hideIt2');
        setTimeout(() => {
            questions[12].classList.remove('hideIt1');
        }, 200);
    }, 200);
});


rgpdNo.addEventListener('click', () => {
    if (document.querySelectorAll('div.error').length === 0) {
        const errorMessage = document.createElement('div');
        errorMessage.classList.add('error');
        errorMessage.innerHTML = 'Vous devez répondre oui afin de continuer';
        questions[28].appendChild(errorMessage);
    }
});
