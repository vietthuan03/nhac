var jgt = 5;
document.getElementById('time').innerHTML = jgt;

function stime() {
  document.getElementById('time').innerHTML = jgt;
  jgt = jgt - 1;
  if (jgt == 0) {
    clearInterval(timing);
    history.go(-1);
  }
}
var timing = setInterval("stime();", 1000);
