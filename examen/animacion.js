window.addEventListener("load",
    () => {

        let image = document.getElementById("img");
        let image2 = document.getElementById("img2");
        let button = document.getElementById("stop");

        button.addEventListener("click",
            () => {

                if (image.style.display == "block"){
                    image2.style.display = "block";
                    image.style.display = "none";
                    button.innerHTML = "Reanudar animación"
                }else{
                    image.style.display = "block";                
                    image2.style.display = "none";
                    button.innerHTML = "Parar animación"
                }

            });


    });