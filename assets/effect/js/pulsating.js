document.addEventListener('DOMContentLoaded', function() {
    var rippleBackground = document.createElement('div');
    rippleBackground.className = 'ripple-background';
    rippleBackground.innerHTML = "<div class='circle xxlarge shade1'></div>" +
                                 "<div class='circle xlarge shade2'></div>" +
                                 "<div class='circle large shade3'></div>" +
                                 "<div class='circle medium shade4'></div>" +
                                 "<div class='circle small shade5'></div>";
    document.body.appendChild(rippleBackground);
});
