document.addEventListener("click", function(event){
  var tag = event.target.tagName;

  if (tag === "BUTTON") {
    let picture = canvasElement.toDataURL();

    fetch("/newvisitor", {
      method: "post",
      body: JSON.stringify({ data: picture })
    })
  }
});
