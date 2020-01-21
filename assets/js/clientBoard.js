require('../scss/clientBoard.scss');

const cvAdvisor = document.querySelectorAll('div.cvAdvisor');
const advisorInfo = document.querySelectorAll('div.advisorInfo');
const behind = document.getElementById('behind');


for (let i = 0; i < advisorInfo.length; i += 1) {
    advisorInfo[i].addEventListener('click', () => {
        cvAdvisor[i].classList.add('display');
        behind.classList.add('display');
        // To click to remove the a.classList.add('displayclientAdvisor');dvisors' CV
        behind.addEventListener('click', () => {
            cvAdvisor[i].classList.remove('display');
            behind.classList.remove('display');
        });
    });
}
