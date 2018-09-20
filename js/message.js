
function closeMessage(e) {
  var parent = e.parentElement;
  var grandParent = parent.parentElement;
  grandParent.parentElement.style.visibility = "hidden";
  grandParent.parentElement.style.height = "0";
  grandParent.parentElement.style.margin = "0";
  grandParent.parentElement.style.padding = "0";
}
