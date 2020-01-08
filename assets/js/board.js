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

for (let i = 0; i < cardAdvisorJS.length; i += 1) {
    for (let j = 0; j < checkboxAdvisor.length; j += 1) {
        if (checkboxAdvisor[j].type === 'checkbox' && idAdvisor[i].innerHTML === checkboxAdvisor[j].value) {
            if (checkboxAdvisor[j].checked) {
                boardEdit.appendChild(cardAdvisorAndAdd[i]);
                boardEdit.classList.add('displayAdvisor');
                cardAdvisorJS[i].classList.add('display');
                boardEditImg.classList.add('none');
                boardEditH2.classList.add('none');
                cardAdvisorJS[i].addEventListener('click', () => {
                    deleteAdvisor[i].classList.add('display');
                    behind.classList.add('display');
                    cardAdvisorJS[i].removeEventListener('click', () => {});
                });
                behind.addEventListener('click', () => {
                    deleteAdvisor[i].classList.remove('display');
                    behind.classList.remove('display');
                    behind.removeEventListener('click', () => {});
                });
                definitiveDeleteAdvisor[i].addEventListener('click', () => {
                    for (let k = 0; k < checkboxAdvisor.length; k += 1) {
                        if (checkboxAdvisor[k].type === 'checkbox') {
                            if (idAdvisor[i].innerHTML === checkboxAdvisor[k].value) {
                                checkboxAdvisor[k].checked = false;
                                boardAdvisors.appendChild(cardAdvisorAndAdd[i]);
                                behind.classList.remove('display');
                                deleteAdvisor[i].classList.remove('display');
                            }
                        }
                    }
                });
            }
        }
    }
    // To click to display the window to add an advisor
    addCardAdvisor[i].addEventListener('click', () => {
        behind.classList.add('display');
        commentAdvisor[i].classList.add('display');
        // To click to hide the different popups
        behind.addEventListener('click', () => {
            commentAdvisor[i].classList.remove('display');
            behind.classList.remove('display');
            deleteAdvisor[i].classList.remove('display');
        });
        // To click to add an advisor
        const button = document.createElement('button');
        button.id = 'buttonValidateSynopsis';
        button.innerHTML = 'Valider';
        commentAdvisor[i].appendChild(button);
        behind.addEventListener('click', () => {
            commentAdvisor[i].classList.remove('display');
            behind.classList.remove('display');
            deleteAdvisor[i].classList.remove('display');
            commentAdvisor[i].removeChild(button);
        });
        button.addEventListener('click', () => {
            commentAdvisor[i].removeChild(button);
            for (let j = 0; j < checkboxAdvisor.length; j += 1) {
                if (checkboxAdvisor[j].type === 'checkbox') {
                    if (idAdvisor[i].innerHTML === checkboxAdvisor[j].value) {
                        checkboxAdvisor[j].checked = true;
                        boardEdit.appendChild(cardAdvisorAndAdd[i]);
                        boardEditImg.classList.add('none');
                        boardEditH2.classList.add('none');
                        behind.classList.remove('display');
                        commentAdvisor[i].classList.remove('display');
                    }
                }
            }
            // Modify the css if an advisor goes into the board
            if (cardAdvisorAndAdd[i].parentNode.id === 'boardEdit') {
                boardEdit.classList.add('displayAdvisor');
                // To click to display the window to remove an advisor
                cardAdvisorJS[i].addEventListener('click', () => {
                    behind.classList.add('display');
                    commentAdvisor[i].classList.remove('display');
                    deleteAdvisor[i].classList.add('display');
                });
            }
        });
        // To click to remove an advisor
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
    });
    // To click to display the advisors' CV
    cardAdvisorJS[i].addEventListener('click', () => {
        if (cardAdvisorAndAdd[i].parentNode.id === 'boardAdvisors') {
            cvAdvisor[i].classList.add('display');
            behind.classList.add('display');
            // To click to remove the advisors' CV
            behind.addEventListener('click', () => {
                cvAdvisor[i].classList.remove('display');
                behind.classList.remove('display');
            });
        }
    });
}
