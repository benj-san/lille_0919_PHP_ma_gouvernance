require('../scss/advisorForm.scss');

const buttonPresentation = document.getElementById('buttonPresentation');
const introduction = document.getElementById('introduction');
const firstButtonFirstQuestion = document.getElementById('firstButtonFirstQuestion');
const secondButtonFirstQuestion = document.getElementById('secondButtonFirstQuestion');
const firstQuestionContainer = document.getElementById('firstQuestionContainer');


buttonPresentation.addEventListener('click', () => {
    introduction.classList.add('hidden');
    firstQuestionContainer.classList.remove('hidden');
});

firstButtonFirstQuestion.addEventListener('click', () => {
    firstQuestionContainer.classList.add('hidden');

});

secondButtonFirstQuestion.addEventListener('click', () => {
    window.location.href = 'http://www.magouvernance.com';
});
