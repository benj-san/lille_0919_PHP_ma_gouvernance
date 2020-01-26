require('../scss/advisorForm.scss');

const secondButtonFirstQuestion = document.getElementById('secondButtonFirstQuestion');
const questions = document.querySelectorAll('div.question');
const buttonNext = document.querySelectorAll('div.nextOne');
const experienceYes = document.getElementById('experienceYes');
const experienceNo = document.getElementById('experienceNo');
const mandateYes = document.getElementById('mandateYes');
const mandateNo = document.getElementById('mandateNo');
const rgpdYes = document.getElementById('rgpdYes');
const checkboxExperienceYes = document.getElementById('advisor_gouvernanceExperience');
const checkboxMandateYes = document.getElementById('advisor_mandateExperience');
const checkboxRgpdYes = document.getElementById('advisor_mandateExperience');
const buttonsBack = document.querySelectorAll('div.lastQuestion');


// eslint-disable-next-line no-undef

for (let i = 0; i < buttonNext.length; i += 1) {
    buttonNext[i].addEventListener('click', () => {
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
    window.location.href = 'http://www.magouvernance.com';
});


experienceYes.addEventListener('click', () => {
    checkboxExperienceYes.checked = true;
});


mandateYes.addEventListener('click', () => {
    checkboxMandateYes.checked = true;
});

rgpdYes.addEventListener('click', () => {
    checkboxRgpdYes.checked = true;
});

experienceNo.addEventListener('click', () => {
    checkboxExperienceYes.checked = false;
    questions[7].classList.add('hideIt1');
    setTimeout(() => {
        questions[15].classList.remove('hideIt2');
        questions[7].classList.add('hideIt2');
        setTimeout(() => {
            questions[15].classList.remove('hideIt1');
        }, 200);
    }, 200);
});

mandateNo.addEventListener('click', () => {
    checkboxMandateYes.checked = false;
    questions[9].classList.add('hideIt1');
    setTimeout(() => {
        questions[10].classList.remove('hideIt2');
        questions[9].classList.add('hideIt2');
        setTimeout(() => {
            questions[10].classList.remove('hideIt1');
        }, 200);
    }, 200);
});
