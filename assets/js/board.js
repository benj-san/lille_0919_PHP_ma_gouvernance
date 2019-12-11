require('../scss/board.scss');

const cardAdvisorJS = document.querySelectorAll('div.cardAdvisorJS');
const boardEdit = document.getElementById('boardEdit');
const boardEditImg = document.getElementById('boardEditImg');
const boardEditH2 = document.getElementById('boardEditH2');
const behind = document.getElementById('behind');
const commentAdvisor = document.getElementById('commentAdvisor');
const buttonValidateSynopsis = document.getElementById('buttonValidateSynopsis');
const deleteAdvisor = document.querySelectorAll('div.deleteAdvisor');
const definitiveDeleteAdvisor = document.querySelectorAll('button.definitiveDeleteAdvisor');
const boardAdvisors = document.getElementById('boardAdvisors');

for (let i = 0; i < cardAdvisorJS.length; i++) {
    cardAdvisorJS[i].addEventListener('click', () => {
        behind.classList.add('display');
        commentAdvisor.classList.add('display');

        buttonValidateSynopsis.addEventListener('click', () => {
            boardEdit.appendChild(cardAdvisorJS[i]);
            boardEditImg.classList.add('none');
            boardEditH2.classList.add('none');
            behind.classList.remove('display');
            commentAdvisor.classList.remove('display');

            if (cardAdvisorJS[i].parentNode.id === 'boardEdit') {
                cardAdvisorJS[i].addEventListener('click', () => {
                    behind.classList.add('display');
                    commentAdvisor.classList.remove('display');
                    deleteAdvisor[i].classList.add('display');
                    definitiveDeleteAdvisor[i].addEventListener('click', () => {
                        boardAdvisors.appendChild(cardAdvisorJS[i]);
                        behind.classList.remove('display');
                        deleteAdvisor[i].classList.remove('display');
                    });
                });
            }
        });
    });
    cardAdvisorJS[i].removeEventListener('click', () => {
    });
}
