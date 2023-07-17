<?php
function fruta(){

    
$frutas = ["Pera", " Sandia", " Manzana", " Melón", " Piña"];

echo("<h2> Array antes de añadir la fruta </h2>");
echo("<ul>");
for ($i = 0; $i < count($frutas); $i++) {
    echo("<li>$frutas[$i]</li>");
}
echo("</ul>");
array_push($frutas, " Kiwi");

echo("<h2> Array despues de añadir la fruta </h2>");

for ($i = 0; $i < count($frutas); $i++) {
    if($i == 2){
        echo("<strong>$frutas[$i],</strong>");
    }else if( $i < count($frutas)-1){
        echo("$frutas[$i],");
    }
    else{
        echo("$frutas[$i].");
    }
}
echo "<br>";

}


function tablasMultiplicar($num){

    for ( $j = 1; $j <= $num; $j++) {
       echo("<table border='1px'>");
        for($i = 1;$i<=10;$i++){
           echo("<tr>");

           echo("<td>$j x $i = ".($j * $i)."</td>");
        
           echo("</tr>");
        }
       echo("</table>");
	}
    

}


?>