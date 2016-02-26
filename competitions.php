<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Turniere</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style>

    </style>

  </head>
  <body class="bg-default">

  <!-- Include Navigation Bar on the Serverside -->
  <div id="#nav-bar">
    <?php
      include("includes/main-nav.inc.html");
    ?>
  </div>

  <!--Main Content -->
  <div class="container-fluid text-center">    
    <div class="row content">
      <div class="col-sm-2 col-sm-offset-1 sidenav">
        <h2>Turniere</h2>
        <ul class="pagination">
          <li id="come" class="active"><a href="#">Kommende</a></li>
          <li id="gone" class=""><a href="#">Vergangene</a></li>
        </ul>
        <div id="comp-nav">
        <!--Loading all Compettitions Here -->
        </div>
        <div>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#compCreate">Turnier erstellen</button>
        </div>
      </div>

      <div class="col-sm-6 bg-warning" id="comp-main">
      </div>
     
      <div class="col-sm-3 ">
      </div>
      </div>
  </div>


    <!--MODAL FOR COMPETION CREATE !-->

    <div id="compCreate" class="modal fade" role="dialog">
      <div class="modal-dialog">


        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Neues Turnier</h4>
          </div>
          <div class="modal-body">
            <form role="form" action="#" id="createComp">
               <div class="form-group">
                <label for="name">Name*</label>
                <input class="form-control input-lg" id="name" type="text" name="Name" required>
              </div>
              
              <div class="form-group">
                <label for="date">Datum*</label>
                <input class="form-control input-lg" id="date" type="date" name="Datum" required>
              </div>

              <div class="form-group">
                <label for="Startzeit">Startzeit*</label></br>
                  <input class="form-control input-lg" list="Startzeit" name="Startzeit">
                    <datalist id="Startzeit">
                    <script type="text/javascript">
                      for(var i=1; i<25;i++){
                        document.write("<option value='"+i+":00'></option>");
                      }
                    </script>
                  </datalist>
              </div>

              <div class="form-group">
                <label for="ausschreibung">Ausschreibung (Link)</label>
                <input class="form-control input-lg" id="ausschreibung" type="text" name="Ausschreibung">
            </div>

            <div class="form-group">
                <label for="kommentar">Kommentare/Bemerkungen</label>
                 <textarea class="form-control" rows="5" id="Kommentar" name="Kommentar"></textarea>
            </div>
            </form>
          </div>
          <div class="modal-footer">
            <button id="create" type="button" class="btn btn-success">Erstellen</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
          </div>
        </div>

      </div>
    </div>


    <!-- INCLUDE BOOTSTRAP AND JQUERY -->
    <script src="JQuery/JQuery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="fkt.js"></script>

    <script type="text/javascript">
    //GLOBAL VARS
        //Wenn time auf 1 --> kommende Tuniere sonst vergangene
        var time = 1
        var currentID = 0;


    //FUNCTIONS
      var getComp = function(id, display){
          //if id is -1 select all comps else display specific competition
          $.post( "php/competition_get.php", {"action": "get", "time": time, "id":id} , function(data){
            $(display).html(data);

            if(id==-1){
              //After displaying all competitions in the left navigation container ---> save the ID of the active competition to display in the mainframe
              currentID = $("[id*=competition], active").attr("id").substring(11);
              getComp(currentID, "#comp-main");
            }
          });
        }

      var getPlayers = function(id){
          $.post( "php/getPlayers.php", {"id":id, "time":time} , function(data){            
            $("#comp-main").html(data);
          });
      }




      $(document).ready(function(){
        //ONCE AFTER LOADING
        //Load and Display first Entry of next Competitions
        getComp(-1, "#comp-nav");



        //EVENTS AFTER LOADING ---------------------------------------------------
        //eventhandler is body because the data is loaded via ajax and not there at page loading
        $('.modal').on('hidden.bs.modal', function(e){ 
          $(this).removeData();
        });
          


        $("body").on('click', '[id*=competition] ',function(e){ 
          e.preventDefault();
          $(".list-group-item").removeClass("active");
          $(this).toggleClass("active", 1);
          currentID = $(this).attr("id").substring(11);
          getComp(currentID, "#comp-main");
        });

        $("body").on('click', '#info', function(e){ 
          e.preventDefault();
          $("#info").addClass("active");
          $('#players').removeClass("active");
          getComp(currentID, "#comp-main");
        });

        $("body").on('click', '#players', function(e){ 
          e.preventDefault();
          $("#info").removeClass("active");
          $('#players').addClass("active");
          getPlayers(currentID);
        });

        $("body").on('click', '[id*=do]', function(e){ 
          e.preventDefault();
          //send ajax --> updates or sets new player
          console.log("Click");
          $.ajax( {type:"post", url:"php/addOrChangePlayer.php", async:false, data:{"Teilnahme": $(this).attr("id").substring(2), "UserID": getID(), "id":currentID} , success:function(data){
            console.log(data);
          }});
          getPlayers(currentID);
        });

        $("#come").click(function(){
          $("#come").addClass("active");
          $("#gone").removeClass("active");
          time = 1;
          getComp(-1, "#comp-nav");
        });

        $("#gone").click(function(){
          $("#gone").addClass("active");
          $("#come").removeClass("active");
          time = 0;
          getComp(-1, "#comp-nav");
        });

        $("#create").click(function(){
          if($("#createComp")[0].checkValidity()){

            var jsonData = $("#createComp").serializeObject();
            console.log(jsonData);
            $.post("php/newCompetition.php", {"data": JSON.stringify(jsonData)} , function(data){
              console.log(data);
              if(data === "success"){
                $("#compCreate").modal('hide');
                getComp(-1, "#comp-nav");
              }else{
                $("#suc-info").remove();
                $("#createComp").prepend("<div id='suc-info' class='alert alert-danger'>Es ist ein Fehler aufgetreten!</div>"); 
              }
            });

          }else{
            $("#suc-info").remove();
            $("#createComp").prepend("<div id='suc-info' class='alert alert-warning'>Bitte gebe alle erforderlichen Daten ein.</div>"); 
          }
        });
      });
    </script>
  </body>
</html>