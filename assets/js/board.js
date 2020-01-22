require('../scss/board.scss');

const cvAdvisor = document.querySelectorAll('div.cvAdvisor');
const cardAdvisorJS = document.querySelectorAll('div.cardAdvisorJS');
const boardEdit = document.getElementById('boardEdit');
const behind = document.getElementById('behind');
const commentAdvisor = document.querySelectorAll('div.commentAdvisor');
const deleteAdvisor = document.querySelectorAll('div.deleteAdvisor');
const definitiveDeleteAdvisor = document.querySelectorAll('button.definitiveDeleteAdvisor');
const boardAdvisors = document.getElementById('boardAdvisors');
const idAdvisor = document.querySelectorAll('p.idAdvisor');
const checkboxAdvisor = document.querySelectorAll('input');
const iconAdd = document.querySelectorAll('img.iconAdd');
const iconCv = document.querySelectorAll('img.iconCv');
const iconDelete = document.querySelectorAll('img.iconDelete');
const addAdvisors = document.getElementById('addAdvisors');
const viewBoardAndIcon = document.getElementById('viewBoardAndIcon');
const clientLink = document.getElementById('clientLink');
const copy = document.getElementById('copy');

for (let i = 0; i < cardAdvisorJS.length; i += 1) {
    // Advisors in DB
    for (let j = 0; j < checkboxAdvisor.length; j += 1) {
        if (checkboxAdvisor[j].type === 'checkbox' && idAdvisor[i].innerHTML === checkboxAdvisor[j].value) {
            if (checkboxAdvisor[j].checked) {
                boardEdit.appendChild(cardAdvisorJS[i]);
            }
        }
    }
    // Advisors not in DB
    // Displays the different windows according to the icons
    iconDelete[i].addEventListener('click', () => {
        behind.classList.add('display');
        deleteAdvisor[i].classList.add('display');
    });
    iconCv[i].addEventListener('click', () => {
        cvAdvisor[i].classList.add('display');
        behind.classList.add('display');
    });
    iconAdd[i].addEventListener('click', () => {
        behind.classList.add('display');
        commentAdvisor[i].classList.add('display');
    });
    // Remove all windows
    behind.addEventListener('click', () => {
        behind.classList.remove('display');
        commentAdvisor[i].classList.remove('display');
        deleteAdvisor[i].classList.remove('display');
        cvAdvisor[i].classList.remove('display');
    });
    // Remove the advisor from the board and add into the list
    definitiveDeleteAdvisor[i].addEventListener('click', () => {
        for (let j = 0; j < checkboxAdvisor.length; j += 1) {
            if (checkboxAdvisor[j].type === 'checkbox') {
                if (idAdvisor[i].innerHTML === checkboxAdvisor[j].value) {
                    checkboxAdvisor[j].checked = false;
                    boardAdvisors.appendChild(cardAdvisorJS[i]);
                    behind.classList.remove('display');
                    deleteAdvisor[i].classList.remove('display');
                }
            }
        }
    });
}
addAdvisors.addEventListener('click', () => {
    boardAdvisors.classList.add('display');
    boardEdit.classList.add('hidden');
    viewBoardAndIcon.classList.add('hidden');
});

copy.addEventListener('click', () => {
    const range = document.createRange();
    const linkAdress = document.getElementById('linkAdress');
    range.selectNode(clientLink);
    window.getSelection().addRange(range);
    try {
        if (document.execCommand('copy')) {
            linkAdress.classList.add('display');
            setTimeout(() => {
                linkAdress.classList.remove('display');
            }, 2000);
        }
    } catch (err) {
        // eslint-disable-next-line no-alert
        alert('Pas possible de copier');
    }
    window.getSelection().removeAllRanges();
});
