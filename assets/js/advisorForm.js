require('../scss/advisorForm.scss');

const secondButtonFirstQuestion = document.getElementById('secondButtonFirstQuestion');
const questions = document.querySelectorAll('div.question');
const buttonNext = document.querySelectorAll('button.nextOne');
const experienceYes = document.getElementById('experienceYes');
const experienceNo = document.getElementById('experienceNo');
const mandateYes = document.getElementById('mandateYes');
const mandateNo = document.getElementById('mandateNo');
const rgpdYes = document.getElementById('rgpdYes');
const rgpdNo = document.getElementById('rgpdNo');
const checkboxExperienceYes = document.getElementById('advisor_gouvernanceExperience_0');
const checkboxExperienceNo = document.getElementById('advisor_gouvernanceExperience_1');
const checkboxMandateYes = document.getElementById('advisor_mandateExperience_0');
const checkboxMandateNo = document.getElementById('advisor_mandateExperience_1');
const checkboxRgpdYes = document.getElementById('advisor_mandateExperience_0');
const checkboxRgpdNo = document.getElementById('advisor_mandateExperience_1');


// eslint-disable-next-line no-undef

for (let i = 0; i < buttonNext.length; i += 1) {
    buttonNext[i].addEventListener('click', () => {
        questions[i].classList.add('hideIt1');
        questions[i + 1].classList.remove('hideIt2');
        setTimeout(() => {
            questions[i].classList.add('hideIt2');
            questions[i + 1].classList.remove('hideIt1');
        }, 500);
    });
}


secondButtonFirstQuestion.addEventListener('click', () => {
    window.location.href = 'http://www.magouvernance.com';
});


experienceYes.addEventListener('click', () => {
    checkboxExperienceYes.checked = true;
    checkboxExperienceNo.checked = false;
});


mandateYes.addEventListener('click', () => {
    checkboxMandateYes.checked = true;
    checkboxMandateNo.checked = false;
});

rgpdYes.addEventListener('click', () => {
    checkboxExperienceYes.checked = true;
    checkboxExperienceNo.checked = false;
});

experienceNo.addEventListener('click', () => {
    checkboxExperienceYes.checked = false;
    checkboxExperienceNo.checked = true;
    questions[7].classList.add('hideIt1');
    questions[15].classList.remove('hideIt2');
    setTimeout(() => {
        questions[7].classList.add('hideIt2');
        questions[15].classList.remove('hideIt1');
    }, 500);
});

mandateNo.addEventListener('click', () => {
    checkboxMandateYes.checked = false;
    checkboxMandateNo.checked = true;
    questions[9].classList.add('hideIt1');
    questions[10].classList.remove('hideIt2');
    setTimeout(() => {
        questions[9].classList.add('hideIt2');
        questions[10].classList.remove('hideIt1');
    }, 500);
});


