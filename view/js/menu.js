const btnToggle = document.querySelector('.main-menu');

btnToggle.addEventListener('mouseenter', function () {
  console.log('mouse enter')
  document.getElementsByClassName('contenedor').classList('active');
  //document.getElementsByClassName('contenedor').classList.toggle('active');
  //console.log(document.getElementsByClassName('contenedor'))
});
