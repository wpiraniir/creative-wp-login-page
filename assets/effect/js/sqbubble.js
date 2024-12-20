/* jQuery(document).ready(function(){
jQuery( "<div class='area'><ul class='clp-shape'><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li></ul></div>" ).appendTo( 'html' );
}); */

document.addEventListener('DOMContentLoaded', function() {
  const area = document.createElement('div');
  area.classList.add('area');

  const ul = document.createElement('ul');
  ul.classList.add('clp-shape');

  for (let i = 0; i < 10; i++) {
    const li = document.createElement('li');
    ul.appendChild(li);
  }

  area.appendChild(ul);
  document.documentElement.appendChild(area);

  // Wait for the next repaint before starting the animation
  requestAnimationFrame(function() {
    startAnimation();
  });
});

function startAnimation() {
  // Add your animation start logic here
  const clpShape = document.querySelector('.clp-shape');
  clpShape.classList.add('bubanimate');
}
