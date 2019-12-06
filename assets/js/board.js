require('../scss/board.scss');

const drag1 = document.getElementById('cardAdvisor');

let allowDrop = (ev) => {
    ev.preventDefault();
};

let drag = (ev) => {
    ev.dataTransfer.setData('text', ev.target.id);
};

let drop = (ev) => {
    ev.preventDefault();
    let data = ev.dataTransfer.getData('text');
    ev.target.appendChild(document.getElementById(data));
    drag1.classList.toggle('color');
};
