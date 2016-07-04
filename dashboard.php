<?php
    require_once 'class/accessoExportar.class.php';
    $acs = new Acesso();
    $acs->ctrlAcesso();
    
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include './inc/_head.tpl'; ?> 
    </head>

    <body>
        <div class="container">
            <div class="row" style="background: #D4D3D3;padding: 15px;">
                <div class="col-sm-3 col-sm-offset-8">
                    <h4>Usuário Logado: <strong style="text-transform: capitalize;"><?php echo $_SESSION['Usuario']["login"]; ?></strong></h4>
                </div>
                <div class="col-sm-1">
                    <form action="logout.php" >
                        <button type="submit" class="btn btn-primary btn-sm btn-block"><span class="glyphicon glyphicon-off"></span> Sair</button>
                    </form>
                </div>
            </div>
            <h3>Selecione como irá exportar</h3>
            <div class="jumbotron">
                <form action="class/exportarContatos.class.php" name="" id="formExport" method="POST">
                    <div class="row">
                        <div class="checkbox-inline">
                            <label style="cursor: pointer">
                                <input type="radio" id="todos" name="modelo" value="all" checked="true">
                                Todos os Registros
                            </label>
                        </div>
                        <div class="checkbox-inline">
                            <label style="cursor: pointer">
                                  <input type="radio" id="porData" name="modelo" value="data">
                                  Por data
                              </label>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div id="sandbox-container" style="position: relative">
                            <div class="col-sm-6">
                                <label for="dataInicial" class="control-label">Data Inicial:</label>
                                <div class="input-group date">
                                    <input type="text" name="dataInicial" id="dataInicial" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="dataFinal" class="control-label">Data Final:<small><em>(opcional)</em></small></label>
                                <div class="input-group date">
                                    <input type="text" name="dataFinal" id="dataFinal" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    
                    <div class="row">
                        <br>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                              <span id="erro" style="display: none;color: #B10303;font-size: 16px;margin: 10px;">
                                  <span class="glyphicon glyphicon-remove-sign"></span> Escolha uma data inicial para exportar.</span>
                              <span id="erroData" style="display: none;color: #B10303;font-size: 16px;margin: 10px;">
                                  <span class="glyphicon glyphicon-remove-sign"></span> Data final tem que ser maior que a data inicial</span>

                              <button type="submit" class="btn btn-primary btn-block" id="exportar"><span class="glyphicon glyphicon-save"></span> Exportar</button>
                            </div>
                        </div>
                    </div>
                    
                </form>
                   
            </div>
        </div>

        <script src="assets/js/jquery-1.11.3.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap-datepicker.min.js"></script>
        <script src="assets/js/bootstrap-datepicker.pt-BR.min.js"></script>
        <script src="assets/js/main.js"></script>
        
    </body>
</html>