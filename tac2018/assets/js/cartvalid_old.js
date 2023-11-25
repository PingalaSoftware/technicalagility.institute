// JavaScript Document
function myFunction() {
var qty = document.getElementById('quntity').value;
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
	 
var coupencode = Number(document.getElementById("coupencode").value);
var nprice =  Number(document.getElementById('amount').value);
//var amountn1 =  Number(document.getElementById('amountn').value);
function search(nameKey, myArray){
    for (var i=0; i < myArray.length; i++) {
		//alert(myArray.length);
        if (myArray[i] === nameKey) {
            return myArray[i];
        }
    }
}
// Multiple Coupon Code Handling
var array = [1000,2000];

var resultObject = search(coupencode, array);
//alert(resultObject);
if(coupencode ==0 || coupencode =='') {

document.getElementById('amount1').innerHTML= ''+myResult;
var total = document.getElementById('amount');
total.value = myResult;
alert('please enter coupon code!');

} else if(coupencode == resultObject) {
//alert(nprice);
//alert(coupencode);  
var famount = myResult-(coupencode*qty);
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

