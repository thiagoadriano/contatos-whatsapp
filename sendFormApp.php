<?php
function isValid($array){
  $countArray = count($array);
  for($i = 0; $i < $countArray; $i++){
      if($array[$i] == "" || $array[$i] == null){
          return false;
      }
  }
  return true;
}


function getInput($input){
  return $_GET[$input] <> "" ? $_GET[$input] : null ;
}


if($_SERVER['REQUEST_METHOD'] == "GET")
{
  $nome      =  getInput('nomeApp');
  $email     =  getInput('emailApp');
  $telefone  =  getInput('telefoneApp');
  $mensagem  =  getInput('msgApp');

  $url = 'http://www.coachfinanceiro.com';
  $quemEnvia    = array('Contato', 'contato@coachfinanceiro.com');
  $RecebeEmails = array('Gerencia', 'gerencia@coachfinanceiro.com');
  //$RecebeEmails = array('Thiago', 'thiago.s.adriano@gmail.com');
  $assEmail   = $nome . ", seu contato foi enviado com sucesso"; 


  if( isValid($nome, $email, $telefone) ){
    require_once '_mensagemEmail.php';
    require_once 'lib/phpmailer/class.phpmailer.php';
    require_once 'class/user.class.php';

    $mail = new PHPMailer();
    $mail->isMail(true);
    $mail->isHTML(true);
    $mail->CharSet = "UTF-8";
    $mail->SetFrom($quemEnvia[1], $quemEnvia[0]);
    $mail->AddBCC($RecebeEmails[1], $RecebeEmails[0]);
    $mail->AddAddress($email, $nome);
    $mail->Subject = $assEmail;
    $mail->MsgHTML( $conteudo );

    $db = new Usuarios();
    $db->insert();

    if($mail->Send()){
      echo json_encode( array("valid" => true, "mensagem" => "Contato enviado com sucesso") );
    }else{
      echo json_encode( array("valid" => false, "mensagem" => "Erro ao enviar. Tente mais tarde", "console" => $mail->ErrorInfo) );
    }

  }else{
    echo json_encode( array("valid" => false, "mensagem" => "A campo obrigatório vazio") );
  }


}else{
	echo json_encode( array("valid" => false, "mensagem" => "Metodo errado") );
}

?>
