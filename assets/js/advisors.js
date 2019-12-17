require('../scss/app.scss');

const myInput = document.getElementById('myInput');
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
