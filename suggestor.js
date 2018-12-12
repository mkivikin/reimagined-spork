var action = "default";
var value = "";

function fetchSuggestions(action, value) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          var suggestions = JSON.parse(this.responseText);
          //kutsuda vastav funktsioon siin välja
      };
    }
    xmlhttp.open("POST", "getSuggestion.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if(action === "default") {
      xmlhttp.send("action=" + action);
    }
  }

//teha funktsioon mis kuvab suggestionsist infot
