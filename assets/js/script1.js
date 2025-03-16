// // init Isotope
// var $grid = $('.collection-list').isotope({
//   // options
// });
// // filter items on button click
// $('.filter-button-group').on( 'click', 'button', function() {
//   var filterValue = $(this).attr('data-filter');
//   resetFilterBtns();
//   $(this).addClass('active-filter-btn');
//   $grid.isotope({ filter: filterValue });
// });

// var filterBtns = $('.filter-button-group').find('button');
// function resetFilterBtns(){
//   filterBtns.each(function(){
//     $(this).removeClass('active-filter-btn');
//   });
// }

const toggleButton = document.querySelector('.toggle-button-my');
const navbarLinks = document.querySelector('.navbar-links-my');

toggleButton.addEventListener('click', () => {
    navbarLinks.classList.toggle('active');
    toggleButton.classList.toggle('open');
});

toggleButton.addEventListener('click', () => {
    toggleButton.classList.toggle('open');
});

const bars = document.querySelectorAll('.bar');

toggleButton.addEventListener('click', () => {
    bars[0].classList.toggle('rotate-down');
    bars[1].classList.toggle('hide');
    bars[2].classList.toggle('rotate-up');
});