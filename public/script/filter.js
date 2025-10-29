
const $slide = $('.slide');
const $next = $('.next');
const $prev = $('.prev');

let currentIndex = 0;
const totalSlides = $slide.length;


$slide.hide().eq(0).show();


$next.on('click', function() {
$slide.eq(currentIndex).fadeOut(100);
currentIndex = (currentIndex + 1) % totalSlides;
$slide.eq(currentIndex).fadeIn(400);
});


$prev.on('click', function() {
$slide.eq(currentIndex).fadeOut(100);
currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
$slide.eq(currentIndex).fadeIn(400);
});


setInterval(function() {
$next.click();
}, 3000); 
