<script>
var myVar;
myFunctionLo() 
function myFunctionLo() {
    console.log("rider")
  myVar = setTimeout(showPageLo, 3000);
}

function showPageLo() {
   
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDivLo").style.display = "block";
}
</script>