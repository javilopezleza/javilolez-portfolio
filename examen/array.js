function fruta(){

    
    let frutas = ["Pera", " Sandia", " Manzana", " Melón", " Piña"];

    document.write("<h2> Array antes de añadir la fruta </h2>");
    document.write("<ul>");
    for (let i = 0; i < frutas.length; i++) {
        document.write("<li>"+frutas[i]+"</li>")
    }
    document.write("</ul>");
    
    frutas.push(" Kiwi");

    
    document.write("<h2> Array despues de añadir la fruta </h2>");
    
    
    for (let i = 0; i < frutas.length; i++) {
        if(i == 2){
            document.write(`<strong>${frutas[i]},</strong>`)
        }else if( i < frutas.length-1){
            document.write(`${frutas[i]},`);
        }
        else{
            document.write(`${frutas[i]}`);
        }
    }
}
    
    



