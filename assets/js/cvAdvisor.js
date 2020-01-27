require('../scss/cvAdvisor.scss');

const edit = document.querySelectorAll('img.edit');
const commentaryP = document.querySelectorAll('p.commentaryP');
const commentaryForm = document.querySelectorAll('form.formCommentary');

for (let i = 0; i < edit.length; i += 1) {
    edit[i].addEventListener('click', () => {
        commentaryP[i].classList.add('hidden');
        commentaryForm[i].classList.remove('hidden');
        edit[i].classList.add('hidden');
    });
}
