// Mobile nav toggle
document.addEventListener('click', function (e) {
  var toggle = e.target.closest('.nav-toggle');
  if (toggle) {
    var links = document.getElementById('nav-links');
    if (links) links.classList.toggle('open');
  }
});
