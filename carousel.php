<div class="slideshow-container" style="position:relative">
    <div class="mySlides fade">
        <img src="carousel.jpg" style="width:100%">
    </div>
    
    <div class="mySlides fade">
        <img src="carousel0.jpg" style="width:100%">
    </div>
              
    <div class="mySlides fade">
        <img src="carousel2.jpg" style="width:100%">
    </div>
</div>

<div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
</div>

<script>
    var slideIndex = 0;
    showSlides();
                    
    function showSlides() 
    {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}    
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";  
        dots[slideIndex-1].className += " active";
        setTimeout(showSlides, 5000); // Change image every 5 seconds
    }
    var modal = document.getElementById('loginform');
    window.onclick = function(event) 
    {
        if (event.target == modal) 
        {
            modal.style.display = "none";
        }
    }
    var modal = document.getElementById('signupform');
    window.onclick = function(event) 
    {
        if (event.target == modal) 
        {
            modal.style.display = "none";
        }
    }
</script>