const mouses = document.querySelector('.main-menu');
console.log(mouses);
mouses.addEventListener('mouseover', function(){   
    var intro = document.getElementById('container pt-4');
    intro.style.marginLeft = '250px';
})
mouses.addEventListener('mouseout', function(){   
    var intro = document.getElementById('container pt-4');
    intro.style.marginLeft = '61px';
})

/*
const mouses = document.querySelector('.main-menu');
console.log(mouses);
mouses.addEventListener('mouseenter', function(){   
    console.log(document.getElementByClass('container pt-4'));
    document.getElementByClassName('container pt-4').classList.toggle('hover');
})
*/
