/*
use a hidden div with id="cardFiller" with everything that you want in every card following the individual one
*/

window.addEventListener("load", startEngine);

var EXPECTED_POS = 400; //expected position of card
var MARGIN = 0; //margin between cards
function startEngine() {
  console.log("ready");
  addDisabledCard();

  var cards = document.getElementsByClassName("newPostCard");
  for (var i = 0; i < cards.length; i++) {
    cards[i].onclick = changeView;
  }
}

function changeView() {
  var pos = parseInt(window.getComputedStyle(this).left);

  if (pos == EXPECTED_POS) {
    return;
  }

  var elements = document.getElementsByClassName("newPostCard");
  for (var i = 0; i < elements.length; i++) {

    var thisPosition = parseInt(window.getComputedStyle(elements[i]).left);
    var mPos = EXPECTED_POS + MARGIN;
    if (pos < EXPECTED_POS) {
      elements[i].style.left = thisPosition + mPos + "px";
    } else if (pos > EXPECTED_POS) {
      elements[i].style.left = (thisPosition - mPos) + "px";
    }

    if (parseInt(window.getComputedStyle(elements[i]).left) == 400) {
      elements[i].classList.remove("newPostCardDisabled");
    } else {
      elements[i].classList.add("newPostCardDisabled");
    }
  }

  //add element onto end!!!
  if (this.nextSibling === null) {
    addDisabledCard();
  }

  cardClickedHandler();
}

function addDisabledCard() {
  var newLeft = (EXPECTED_POS * 2) + MARGIN;
  var node = document.createElement("div");

  node.classList.add("newPostCard");
  node.classList.add("newPostCardDisabled");
  node.style.left = newLeft + "px";

  node.innerHTML = document.getElementById("cardFiller").innerHTML;

  var container = document.getElementById("mainSpace");
  container.appendChild(node);
  node.onclick = changeView;
}
