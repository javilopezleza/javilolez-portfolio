function tablasMultiplicar(){

    
    for (let j = 0; j <= 6; j++) {
        document.write("<table border='1px'>")
        for(i = 1;i<=10;i++){
            document.write("<tr>")

            document.write("<td>"+j + " x " + i + "= " + j * i+"</td>");
        
            document.write("</tr>")
        }
        document.write("</table>")
	}
    

}

