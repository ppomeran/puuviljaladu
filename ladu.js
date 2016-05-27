arvutaKogus();

function arvutaKogus() {
  var inputKogus = document.getElementsByClassName('tootekogus');
  var parentDiv = document.getElementById('div-tootetabel');
  var childDiv = document.createElement('div');
  var algKogus = 0;
  
  for (var i = 0; i < inputKogus.length; i++) {
    algKogus = algKogus + parseInt(inputKogus[i].value);
  }

  childDiv.setAttribute('style', 'margin-top: 30px');
  childDiv.textContent = 'Tooteid kokku: ' + algKogus;
  parentDiv.appendChild(childDiv);
}
