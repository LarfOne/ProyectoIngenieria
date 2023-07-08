const mouses = document.querySelector('.main-menu');
mouses.addEventListener('mouseover', function(){   
    var intro = document.getElementById('container pt-4');
    intro.style.marginLeft = '250px';
})
mouses.addEventListener('mouseout', function(){   
    var intro = document.getElementById('container pt-4');
    intro.style.marginLeft = '25px';
})
