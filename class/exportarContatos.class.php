<?php
   $arquivo = 'contatos_whatsapp_via_site.xls';
    header("Content-type: text/html; charset=ISO-8859-1");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename={$arquivo}");
    header("Content-Description: PHP Generated Data");

    require_once 'accessoExportar.class.php';
    $acs = new Acesso();
    $acs->ctrlAcesso();


if($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once 'user.class.php';

    $query;

    $tipo = isset($_POST['modelo']) && $_POST['modelo'] != '' ? addslashes( $_POST['modelo'] ) : null;

    $dataInicial = isset($_POST['dataInicial']) && $_POST['dataInicial'] != '' ?
                    implode( '-', array_reverse( explode( '/', addslashes( $_POST['dataInicial'] ) ) ) ) .' 00:00:00' :
                    null;

    $dataFinal = isset($_POST['dataFinal']) && $_POST['dataFinal'] != '' ?
                    implode( '-', array_reverse( explode( '/', addslashes( $_POST['dataFinal'] ) ) ) ) .' 00:00:00' :
                    null;


    if($tipo != null && $tipo == 'data')
    {
        if($dataFinal !== null)
        {
            if($dataFinal == $dataInicial){
                $query = "WHERE data BETWEEN '" . $dataInicial . "' AND '" . str_replace(" 00:00:00", "", $dataFinal) . " 23:59:59'";
            }else{
                $query = "WHERE data BETWEEN '" . $dataInicial . "' AND '" . $dataFinal . "'";
            }

        }else
        {
            $query = "WHERE data >= '" . $dataInicial . "'";
        }
    }else{
        $query = 'all';
    }


    $users = new Usuarios();
    $totalUser = $users->buscarRegistros($query);

    $attrStlHead = "background:#2A2D3B;padding: 25px;color:#ffffff;font-size:16px;font-weight:bold;border:#f9f9f9 solid 1px;display: table-cell;";
    $attrStlC = "text-align:center;";
    $celAjuste = "padding: 25px; border:#f9f9f9 solid 1px;vertical-align: middle;display: table-cell;";

    echo '<table cellpadding="10">
            <thead>
                <tr height="40">
                    <th colspan="6" style="vertical-align: middle;text-align:center;">
                        <h2>Relat&oacute;rio de Contatos (WhatsApp)</h2>
                    </th>
                </tr>
                <tr>
                    <th style=" ' . $attrStlHead.$attrStlC  . ' ">ID</th>
                    <th style=" ' . $attrStlHead.$attrStlC  . ' ">Data</th>
                    <th style=" ' . $attrStlHead  . ' ">Nome</th>
                    <th style=" ' . $attrStlHead  . ' ">Email</th>
                    <th style=" ' . $attrStlHead.$attrStlC  . ' ">Telefone</th>
                    <th style=" ' . $attrStlHead  . ' ">Mensagem</th>';
    echo        '</tr>
            </thead>
            <tbody>';

    $i = 0;
    foreach ($totalUser as $user) {
        if($i % 2 == 0){
            $rowStyle = "background-color:#EAEAEA;";
        }else{
            $rowStyle = "";
        }
        echo ' <tr style="height:40px; '. $rowStyle .'">
                    <td style=" ' . $celAjuste.$attrStlC  . ' ">'.$user->id.'</td>
                    <td style=" ' . $celAjuste.$attrStlC  . ' ">'.$user->data.'</td>
                    <td style=" ' . $celAjuste . ' ">'.$user->nome.'</td>
                    <td style=" ' . $celAjuste . ' ">'.$user->email.'</td>
                    <td style=" ' . $celAjuste.$attrStlC  . ' ">'.$user->telefone.'</td>
                    <td style=" ' . $celAjuste . ' ">'.$user->mensagem.'</td>';
        echo   '</tr>';
        $i++;
    }

    echo    '</tbody>
        </table>';

}else{
    header('Location: /');
}
