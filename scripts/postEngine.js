/*
Engine:
-update title on first card async
-do word count for each post + handle if it's okay to move on (min + max)
-check if card limit is hit
-remove post from stack
-somehow update date on new card
-ADD WORD COUNT to ya selected card (also in eventHandle)
*/
(function() {
  window.addEventListener("load", attach);
  var CARD_MAX = 25; //maximum # of cards per story
  var MIN_TITLE_LENGTH = 3; //min characters in title

  function attach() {
    document.getElementById("sTitle").oninput = updateTitle;
    document.getElementById("deleteButton").onclick = removePost;
    document.getElementById("mainSpace").onclick = eventHandle;
  }

  //updates title as stuff is typed, do length check here???
  function updateTitle() {
    var title = document.getElementById("theTitle");
    title.innerHTML = this.value;
    if (this.value.length < MIN_TITLE_LENGTH) {
      pointerEvents("none");
      document.getElementById("post").disabled = true;
      document.getElementById("sTitleLabel").hidden = false;
    } else {
      pointerEvents("auto");
      document.getElementById("post").disabled = false;
      document.getElementById("sTitleLabel").hidden = true;
    }
    this.style.pointerEvents = "auto";
    return;
  }

  //uses DOM to clear card
  function removePost() {
      getElementInFocus().innerHTML = document.getElementById("cardFiller").innerHTML;
      return;
  }

  //runs stuff that must be run when click happens in mainSpace
  //eventually move functionality over to graphicsEngine to call this....
  function eventHandle(){
    overflowCheck();
    dateUpdate();
    //attach word count function here
  }

  //check to see if there's been more than 25 cards!!! (prelim value)
  //also handles
  function overflowCheck() {
    var items = document.getElementsByClassName("newPostCard");
    if (items.length > CARD_MAX) {
      items[items.length - 1].style.pointerEvents = "none"; //disable pointer events for the next card!
    }
    return;
  }

  //updates date on current card
  function dateUpdate() {
    //big SO to stackOverflow
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    today = mm + '.' + dd + '.' + yyyy;
    getElementInFocus().getElementsByClassName("logotype")[0].innerHTML = today;
    getElementInFocus().getElementsByClassName("postDate")[0].value = today;
    return;
  }

  //enable or disable pointer events, they're beind disabled for ALL THO
  function pointerEvents(stat) {
    var items = document.getElementsByClassName("newPostCard");
    for (var i = 0; i < items.length; i++) {
      items[i].style.pointerEvents = stat;
    }
  }

  //returns eement currently in focus
  function getElementInFocus(){
    var items = document.getElementsByClassName("newPostCard");
    for (var i = 0; i < items.length; i++) {
      if(!items[i].classList.contains("newPostCardDisabled")){
        if (items[i].contains(document.getElementById("theTitle"))) {
          return;
        }
        return items[i];
      }
    }
  }

})();
