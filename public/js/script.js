document.addEventListener("DOMContentLoaded", function() {
    var home = document.getElementById("home");
    var scrollTohomeButton = document.getElementById("scrollBack");
    var logo = document.getElementById("logo");
    window.addEventListener("scroll", function() {
      var scrollPosition = window.scrollY || window.pageYOffset;
  
      if (scrollPosition > home.offsetTop) {
        scrollTohomeButton.classList.add("show");
        
      } else {
        
        scrollTohomeButton.classList.remove("show");
      }
    });
  
    scrollTohomeButton.addEventListener("click", function() {
      var scrollOptions = {
        top: home.offsetTop,
        behavior: "smooth"
      };
      
  
      if ("scrollBehavior" in document.documentElement.style) {
        window.scrollTo(scrollOptions);
      } else {
        smoothScrollTo(scrollOptions);
      }
      // let lastActiveLink = document.querySelector('.nav-links li a.active');
      // lastActiveLink.classList.remove('active');
      // links[0].classList.add('active');
    });
    logo.addEventListener("click", function() {
      var scrollOptions = {
        top: home.offsetTop,
        behavior: "smooth"
      };
  
      if ("scrollBehavior" in document.documentElement.style) {
        window.scrollTo(scrollOptions);
      } else {
        smoothScrollTo(scrollOptions);
      }
      // let lastActiveLink = document.querySelector('.nav-links li a.active');
      // lastActiveLink.classList.remove('active');
      // links[0].classList.add('active');
    });
  
    function smoothScrollTo(scrollOptions) {
      var startTime = performance.now();
      var startTop = window.scrollY || window.pageYOffset;
      var duration = 1000; 
  
      function scroll(timestamp) {
        var currentTime = timestamp - startTime;
        var scrollProgress = Math.min(currentTime / duration, 1);
        var scrollPosition = startTop + scrollProgress * (scrollOptions.top - startTop);
  
        window.scrollTo(0, scrollPosition);
  
        if (currentTime < duration) {
          requestAnimationFrame(scroll);
        }
      }
  
      requestAnimationFrame(scroll);
    }
  });
  document.addEventListener("DOMContentLoaded", function() {
    var navbar = document.getElementById("navbar");
    var navbarHeight = navbar.offsetHeight;
    var atTop = true;
  
    window.addEventListener("scroll", function() {
      var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  
      if (scrollTop > navbarHeight && atTop) {
        navbar.classList.add("colored");
        navbar.classList.remove("transparent");
        atTop = false;
      } else if (scrollTop <= navbarHeight && !atTop) {
        navbar.classList.add("transparent");
        navbar.classList.remove("colored");
        atTop = true;
      }
    });
  });
  
let list = document.querySelector('.slider .list');
let items = document.querySelectorAll('.slider .list .item');
let dots = document.querySelectorAll('.slider .dots li');
let prev = document.getElementById('prev');
let next = document.getElementById('next');

let lengthItems = items.length-1;
let active = 0;

next.onclick = function() {
  if(active + 1 > lengthItems) {
    active = 0;
  } else {
    active += 1;
    
  }
  reloadSlider();
}
prev.onclick = function() {
  if(active - 1 < 0){
    active = lengthItems;
  } else {
    active = active-1;
  }
  reloadSlider();
}
let refreshSlider = setInterval(()=> {next.click()},3000);
function reloadSlider() {
  let checkLeft = items[active].offsetLeft;
  list.style.left = -checkLeft + 'px';

  let lastActiveDot = document.querySelector('.slider .dots li.active');
  lastActiveDot.classList.remove('active');
  dots[active].classList.add('active');
  clearInterval(refreshSlider);
  refreshSlider = setInterval(()=> {next.click()},3000);
}
dots.forEach((li, key) => {
  li.addEventListener('click',function(){
    active = key;
    reloadSlider();
  })
})

