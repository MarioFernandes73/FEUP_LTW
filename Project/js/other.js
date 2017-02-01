$(function() {
	$(".select_all").each(function(index){
		var group = $(this).data("group");
		var parent = $(this);
		
		parent.change(function(){  //"select all" change 
			 $(group).prop('checked', parent.prop("checked"));
		});
		$(group).change(function(){ 
			parent.prop('checked', false);
			if ($(group+':checked').length == $(group).length ){
				parent.prop('checked', true);
			}
		});
	});
});

$(function() {
    $("#button_comments").click(function() {
		if($(this).attr("value") == "Show Comments"){
			$(this).attr("value","Hide Comments");
			$(this).next().slideDown(1000).fadeIn(1000);
		}
		else{
			$(this).attr("value","Show Comments");
			$(this).next().slideUp(1000).fadeOut(1000);
		}
	});
});

$(function() {
    $(".button_reply").click(function() {
		if($(this).attr("value") == "Show Replies"){
			$(this).attr("value","Hide Replies");
			$(this).next().slideDown(1000).fadeIn(1000);
		}
		else{
			$(this).attr("value","Show Replies");
			$(this).next().slideUp(1000).fadeOut(1000);
		}
	});
});

$(function() {
    $(".button_do_reply").click(function() {
		if($(this).attr("value") == "Reply"){
			$(this).attr("value","Don't Reply");
			$(this).next().slideDown(1000).fadeIn(1000);
		}
		else{
			$(this).attr("value","Reply");
			$(this).next().slideUp(1000).fadeOut(1000);
		}
	});
});


var slideIndex = 1;

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
}