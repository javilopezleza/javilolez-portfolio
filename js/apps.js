window.addEventListener("load",
    () => {

        let user = document.getElementById('user');
        let uses = document.getElementById("adminUses");
        let close = document.getElementById("close");


        user.addEventListener("click",
            () => {
                if (uses.style.display == "none") {
                    uses.style.display = "block";
            
                } else {
                    uses.style.display = "none"
                }
            });

        close.addEventListener("click",
        () => {
            if (uses.style.display == "none") {
                uses.style.display = "block";
        
            } else {
                uses.style.display = "none"
            }
        });

    });

    $(document).ready(function() {
        $('.to-top').click(function() {
          $('body, html').animate({
            scrollTop: '0px'
          }, 000);
        });
  
        $(window).scroll(function() {
          if ($(this).scrollTop() > 0) {
            $('.to-top').slideDown(300);
          } else {
            $('.to-top').slideUp(300);
          }
        });
      });