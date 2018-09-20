
function closeMessage(e) {
  var parent = e.parentElement;
  var grandParent = parent.parentElement;
  grandParent.parentElement.style.visibility = "hidden";
  grandParent.parentElement.style.height = "0";
}
