
<?php echo validation_errors(); ?>
<?php echo form_open('login/add_all'); ?>
        <label for="f_state">State<span class="red">*</span></label>

        <select id="f_state" name="f_state"  class="form-control">
             <?php foreach ($states as $item) { //item es el nombre de la variable para poder acceder a los datos "usuario" que vienen del controlador "welcome"
                        ?>

                        <OPTION VALUE='<?php echo $item["CODIGO_TIPO"]?>'><?php echo $item["NOMBRE_TIPO"]?></OPTION>

                    <?php } ?>
            
        </select>

        <label for="f_city">City<span class="red">*</span></label>
        <!--this will be filled based on the tree selection above-->
        <select id="f_city" name="f_city"  class="form-control"> 
            <option  value=""></option>
        </select>
        <label for="f_membername">Member Name<span class="red">*</span></label>

        <label for="f_dato">City<span class="red">*</span></label>
        <!--this will be filled based on the tree selection above-->
        <select id="f_dato" name="f_dato" class="form-control"> 
            <option  value=""></option>
        </select>

      <div class="row col-md-offset-1" id="contenido">
        <table class="table table-bordered table-striped"  id="tableDeposits">

            <!--usar codigo tabla tbody para hacer filtro de datos cargaos con la jquery -->
        </table>
    </div>
        <!--<input type="text" name="f_membername"/>-->
<?php echo form_close(); ?> 

<script> //PRIMER COMBO BOX
        $('#f_city').hide();
        $('#f_state').change(function(){
            var state_id = $('#f_state').val();
            if (state_id != ""){
                var post_url = "<?php echo base_url(); ?>/index.php/login/get_cities/" + state_id;
                $.ajax({
                    data: {id: state_id},
                    type: "POST",
                     url: post_url,
                     success: function(cities) //we're calling the response json array 'cities'
                      {
                        $('#f_city').empty();
                        $('#f_city').show();
                           $.each(cities,function(id,city) 
                           {
                            var opt = $('<option/>'); // here we're creating a new select option for each group
                              opt.val(city.ID_DEPARTAMENTO);
                              opt.text(city.ID_DEPARTAMENTO);
                              $('#f_city').append(opt); 
                        });
                       } //end success
                 }); //end AJAX
            } else {
                $('#f_city').empty();
                $('#f_city').hide();
            }//end if
        }); //end change 

</script>

<script>//SEGUNDO COMBO BOX
        $('#tableDeposits').hide();
        $('#f_city').change(function(){
            var DATO_id = $('#f_city').val();
            if (DATO_id != ""){
                var post_url = "<?php echo base_url(); ?>/index.php/login/get_deptos/" + DATO_id;
                $.ajax({
                    data: {id: DATO_id},
                    type: "POST",
                     url: post_url,
                     success: function(cities) //we're calling the response json array 'cities'
                      {
                        $('#tableDeposits').empty();
                        $('#tableDeposits').show();
                           $.each(cities,function(id,city) 
                           {
                           // var opt = $('</option>'); // here we're creating a new select option for each group
                              //opt.val(DATO_id);
                              //opt.text(city.NUMERO_DEPARTAMENTO);
                              //$('#f_dato').append(opt); 
                              //$('#tableDeposits').append('<tr>');
                              //$('#tableDeposits').append('<td>');
                              //$('#tableDeposits').append(city.ID_DEPARTAMENTO);
                              //$('#tableDeposits').append('</td>');
                              //$('#tableDeposits').append('<td>');
                              //$('#tableDeposits').append(city.ID_DEPARTAMENTO);
                              //$('#tableDeposits').append('</td>');
                              //$('#tableDeposits').append('</tr>');
                               var url ="/Encargo/create?id="+city.ID_DEPARTAMENTO;
                                $("#tableDeposits").append("<tr><th> Numero Piso </th> <th> Precio</th> <th>Descripcion</th></tr>");

                               $("#tableDeposits").append("<td><a href="+url+">"+city.NUMERO_PISO+"</a><td>"+city.PRECIO+"<td>"+city.DESCRIPCION);
                        });
                       } //end success
                 }); //end AJAX
            } else {
                $('#f_dato').empty();
                $('#f_dato').hide();
            }//end if
        }); //end change 

</script>


