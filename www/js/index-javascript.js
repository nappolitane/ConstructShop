const carouselSlide = document.querySelector('.carousel-slide');
const carouselImages = document.querySelectorAll('.carousel-slide .gallery');

const prevBtn = document.querySelector('#prevBtn');
const nextBtn = document.querySelector('#nextBtn');

var pos = 0;
const size = carouselImages[0].clientWidth;

carouselSlide.style.transform = 'translateX(' + (-size - 10) + 'px)';

prevBtn.addEventListener('click',()=>{
	carouselSlide.appendChild(carouselImages[pos]);
	carouselImages[pos].style.webkitAnimationPlayState = "paused";
	if(pos === 5){ pos = 0; }
	else { pos++; }
	
	if(pos === 0){ pos = 5; }
	else { pos--; }
	if(pos === 0){ pos = 5; }
	else { pos--; }
	carouselImages[pos].style.webkitAnimationPlayState = "running";
	if(pos === 5){ pos = 0; }
	else { pos++; }
	if(pos === 5){ pos = 0; }
	else { pos++; }
});

nextBtn.addEventListener('click',()=>{
	if(pos === 0){ pos = 5; }
	else { pos--; }
	carouselSlide.insertBefore(carouselImages[pos], carouselSlide.firstChild);
	carouselImages[pos].style.webkitAnimationPlayState = "paused";
	
	if(pos === 5){ pos = 0; }
	else { pos++; }
	carouselImages[pos].style.webkitAnimationPlayState = "running";
	if(pos === 0){ pos = 5; }
	else { pos--; }
});


