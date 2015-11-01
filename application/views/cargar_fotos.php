<br>
<br>
<br>
<div class="row">
    <div class="col-md-3">

    </div>
    <div class="col-md-6">

        <br>
        <div class="panel panel-info">

            <div class="panel-heading">
                <span class="pull-right"><a href='<?php echo site_url()?>/departamento/'><i class="fa fa-arrow-left"></i><b> Volver</b></a></span>
                <h3 class="centrado"><b>Subir Fotos departamento</b></h3>
            </div>

            <div class="panel-body">

                <h2>Seleccione Archivos desde su computadora</h2>
          <?php echo form_open_multipart('upload/do_upload/'.$id_departamento); ?>
            <div class="form-inline">
              <div class="form-group">
                <input type="file" name="files[]" id="files" multiple="" >
              </div>
              
             <input class="btn btn-primary form-control" type="submit" value="Subir Fotos" />
            </div>
          </form>
               
            </div>
        </div>
    </div>
</div>