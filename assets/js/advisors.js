require('../scss/app.scss');

const cvAdvisor = document.querySelectorAll('div.cvAdvisor');
const cardAdvisorJS = document.querySelectorAll('div.cardAdvisors');
const myInput = document.getElementById('myInput');
const filterContainer = document.getElementById('filterContainer');
const commentary = document.getElementById('commentary')
const edit = commentary.querySelectorAll('img');
const commentaryP = commentary.querySelectorAll('p');
const commentaryForm = commentary.querySelectorAll('form');


for (let i = 0; i < cardAdvisorJS.length; i += 1) {
    cardAdvisorJS[i].addEventListener('click', () => {
        cvAdvisor[i].classList.add('display');
        filterContainer.classList.remove('hidden');
        // To click to remove the advisors' CV
        filterContainer.addEventListener('click', () => {
            cvAdvisor[i].classList.remove('display');
            filterContainer.classList.add('hidden');
        });
    });
}

myInput.addEventListener('keyup', () => {
    const filter = myInput.value.toUpperCase();
    const cardAdvisors = document.getElementsByClassName('cardAdvisors');
    for (let i = 0; i < cardAdvisors.length; i += 1) {
        const h4 = cardAdvisors[i].getElementsByTagName('h4')[0];
        const txtValue = h4.textContent || h4.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            cardAdvisors[i].style.display = '';
        } else {
            cardAdvisors[i].style.display = 'none';
        }
    }
});

for (let i = 0; i < edit.length; i += 1) {
    edit[i].addEventListener('click', () => {
        commentaryP[i].classList.add('hidden');
        commentaryForm[i].classList.remove('hidden');
        edit[i].classList.add('hidden');
    });
}
