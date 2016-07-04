<?php
    require_once 'class/accessoExportar.class.php';
    $acs = new Acesso();
    $acs->checkUser();
    $acs->login();
?>
<!DOCTYPE html>
<html>
<head>
    <?php include './inc/_head.tpl'; ?> 
    <style type="text/css">
        .title{
            margin-top: 0;
            padding: 15px;
            background: #005898;
            width: 150%;
            margin-left: -60px;
            text-align: center;
            font-weight: 700;
            color: #fff;
        }
    </style>
</head>

<body>

<div class="container">
    <?php
        $acs->informativoLogin();
    ?>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="jumbotron" style="margin-top: 35px;">
                <h3 class="title">Acesso Restrito</h3>
                <?php 
                    $acs->displayErr();
                ?>
                <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                    <label for="">Digite o Usuário</label>
                     <div class="input-group">
                         <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                        <input type="text" name="user" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Digite a Senha</label>
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                        <input type="password" class="form-control" name="passUser"/>
                    </div>
                </div>
                    <input type="submit" class="btn btn-success btn-block btn-lg" value="Acessar"/>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-md-offset-5">
            <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>" class="btn btn-sm btn-primary btn-block">Voltar ao Site</a>
        </div>
    </div>
</div>


</body>
</html>