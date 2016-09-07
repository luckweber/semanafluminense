var fontMinLimit = 14;
var fontRegular = 16;
var fontMaxLimit = 32;
var currentFontSize;
function changeFontSize(sizeDifference){
  
  var el = document.querySelector('#content p');

  var style = window.getComputedStyle(el, null).getPropertyValue('font-size');
  
  var fontSize = parseFloat(style);

  currentFontSize = fontSize + sizeDifference;

  setFontSize(currentFontSize);
}

function setFontSize(fontSize){
  
  if(fontSize > fontMaxLimit || fontSize < fontMinLimit) {

    return false;
  }

  var el = document.querySelectorAll('#content p');
  var l = el.length;
  for (var i = 0; i < l; i++){
    el[i].style.fontSize = fontSize + 'px';
  }
  
}

document.querySelector('.js-increase-font').addEventListener('click', function (e) {

  changeFontSize(2);
  e.preventDefault();
});

document.querySelector('.js-decrease-font').addEventListener('click', function (e) {
  changeFontSize(-1);
  e.preventDefault();
});


document.querySelector('.js-regular-font').addEventListener('click', function (e) {
  setFontSize(16);
  e.preventDefault();
});
