<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    

</head>

<body>
    

    <div class="container text-center pt-5">
    <div class="row">
        @for($j = 1; $j <= 10 ; $j++)
            @if ($j%2==1)
                <div class="col" style="padding: 0 !important; margin: 0 !important; margin-right: 80px !important">
            @else 
                <div class="col" style="padding: 0 !important; margin: 0 !important; margin-right: 0px !important">
            @endif
            @for($i = 8; $i >= 1 ; $i--)
            @php
                $col  = ""; 
                if ($j==1) $col = "A";
                else if ($j==2) $col = "B";
                else if ($j==3) $col = "C";
                else if ($j==4) $col = "D";
                else if ($j==5) $col = "E";
                else if ($j==6) $col = "F";
                else if ($j==7) $col = "G";
                else if ($j==8) $col = "H";
                else if ($j==9) $col = "I";
                else if ($j==10) $col = "J";
            @endphp
                <input type="checkbox" class="btn-check" id="{{$col}}{{ $i }}" onclick="reply_click(this.id)" autocomplete="off">
                <label class="btn btn-primary" for="{{$col}}{{ $i }}" style="width: 100% !important; border-radius: 0 !important">{{$col}}{{$i}}</label>
            @endfor
            </div>
        @endfor
       
    </div>
    </div>
    
    <br>
    <div class="d-flex align-items-center justify-content-center" style="margin-left: 170px; background-color:rgb(71, 129, 255); width: 50px; height:80px; text-align:center;">
        <span style="color: white;">Depot</span>
    </div>
    <div class="d-flex align-items-center justify-content-center">
        <h5 id="instruction"></h5>
    </div>
    


</body>


<!-- bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

<script>
    let temp_start = "Depot";
    let temp_dest = "Depot";
    let max_shelves = 9;
    let count = 0;
    document.getElementById("instruction").innerHTML += "Start from Depot <br/>";
    function reply_click(clicked_id)
    {
        count = count + 1;
        temp_start = temp_dest;
        temp_dest = clicked_id;
        
       
        if (temp_start != "Depot") {
            [temp_col_start, temp_row_start] = temp_start.split(/(?<=\D)(?=\d)/);
            
        } else {
            temp_col_start = "A", temp_row_start = "0";
        }

        [temp_col_dest, temp_row_dest] = temp_dest.split(/(?<=\D)(?=\d)/);
       
        shelves_pathway_start = 0
        if ((temp_col_start=="A") || (temp_col_start=="B"))
            shelves_pathway_start = 0;
        else if ((temp_col_start=="C") || (temp_col_start=="D"))
            shelves_pathway_start = 1;
        else if ((temp_col_start=="E") || (temp_col_start=="F"))
            shelves_pathway_start = 2;
        else if ((temp_col_start=="G") || (temp_col_start=="H"))
            shelves_pathway_start = 3;
        else if ((temp_col_start=="I") || (temp_col_start=="J"))
            shelves_pathway_start = 4;

        shelves_pathway_dest = 0;
        if ((temp_col_dest=="A") || (temp_col_dest=="B"))
            shelves_pathway_dest = 0;
        else if ((temp_col_dest=="C") || (temp_col_dest=="D"))
            shelves_pathway_dest = 1;
        else if ((temp_col_dest=="E") || (temp_col_dest=="F"))
            shelves_pathway_dest = 2;
        else if ((temp_col_dest=="G") || (temp_col_dest=="H"))
            shelves_pathway_dest = 3;
        else if ((temp_col_dest=="I") || (temp_col_dest=="J"))
            shelves_pathway_dest = 4;
        
        horizontal_direction = "";
        vertical_direction = " up";
        if (shelves_pathway_dest < shelves_pathway_start){
            horizontal_steps = shelves_pathway_start - shelves_pathway_dest;
            horizontal_direction = "left";
        }
            
        else if (shelves_pathway_dest > shelves_pathway_start){
            horizontal_steps = shelves_pathway_dest - shelves_pathway_start;
            horizontal_direction =  "right";
        }
        else
            horizontal_steps = 0;
        

        horizontal_steps = horizontal_steps * 3;
        total_steps_route1 =0;
        total_steps_route2=0;
        if (shelves_pathway_dest == shelves_pathway_start){
            
            if (temp_row_dest < temp_row_start){
                vertical_steps_to_dest = temp_row_start - temp_row_dest;
                vertical_steps_to_dest1 = temp_row_start - temp_row_dest;
                vertical_direction = "down";
                
            }                
            else if (temp_row_dest > temp_row_start){
                vertical_steps_to_dest = temp_row_dest - temp_row_start;
                vertical_steps_to_dest1 = temp_row_dest - temp_row_start;
                vertical_direction = "up";
            }
            
            vertical_steps_from_start = 0;
            vertical_steps_from_start1 = 0;
        }           
            
        else{
            //Route 1
            vertical_steps_to_dest = temp_row_dest;
            if (temp_row_dest > 0){                
                vertical_steps_from_start = temp_row_start;
            }
            total_steps_route1 = parseInt(vertical_steps_to_dest) + parseInt(horizontal_steps) + parseInt(vertical_steps_from_start);
            //vertical_direction = "up";
            //Route 2
            vertical_steps_to_dest1 = max_shelves - temp_row_dest;
            if (temp_row_dest > 0){                
                vertical_steps_from_start1 = max_shelves - temp_row_start;
                
            }
            vertical_direction1 = "down";
            total_steps_route2 = parseInt(vertical_steps_to_dest1) + parseInt(horizontal_steps) + parseInt(vertical_steps_from_start1);
        }
        
        
        console.log(total_steps_route1);
        console.log(total_steps_route2);
        if (total_steps_route1<total_steps_route2){
            if(vertical_steps_from_start != 0){            
                document.getElementById("instruction").innerHTML += "Move down " + vertical_steps_from_start + " steps, ";
                
            }
            if(horizontal_steps != 0){
                document.getElementById("instruction").innerHTML += "Move "+ horizontal_direction + " " + horizontal_steps + " steps, ";
            }
            
            if(vertical_steps_to_dest != 0){
                document.getElementById("instruction").innerHTML += "Move " + vertical_direction + " " + vertical_steps_to_dest + " steps, get item from " + clicked_id + "<br>";
                
            }
        }
        else{
            if(vertical_steps_from_start1 != 0){            
                document.getElementById("instruction").innerHTML += "Move up " + vertical_steps_from_start1 + " steps, ";
                
            }
            if(horizontal_steps != 0){
                document.getElementById("instruction").innerHTML += "Move "+ horizontal_direction + " " + horizontal_steps + " steps, ";
            }
            
            if(vertical_steps_to_dest1 != 0){
                if (shelves_pathway_dest != shelves_pathway_start)
                    document.getElementById("instruction").innerHTML += "Move " + vertical_direction1 + " " + vertical_steps_to_dest1 + " steps, get item from " + clicked_id + "<br>";
                else 
                    document.getElementById("instruction").innerHTML += "Move " + vertical_direction + " " +vertical_steps_to_dest1 + " steps, get item from " + clicked_id + "<br>";
            }
        }

        if (count == 4){
            vertical_steps_from_start = temp_row_dest;
            horizontal_steps = shelves_pathway_start * 3;
            if(vertical_steps_from_start != 0){            
                document.getElementById("instruction").innerHTML += vertical_steps_from_start + " steps" + " down" + ", ";
                
            }
            if(horizontal_steps != 0){
                document.getElementById("instruction").innerHTML += horizontal_steps + " steps left" + ", drop off items at depot<br/>Start from Depot<br/>";
            }

            else {
                document.getElementById("instruction").innerHTML += vertical_steps_to_dest + " steps down" + ", drop off items at depot<br/>Start from Depot<br/>";
            }
            count = 0;
            temp_dest = "Depot";
        }
        
    }

</script>

</html>