var denyBtn = document.querySelector(".deny-friend");
var idSender = denyBtn.value;

denyBtn.addEventListener("click", function(){
    var reason = prompt("Geef een reden waarom je geen buddies wilt zijn met deze persoon.");
  if (reason == null || reason == "") {
    reason = "No reason given";
  } else {
    document.cookie = "reason"+idSender+"="+reason;
  }
});



