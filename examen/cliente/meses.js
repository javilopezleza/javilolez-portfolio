function diasDelMes(mes) {


    mes = document.getElementById("mes").value
    let resultado = document.getElementById("resultado");
    let resultado2 = document.getElementById("resultado2");

    switch (mes.toLowerCase()) {
        case 'enero':
            resultado2.innerHTML = `Enero tiene 31 días`
            break;
        case 'febrero':
            resultado2.innerHTML = `Febrero tiene 28 días`
            break;
        case 'marzo':
            resultado2.innerHTML = `Marzo tiene 31 días`
            break;
        case 'abril':
            resultado2.innerHTML = `Abril tiene 30 días`
            break;
        case 'mayo':
            resultado2.innerHTML = `Mayo tiene 31 días`
            break;
        case 'junio':
            resultado2.innerHTML = `Junio tiene 30 días`
            break;
        case 'julio':
            resultado2.innerHTML = `Julio tiene 31 días`
            break;
        case 'agosto':
            resultado2.innerHTML = `Agosto tiene 31 días`
            break;
        case 'septiembre':
            resultado2.innerHTML = `Septiembre tiene 30 días`
            break;
        case 'octubre':
            resultado2.innerHTML = `Octubre tiene 31 días`
            break;
        case 'novimebre':
            resultado2.innerHTML = `Noviembre tiene 30 días`
            break;
        case 'diciembre':
            resultado2.innerHTML = `Diciembre tiene 31 días`
            break;
        default:
            resultado2.innerHTML = `Mes no valido`
            break;
    }

}

