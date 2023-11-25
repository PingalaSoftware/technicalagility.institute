// JavaScript Document
function myFunction() {
var qty = Number(document.getElementById('quntity').value);
var base_price1 = Number(document.getElementById('base_price').value);
//alert(qty);
//alert(base_price1);
var myResult = qty * base_price1;
//var coupencode = document.getElementById("coupencode").value;
document.getElementById('amountn').innerHTML = ''+myResult;
//var myResult1 = myResult - coupencode;
document.getElementById('amount1').innerHTML = ''+myResult;
var total = document.getElementById('amount');
total.value = myResult;
 //alert(coupencode); 
}

function showhide()
 {
var qty = document.getElementById('quntity').value;
var base_price1 = Number(document.getElementById('base_price').value);
//alert(qty);
//alert(base_price1);
var myResult = qty * base_price1;
var famount = 0;	 
var coupencode = document.getElementById("coupencode").value;
var nprice =  Number(document.getElementById('amount').value);
//var amountn1 =  Number(document.getElementById('amountn').value);
function search(nameKey, myArray){
    for (var i=0; i < myArray.length; i++) {
        if (myArray[i] === nameKey) {
            return myArray[i];
        }
    }
}
									 
function isLetter(anyText) {
  //alert(anyText);
  return anyText.length === 1 && anyText.match(/[a-z]/i);
}
// Multiple Coupon Code Handling
var array = ["DEVO4000"];

var resultObject = search(coupencode, array);
//alert(resultObject);
if(coupencode ==0 || coupencode =='') {

document.getElementById('amount1').innerHTML= ''+myResult;
var total = document.getElementById('amount');
total.value = myResult;
alert('please enter coupon code!');

} else if(coupencode == resultObject) {
//alert(nprice);
//alert(coupencode + " Here");  
//var famount = myResult-(coupencode*qty);
//code to accept alphsnumeric coupon


var couponTest = coupencode.substring(1,0);

//alert(isLetter(couponTest));

if(isLetter(couponTest)==false)
{ 
  famount = myResult-(Number(coupencode)*qty);
}
else
{
  var couponAmount = Number(coupencode.substring(4)) * qty;
  famount = myResult-couponAmount;
}						 
									 
//End of code								 

 //alert(famount);
 document.getElementById('amount1').innerHTML= ''+famount;
var total = document.getElementById('amount');
total.value = famount; 
alert('Coupon code applied successfully!');
//document.getElementById('couponsuccess').innerHTML= 'coupon code applied successfully!';
} else {

document.getElementById('amount1').innerHTML= ''+myResult;
var total = document.getElementById('amount');
total.value = myResult;
alert('Coupon Code not valid!');
}}

