window.addEventListener("load",
    () => {

        let num1 = document.getElementById("num1");
        let num2 = document.getElementById("num2");
        let button = document.getElementById("calcular");
        let verify = document.getElementById("verify");
        let verify2 = document.getElementById("verify2");
        let form = document.getElementById("numbers");
        let calc = document.getElementById("calc");


        form.addEventListener("keyup",
            () => {

                if (isNaN(parseFloat(num1.value))) {
                    verify.style.color = "red";
                    verify.innerHTML = "<strong>Por favor introduce un número</strong>";
                } else {
                    verify.style.color = "green";
                    verify.innerHTML = "<strong>Número introducido correctamente</strong>"
                }

                if (isNaN(parseFloat(num2.value))) {
                    verify2.style.color = "red";
                    verify2.innerHTML = "<strong>Por favor introduce un número</strong>"
                } else {
                    verify2.style.color = "green";
                    verify2.innerHTML = "<strong>Número introducido correctamente</strong>"
                }
            });

        button.addEventListener("click",
            (e) => {
                if ((Number(num1.value) > Number(num2.value))){
                    calc.style.color = "black"
                    calc.innerText = `${num1.value} es mayor que ${num2.value}`
                }else if((Number(num1.value) < Number(num2.value))){
                    calc.style.color = "black"
                    calc.innerText = `${num1.value} es menor que ${num2.value}`
                }else if((Number(num1.value) == Number(num2.value))){
                    calc.innerText = `${num1.value} y ${num2.value} son iguales`
                }else{
                    calc.style.color = "red"
                    calc.innerText = `Introduce numeros válidos o sin letras`
                    e.preventDefault();
                }
            });

        });


