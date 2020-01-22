require('../scss/app.scss');

const cvAdvisor = document.querySelectorAll('div.cvAdvisor');
const cardAdvisorJS = document.querySelectorAll('div.cardAdvisors');
const iconCv = document.querySelectorAll('img.iconCv');
const myInput = document.getElementById('myInput');
const filterContainer = document.getElementById('filterContainer');

for (let i = 0; i < cardAdvisorJS.length; i += 1) {
    //cardAdvisorJS[i].addEventListener('click', () => {
      //  cvAdvisor[i].classList.add('display');
       // filterContainer.classList.remove('hidden');
        // To click to remove the advisors' CV
      //  filterContainer.addEventListener('click', () => {
        //    cvAdvisor[i].classList.remove('display');
          //  filterContainer.classList.add('hidden');
        //});
  //  });

    iconCv[i].addEventListener('click', () => {
        cvAdvisor[i].classList.add('display');
        filterContainer.classList.remove('hidden');
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
        const cardTitle = cardAdvisors[i].getElementsByClassName('cardTitle')[0];
        const txtValue = cardTitle.textContent || cardTitle.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            cardAdvisors[i].style.display = '';
        } else {
            cardAdvisors[i].style.display = 'none';
        }
    }


});
