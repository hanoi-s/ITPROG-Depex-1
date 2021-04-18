// Functions
function enableInput() {
  var cc = document.getElementById("cc");
  var ccnum = document.getElementById("ccnum");
  ccnum.disabled = cc.checked ? false : true;
  if (!ccnum.disabled) { ccnum.focus(); }

  // Variables
  var item1 = document.getElementById("item1");
  var item2 = document.getElementById("item2");
  var item3 = document.getElementById("item3");
  var item4 = document.getElementById("item4");
  var item5 = document.getElementById("item5");
  var item6 = document.getElementById("item6");

  var qty1 = document.getElementById("qty1");
  var qty2 = document.getElementById("qty2");
  var qty3 = document.getElementById("qty3");
  var qty4 = document.getElementById("qty4");
  var qty5 = document.getElementById("qty5");
  var qty6 = document.getElementById("qty6");


  if(!item1.checked){
    qty1.disabled = true;
  } else {
    qty1.disabled = false;
  }

  if(!item2.checked){
    qty2.disabled = true;
  } else {
    qty2.disabled = false;
  }

  if(!item3.checked){
    qty3.disabled = true;
  } else {
    qty3.disabled = false;
  }

  if(!item4.checked){
    qty4.disabled = true;
  } else {
    qty4.disabled = false;
  }

  if(!item5.checked){
    qty5.disabled = true;
  } else {
    qty5.disabled = false;
  }

  if(!item6.checked){
    qty6.disabled = true;
  } else {
    qty6.disabled = false;
  }

}

function validate() {
  var name = document.getElementById('name').value;
  var addr = document.getElementById('address').value;
  var email = document.getElementById('email').value;

  var itemCtr = 0;

  // Check Personal Information inputs
  if(name == "" || name == null){
    alert("Please enter your name");
    return false;
  }
  if(name.length < 2){
    alert("Name is too short");
    return false;
  }
  if(addr == "" || addr == null){
    alert("Please enter your home address");
    return false;
  }
  if(addr.length < 10){
    alert("Home address is too short");
    return false;
  }
  if(email == "" || email == null){
    alert("Please enter your email address");
    return false;
  }

  // Check item quantities
  // Variables again kasi bakit ayaw maging global grr
  var item1 = document.getElementById("item1");
  var item2 = document.getElementById("item2");
  var item3 = document.getElementById("item3");
  var item4 = document.getElementById("item4");
  var item5 = document.getElementById("item5");
  var item6 = document.getElementById("item6");

  // Check if user checked any of the items
  if(item1.checked != true && item2.checked != true && item3.checked != true &&
    item4.checked != true && item5.checked != true && item6.checked != true){
        alert("Please select an item.");
        return false;
      }

  if(item1.checked){
    itemCtr++;
    var qty1 = document.getElementById('qty1').value;
    if(qty1 < 1){
      alert("Invalid Rice quantity");
      return false;
    }
  }
  if(item2.checked){
    itemCtr++;
    var qty2 = document.getElementById('qty2').value;
    if(qty2 < 1){
      alert("Invalid Fried Rice quantity");
      return false;
    }
  }
  if(item3.checked){
    itemCtr++;
    var qty3 = document.getElementById('qty3').value;
    if(qty3 < 1){
      alert("Invalid Bottled Water quantity");
      return false;
    }
  }
  if(item4.checked){
    itemCtr++;
    var qty4 = document.getElementById('qty4').value;
    if(qty4 < 1){
      alert("Invalid Tapsilog quantity");
      return false;
    }
  }
  if(item5.checked){
    itemCtr++;
    var qty5 = document.getElementById('qty5').value;
    if(qty5 < 1){
      alert("Invalid Porksilog quantity");
      return false;
    }
  }
  if(item6.checked){
    itemCtr++;
    var qty6 = document.getElementById('qty6').value;
    if(qty6 < 1){
      alert("Invalid Tocilog quantity");
      return false;
    }
  }


  // Check credit card input
  if(document.getElementById("cc").checked) {
    var ccnum = document.getElementById("ccnum").value;
    if(ccnum.length != 12){
      alert("Credit Card number must be 12 DIGITS");
      return false;
    }
  } else {
    return true;
  }
}
