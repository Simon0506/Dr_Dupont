const burger = document.getElementById('burger');
const nav = document.getElementById('menu');

burger.addEventListener ('click', () => {
  nav.classList.toggle('open');
});