require('../scss/board.scss');

const cvAdvisor = document.querySelectorAll('div.cvAdvisor');
const cardAdvisor = document.querySelectorAll('div.cardAdvisors');
const behind = document.getElementById('behind');


for (let i = 0; i < cardAdvisor.length; i += 1) {
    cardAdvisor[i].addEventListener('click', () => {
        if (cardAdvisor[i].parentNode.id === 'boardContent') {
            cvAdvisor[i].classList.add('display');
            behind.classList.add('display');
            // To click to remove the a.classList.add('displayclientAdvisor');dvisors' CV
            behind.addEventListener('click', () => {
                cvAdvisor[i].classList.remove('display');
                behind.classList.remove('display');
            });
        }
    });
}
