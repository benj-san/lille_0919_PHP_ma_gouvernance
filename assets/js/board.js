require('../scss/board.scss');

const cvAdvisor = document.querySelectorAll('div.cvAdvisor');
const cardAdvisorJS = document.querySelectorAll('div.cardAdvisorJS');
const addCardAdvisor = document.querySelectorAll('div.addCardAdvisor');
const boardEdit = document.getElementById('boardEdit');
const boardEditImg = document.getElementById('boardEditImg');
const boardEditH2 = document.getElementById('boardEditH2');
const behind = document.getElementById('behind');
const commentAdvisor = document.querySelectorAll('div.commentAdvisor');
const deleteAdvisor = document.querySelectorAll('div.deleteAdvisor');
const definitiveDeleteAdvisor = document.querySelectorAll('button.definitiveDeleteAdvisor');
const boardAdvisors = document.getElementById('boardAdvisors');
const cardAdvisorAndAdd = document.querySelectorAll('div.cardAdvisorAndAdd');
const idAdvisor = document.querySelectorAll('p.idAdvisor');
const checkboxAdvisor = document.querySelectorAll('input');
const removeCardAdvisor = document.querySelectorAll('div.removeCardAdvisor');

for (let i = 0; i < cardAdvisorJS.length; i += 1) {
    // Advisors in DB
    for (let j = 0; j < checkboxAdvisor.length; j += 1) {
        if (checkboxAdvisor[j].type === 'checkbox' && idAdvisor[i].innerHTML === checkboxAdvisor[j].value) {
            if (checkboxAdvisor[j].checked) {
                boardEdit.appendChild(cardAdvisorAndAdd[i]);
                boardEdit.classList.add('displayAdvisor');
                cardAdvisorJS[i].classList.add('display');
                boardEditImg.classList.add('none');
                boardEditH2.classList.add('none');
            }
        }
    }
    // Advisors not in DB
    // To click to display the window to add an advisor
    addCardAdvisor[i].addEventListener('click', () => {
        behind.classList.add('display');
        commentAdvisor[i].classList.add('display');
    });
    // Modify the css if an advisor goes into the board
    if (cardAdvisorAndAdd[i].parentNode.id === 'boardEdit') {
        boardEdit.classList.add('displayAdvisor');
    }
    removeCardAdvisor[i].addEventListener('click', () => {
        behind.classList.add('display');
        deleteAdvisor[i].classList.add('display');
    });
    behind.addEventListener('click', () => {
        behind.classList.remove('display');
        commentAdvisor[i].classList.remove('display');
        deleteAdvisor[i].classList.remove('display');
    });
    // To click to display the advisors' CV
    cardAdvisorJS[i].addEventListener('click', () => {
        cvAdvisor[i].classList.add('display');
        behind.classList.add('display');
        // To click to remove the advisors' CV
        behind.addEventListener('click', () => {
            cvAdvisor[i].classList.remove('display');
            behind.classList.remove('display');
        });
    });
    definitiveDeleteAdvisor[i].addEventListener('click', () => {
        for (let j = 0; j < checkboxAdvisor.length; j += 1) {
            if (checkboxAdvisor[j].type === 'checkbox') {
                if (idAdvisor[i].innerHTML === checkboxAdvisor[j].value) {
                    checkboxAdvisor[j].checked = false;
                    boardAdvisors.appendChild(cardAdvisorAndAdd[i]);
                    behind.classList.remove('display');
                    deleteAdvisor[i].classList.remove('display');
                }
            }
        }
    });
}
