<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>testing</title>
</head>
<style>
    .v-counter {
    border-radius: 32px;
    max-width: 70px;
    overflow: auto;
    padding: 0px 4px;
    border: 1px solid #323140;
    margin: 10px;
}

.v-counter input[type=button]:hover {
    color: black;
    font-weight: bold;
    background-color: transparent;
}
.v-counter span {
   
    font-size: 13px;
    color: black;
    font-family: 'Open Sans';
}
.v-counter input[type=button], input[type=text] {
    display: inline-block;
    width: 20px;
    background-color: transparent;
    outline: none;
    border: none;
    text-align: center;
    cursor: pointer;
    padding: 0px;
    color: black;
    height: 33px;
    font-family: 'Open Sans';
}
</style>
<body>
    

<div class="v-counter">
	<input type="button" class="minusBtn" value="-" />
	<input type="text" size="15" value="1" class="count" />
	<input type="button" class="plusBtn" value="+" />
</div>






</body>
<script>
    
// Store references that all functions can use.
var resultEl = document.querySelector(".resultSet"),
  plusMinusWidgets = document.querySelectorAll(".v-counter");

// Attach the handlers to each plus-minus thing
for (var i = 0; i < plusMinusWidgets.length; i++) {
  plusMinusWidgets[i].querySelector(".minusBtn").addEventListener("click", clickHandler);
  plusMinusWidgets[i].querySelector(".plusBtn").addEventListener("click", clickHandler);
  plusMinusWidgets[i].querySelector(".count").addEventListener("change", changeHandler);
}

/*****
 * both plus and minus use the same function, but value is set by the class of the
 *  button
 *****/
function clickHandler(event) {
  // reference to the count input field
  var countEl = event.target.parentNode.querySelector(".count");
  if (event.target.className.match(/\bminusBtn\b/)) {
    countEl.value = Number(countEl.value) - 1;
  } else if (event.target.className.match(/\bplusBtn\b/)) {
    countEl.value = Number(countEl.value) + 1;
    
  }
  // When we programmatically change the value, we need to manually trigger
  //  the change event.
  triggerEvent(countEl, "change");
};

/*****
 * changeHandler() processes whenever a plusMinusWidget's count el is changed.
 *  It iterates over all plusMinusWidgets, gets their count, and outputs that
 *  to the given resultEl input field.
 *****/
function changeHandler(event) {
  // remove all value from the result el.
  resultEl.value = 0;
  /******
   * Here is the only functional change, per your comment. Rather
   *  concatenating a string, you want to sum values of the 
   *  plusMinusWidget. To do this, we need to cast the value of each
   *  plusMinusWidget to a Number value, and add that to the Number
   *  value of the resultEl.
   *****/
  for (var i = 0; i < plusMinusWidgets.length; i++) {
    // Add the current plusMinusWidget value to the resultEl value.
    resultEl.value = Number(resultEl.value) + Number(plusMinusWidgets[i].querySelector('.count').value);

  }

};

/*****
 * triggerEvent() -- function to trigger an HTMLEvent on a given element.
 *  similar to jquery's trigger(), simply a convenience function. Not the
 *  point of this exercise.
 *****/

function triggerEvent(el, type){
   if ('createEvent' in document) {
        // modern browsers, IE9+
        var e = document.createEvent('HTMLEvents');
        e.initEvent(type, false, true);
        el.dispatchEvent(e);
    } else {
        // IE 8
        var e = document.createEventObject();
        e.eventType = type;
        el.fireEvent('on'+e.eventType, e);
    }
}
</script>
</html>