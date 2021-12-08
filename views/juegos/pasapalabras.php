<section class = 'container section-juego'>
        <div class="pasapalabra" id='pasapalabra'>
            <h1 class='mainTitle' id='pasapalabraTitle'></h1>
            <div class="box stats" id='statsBox'>
                <div class ='box' id='timerBox'>
                    <p id='timer'>
                        150
                    </p>
                </div>
                <div class='box' id='hitsBox'>
                    <p id='hits'>
                        0
                    </p>
                </div>
            </div>
            <div class="box donut" id='donutLetters'>
                <div class ='letter' id='letterA'>A</div>
                <div class ='letter' id='letterB'>B</div>
                <div class ='letter' id='letterC'>C</div>
                <div class ='letter' id='letterD'>D</div>
                <div class ='letter' id='letterE'>E</div>
                <div class ='letter' id='letterF'>F</div>
                <div class ='letter' id='letterG'>G</div>
                <div class ='letter' id='letterH'>H</div>
                <div class ='letter' id='letterI'>I</div>
                <div class ='letter' id='letterJ'>J</div>
                <div class ='letter' id='letterK'>K</div>
                <div class ='letter' id='letterL'>L</div>
                <div class ='letter' id='letterM'>M</div>
                <div class ='letter' id='letterN'>N</div>
                <div class ='letter' id='letterÑ'>Ñ</div>
                <div class ='letter' id='letterO'>O</div>
                <div class ='letter' id='letterP'>P</div>
                <div class ='letter' id='letterQ'>Q</div>
                <div class ='letter' id='letterR'>R</div>
                <div class ='letter' id='letterS'>S</div>
                <div class ='letter' id='letterT'>T</div>
                <div class ='letter' id='letterU'>U</div>
                <div class ='letter' id='letterV'>V</div>
                <div class ='letter' id='letterW'>W</div>
                <div class ='letter' id='letterX'>X</div>
                <div class ='letter' id='letterY'>Y</div>
                <div class ='letter' id='letterZ'>Z</div>
            </div>


            
            <div id='questions'>     
            </div>
           
           
            <div class="box contenedor_respuestas">             
                
            <form class="form_pregunta">
                <input  id="answers" class="input-juego" type='text' autocomplete="off">
             
                <div class="contenedor_botones">
                     <button type="button" class='btn_juego btn_paso'>Paso</button>
                     <button type="button" class='btn_juego btn_respuesta'>Responder</button>
                </div>
            </form>

            </div>





            <div class="box  introducción" id='instructions'>
                <h3>
                    ¡Bienvenido al Pasapalabra de Jaure Ventas!
                </h3>
                <p>
                   Es simple, fácil y podes ganarte muchos premios. 
                </p>

                <p> Crea un nombre de usuario y apreta en "Jugar" </p>
                <small> Puedes utilizar tu nombre o crear uno </small>
         
                <form class="form_usuario">

                    <input class="input-juego apodo_usuario" type='text' autocomplete="off">
                    <button type="submit" class='jugar'>Jugar</button>
                    
                </form>
            </div>

           
      
      
            <div class="box input-juego-2 ">
              
                   
            </div>
            <div class='box input-juego-2' id='inputBox'>
               </div>
      
      
      
            </div>
      
      
      
      
      
        <div class='box' id='scoreBox'>
            <div id='points'>Tu puntuación
                <p id='pointsNumber'>
                    0
                </p>
            </div>
            <button id='newGame'>
                ¿Juego nuevo?
            </button>
            <div class='ranking'>
                <p id='rankingTitle'>
                    Ranking
                </p>
                <table>
					<thead>
						<tr>
							<th>Posición</th>
							<th>Jugador</th>
							<th>Aciertos</th>
							<th>Fallos</th>
                            <th>Tiempo Restante</th>
						</tr>
					</thead>
					<tbody id='rankingBody'>
					</tbody>
				</table>
            </div>
        </div>
    </section>   
    <script src="../juegos/index.js"></script>
</html>