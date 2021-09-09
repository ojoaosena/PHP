document.addEventListener("click", function(event){
  var classevisitante = event.target.className;
  var salvar = "/fonte/salvaimagem";
  console.log(classevisitante);

  if (classevisitante == "principalbotao") {
      document.getElementById("salvar").href = salvar;
  }
});
