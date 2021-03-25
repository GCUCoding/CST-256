/**
 * 
 */
function check(action, object)
{
	console.log("Entered check method");
    var checked = confirm("Are you sure you want to " + action + " this " + object + "?");
    console.log(checked + " is the result of the confirm()");
    return checked;
}

function activitychange()
{
	console.log("Changed job activity");
	var el = document.getElementById("active");
	var active = el.options[el.selectedIndex].value;
	if(active == 0)
	{
		alert("Changing the activity status of this job will prevent it from being viewed.");	
	}
}

function applySuccess()
{
	alert("Thank you for your application!");
}
 
function confPass()
{
	var pass1 = document.getElementById("pass1").value;
	var pass2 = document.getElementById("pass2").value;
	if(!hasCapitalAndLowerCase(pass1))
	{
		alert("Your password must contain an uppercase and a lowercase letter");
		document.getElementById("pass1").value = null;
		document.getElementById("pass2").value = null;
		return false;
	}
	if(!hasNumber(pass1))
	{
		alert("Your password must contain a number");
		document.getElementById("pass1").value = null;
		document.getElementById("pass2").value = null;
		return false;
	}
	if(pass1 == pass2)
	{
		return true;
	}
	else
	{
		alert("The passwords do not match.");
		return false;
	}
}

function dateCheck()
{
	var date1 = document.getElementById("date1").value;
	var date2 = document.getElementById("date2").value;
	if(date1 < date2)
	{
		return true;
	}
	else if(date1 > date2 && date2 != null && date2 != "")
	{
		console.log("date1 = " + date1);
		console.log("date2 = " + date2);
		alert("The end date must come before the start date");
		document.getElementById("date2").value = null;
		return false;
	}
}

function hasNumber(myString) 
{
  console.log(myString);
  console.log(/\d/.test(myString)); 
  return /\d/.test(myString);
}

function hasCapitalAndLowerCase(str)
{
	console.log("Upper case password: " + str.toUpperCase());
	console.log("Lower case password: " + str.toLowerCase());
	console.log("Actual password: " + str);
	return str != str.toLowerCase() && str != str.toUpperCase();
}