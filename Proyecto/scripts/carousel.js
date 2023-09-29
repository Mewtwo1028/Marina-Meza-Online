images = document.getElementsByClassName("carousel-item");
i = 1;
setInterval(function() {
  images[(i == images.length ? i=0 : i++)].click();
}, 3000);
