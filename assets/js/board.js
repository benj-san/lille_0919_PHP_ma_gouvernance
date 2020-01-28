require('../scss/board.scss');

const cvAdvisor = document.querySelectorAll('div.cvAdvisor');
const cardAdvisorJS = document.querySelectorAll('div.cardAdvisorJS');
const boardEdit = document.getElementById('boardEdit');
const behind = document.getElementById('behind');
const commentAdvisor = document.querySelectorAll('div.commentAdvisor');
const deleteAdvisor = document.querySelectorAll('div.deleteAdvisor');
const idAdvisor = document.querySelectorAll('p.idAdvisor');
const checkboxAdvisor = document.querySelectorAll('input');
const takeAdvisors = document.getElementById('takeAdvisors');
const allAdvisorsBoard = document.getElementById('allAdvisorsBoard');
const iconAdd = document.querySelectorAll('img.iconAdd');
const iconCv = document.querySelectorAll('img.iconCv');
const iconDelete = document.querySelectorAll('img.iconDelete');
const clientLink = document.getElementById('clientLink');
const copy = document.getElementById('copy');
const behindAllAdvisors = document.getElementById('behindAllAdvisors');
const myInput = document.getElementById('myInput');
const boardAdvisors = document.getElementById('boardAdvisors');
const addAdvisors = document.getElementById('addAdvisors');
const viewBoardAndIcon = document.getElementById('viewBoardAndIcon');

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
    behindAllAdvisors.addEventListener('click', () => {
        allAdvisorsBoard.classList.remove('display');
        behindAllAdvisors.classList.remove('display');
    });
    takeAdvisors.addEventListener('click', () => {
        allAdvisorsBoard.classList.add('display');
        behindAllAdvisors.classList.add('display');
    });
    // Remove the advisor from the board and add into the list
}

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
        alert('Impossible de copier le lien');
    }
    window.getSelection().removeAllRanges();
});

addAdvisors.addEventListener('click', () => {
    boardAdvisors.classList.add('display');
    boardEdit.classList.add('hidden');
    viewBoardAndIcon.classList.add('hidden');
});

myInput.addEventListener('keyup', () => {
    const filter = myInput.value.toUpperCase();
    const advisorRest = document.getElementsByClassName('advisorRest');
    for (let i = 0; i < advisorRest.length; i += 1) {
        const cardTitle = advisorRest[i].getElementsByClassName('nameAdvisor')[0];
        const txtValue = cardTitle.textContent || cardTitle.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            advisorRest[i].style.display = '';
        } else {
            advisorRest[i].style.display = 'none';
        }
    }
});
