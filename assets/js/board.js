require('../scss/board.scss');

const cvAdvisor = document.querySelectorAll('div.cvAdvisor');
const cardAdvisorJS = document.querySelectorAll('div.cardAdvisorJS');
const addCardAdvisor = document.querySelectorAll('div.addCardAdvisor');
const boardEdit = document.getElementById('boardEdit');
const boardEditImg = document.getElementById('boardEditImg');
const boardEditH2 = document.getElementById('boardEditH2');
const behind = document.getElementById('behind');
const commentAdvisor = document.getElementById('commentAdvisor');
const buttonValidateSynopsis = document.getElementById('buttonValidateSynopsis');
const deleteAdvisor = document.querySelectorAll('div.deleteAdvisor');
const definitiveDeleteAdvisor = document.querySelectorAll('button.definitiveDeleteAdvisor');
const boardAdvisors = document.getElementById('boardAdvisors');
const cardAdvisorAndAdd = document.querySelectorAll('div.cardAdvisorAndAdd');
const idAdvisor = document.querySelectorAll('p.idAdvisor');
const checkboxAdvisor = document.querySelectorAll('input');

for (let i = 0; i < cardAdvisorJS.length; i++) {
    for (let j = 0; j < checkboxAdvisor.length; j++) {
        if (checkboxAdvisor[j].type === 'checkbox' && idAdvisor[i].innerHTML === checkboxAdvisor[j].value) {
            if (checkboxAdvisor[j].checked) {
                boardEdit.appendChild(cardAdvisorAndAdd[i]);
                boardEdit.classList.add('displayAdvisor');
                cardAdvisorJS[i].classList.add('display');
                boardEditImg.classList.add('none');
                boardEditH2.classList.add('none');
                cardAdvisorJS[i].addEventListener('click', () => {
                    deleteAdvisor[i].classList.add('display');
                });
                behind.addEventListener('click', () => {
                    deleteAdvisor[i].classList.remove('display');
                });
                definitiveDeleteAdvisor[i].addEventListener('click', () => {
                    for (let j = 0; j < checkboxAdvisor.length; j++) {
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
        }
    }
    // To click to display the window to add an advisor
    addCardAdvisor[i].addEventListener('click', () => {
        behind.classList.add('display');
        commentAdvisor.classList.add('display');
        // To click to hide the different popups
        behind.addEventListener('click', () => {
            commentAdvisor.classList.remove('display');
            behind.classList.remove('display');
            deleteAdvisor[i].classList.remove('display');
        });
        // To click to add an advisor
        let button = document.createElement('button');
        button.id = 'buttonValidateSynopsis';
        button.innerHTML = 'Valider';
        commentAdvisor.appendChild(button);
        button.addEventListener('click', () => {
            commentAdvisor.removeChild(button);
            for (let j = 0; j < checkboxAdvisor.length; j++) {
                if (checkboxAdvisor[j].type === 'checkbox') {
                    if (idAdvisor[i].innerHTML === checkboxAdvisor[j].value) {
                        checkboxAdvisor[j].checked = true;
                        boardEdit.appendChild(cardAdvisorAndAdd[i]);
                        boardEditImg.classList.add('none');
                        boardEditH2.classList.add('none');
                        behind.classList.remove('display');
                        commentAdvisor.classList.remove('display');
                    }
                }
            }
            // Modify the css if an advisor goes into the board
            if (cardAdvisorAndAdd[i].parentNode.id === 'boardEdit') {
                boardEdit.classList.add('displayAdvisor');
                // To click to display the window to remove an advisor
                cardAdvisorJS[i].addEventListener('click', () => {
                    behind.classList.add('display');
                    cvAdvisor[i].classList.remove('display');
                    commentAdvisor.classList.remove('display');
                    deleteAdvisor[i].classList.add('display');
                });
            }
        });
        // To click to remove an advisor
        definitiveDeleteAdvisor[i].addEventListener('click', () => {
            for (let j = 0; j < checkboxAdvisor.length; j++) {
                if (checkboxAdvisor[j].type === 'checkbox') {
                    if (idAdvisor[i].innerHTML === checkboxAdvisor[j].value) {
                        checkboxAdvisor[j].checked = false;
                        boardAdvisors.appendChild(cardAdvisorAndAdd[i]);
                        behind.classList.remove('display');
                        deleteAdvisor[i].classList.remove('display');
                    }
                }
            }
            buttonValidateSynopsis.removeEventListener('click', () => {
                for (let j = 0; j < checkboxAdvisor.length; j++) {
                    if (checkboxAdvisor[j].type === 'checkbox') {
                        if (idAdvisor[i].innerHTML === checkboxAdvisor[j].value) {
                            checkboxAdvisor[j].checked = true;
                            boardEdit.appendChild(cardAdvisorAndAdd[i]);
                            boardEditImg.classList.add('none');
                            boardEditH2.classList.add('none');
                            behind.classList.remove('display');
                            commentAdvisor.classList.remove('display');
                        }
                    }
                }
                // Modify the css if an advisor goes into the board
                if (cardAdvisorAndAdd[i].parentNode.id === 'boardEdit') {
                    boardEdit.classList.add('displayAdvisor');
                    // To click to display the window to remove an advisor
                    cardAdvisorJS[i].addEventListener('click', () => {
                        behind.classList.add('display');
                        cvAdvisor[i].classList.remove('display');
                        commentAdvisor.classList.remove('display');
                        deleteAdvisor[i].classList.add('display');
                    });
                }
            });
        });
    });
    // To click to display the advisors' CV
    cardAdvisorJS[i].addEventListener('click', () => {
        if (cardAdvisorAndAdd[i].parentNode.id === 'boardAdvisors') {
            cvAdvisor[i].classList.add('display');
            deleteAdvisor[i].remove('display');
            behind.classList.add('display');
            // To click to remove the advisors' CV
            behind.addEventListener('click', () => {
                cvAdvisor[i].classList.remove('display');
                behind.classList.remove('display');
            });
        }
    });
}
