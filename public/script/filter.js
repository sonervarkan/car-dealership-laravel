
const $slide = $('.slide');
const $next = $('.next');
const $prev = $('.prev');

let currentIndex = 0;
const totalSlides = $slide.length;

// Başlangıçta ilk slide aktif
$slide.hide().eq(0).show();

// İleri butonu
$next.on('click', function() {
$slide.eq(currentIndex).fadeOut(100);
currentIndex = (currentIndex + 1) % totalSlides;
$slide.eq(currentIndex).fadeIn(400);
});

// Geri butonu
$prev.on('click', function() {
$slide.eq(currentIndex).fadeOut(100);
currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
$slide.eq(currentIndex).fadeIn(400);
});

// Otomatik geçiş
setInterval(function() {
$next.click();
}, 3000); // her 3 saniyede bir
