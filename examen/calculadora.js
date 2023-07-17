window.addEventListener("load",
    () => {
        //Calculadora hecha con Javascript

        let resultado = document.getElementById("resultado");
        let lista = document.getElementById("operacion");
        let button = document.getElementById("calcular");


        lista.addEventListener("change",
            () => {


                //Variables almacenadas
                let lista = document.getElementById("operacion").value;
                var numero1 = document.getElementById("num1").value;
                var numero2 = document.getElementById("num2").value;
                var potencia = document.getElementById("potencia").value;

                //Operaciones
                var suma = Number(numero1) + Number(numero2);
                var multiplicacion = Number(numero1) * Number(numero2);
                var division = Number(numero1) / Number(numero2);
                var resta = Number(numero1) - Number(numero2);
                var potencia1 = Math.pow(Number(numero1), Number(potencia));
                var potencia2 = Math.pow(Number(numero2), Number(potencia));


                //Pintando el resultado
                button.addEventListener("click",
                    () => {

                        if (lista == "suma") {
                            resultado.innerHTML = `El resultado de ${numero1} + ${numero2} = ${suma} <br></br>`
                        } else if (lista == "resta") {
                            resultado.innerHTML = `El resultado de ${numero1} - ${numero2} = ${resta} <br>`
                        } else if (lista == "multiplicacion") {
                            resultado.innerHTML = `El resultado de ${numero1} x ${numero2} = ${multiplicacion} <br></br>`
                        } else if (lista == "division") {
                            resultado.innerHTML = `El resultado de ${numero1} / ${numero2} = ${division} <br></br>`
                        } else if (lista == "potencia") {
                            resultado.innerHTML = `<strong>La potencia</strong> del numero ${numero1} elevado a ${potencia}= ${potencia1}<br>
                        <strong>La potencia</strong> del numero ${numero2} elevado a ${potencia} = ${potencia2}`
                        } else if (lista == "raiz") {
                            resultado.innerHTML = `La raiz cuadrada de ${numero1} = ${Math.sqrt(numero1)} <br>`
                        }
                    });
            });




        // Calculadora hecha con Jquery


        $(document).ready(function () {
            $("#operacion2").change(function () {

                //Variables almacenadas
                var numero3 = document.getElementById("num3").value;
                var numero4 = document.getElementById("num4").value;
                var potencia_2 = document.getElementById("potencia2").value;
                let resultado_2 = document.getElementById("resultado2");

                //operaciones
                var suma2 = Number(numero3) + Number(numero4);
                var multiplicacion2 = Number(numero3) * Number(numero4);
                var division2 = Number(numero3) / Number(numero4);
                var potencia3 = Math.pow(Number(numero3), Number(potencia_2));
                var potencia4 = Math.pow(Number(numero4), Number(potencia_2));
                var resta2 = Number(numero3) - Number(numero4);

                //Pintando el resultado


                if ($(this).val() == "suma2") {
                    resultado_2.innerHTML = `El resultado de ${numero3} + ${numero4} = ${suma2} <br></br>`
                } else if ($(this).val() == "resta2") {
                    resultado_2.innerHTML = `El resultado de ${numero3} - ${numero4} = ${resta2} <br>`
                } else if ($(this).val() == "multiplicacion2") {
                    resultado_2.innerHTML = `El resultado de ${numero3} x ${numero4} = ${multiplicacion2} <br></br>`
                } else if ($(this).val() == "division2") {
                    resultado_2.innerHTML = `El resultado de ${numero3} / ${numero4} = ${division2} <br></br>`
                } else if ($(this).val() == "potencia-2") {
                    resultado_2.innerHTML = `<strong>La potencia</strong> del numero ${numero3} elevado a ${potencia_2} = ${potencia3}<br>
                        <strong>La potencia</strong> del numero ${numero4} eleveado a ${potencia_2} = ${potencia4}`
                } else if ($(this).val() == "raiz2") {
                    resultado_2.innerHTML = `La raiz cuadrada de ${numero3} = ${Math.sqrt(numero3)} <br>`
                }
            });
        });
    });
