
var toolbar = document.getElementById('aq');
var header = document.getElementById('ae');
var attributes = document.getElementById('aw');

function updateStyles() {
const height_to = toolbar.clientHeight;
const height_he = header.clientHeight;
const height_at = attributes.clientHeight;
console.log(height_at, height_he, height_to)

document.querySelector(".patients-list").style.height = window.innerHeight - (height_to + height_he + height_at + 25) + "px";
}


window.onload = updateStyles;
window.onresize = updateStyles;
