<?php


function exportcsvMedicamento(){
    
include('config.php');

    @unlink("exportMedicamento.csv");

    $filename = "exportMedicamento.csv";
    $handle = fopen ($filename ,'a+');

    $query = "SELECT *
    FROM medicamento 
    INNER JOIN classe ON medicamento.id_classe = classe.id_classe
    WHERE id_med > 0 AND medicamento.ativo=1 ";
    $result = mysqli_query($con, $query);

    while ($coluna=mysqli_fetch_array($result)) {

        $id_med = $coluna['id_med'];
        $nome_med = $coluna['nome_med'];
        $nome_classe = $coluna['nome_classe'];

    
        $exportacao = $id_med.";".$nome_med.";".$nome_classe.";"."\r\n";
        fwrite($handle, $exportacao);
    }

   
   fclose($handle);

   if (!file_exists("exportMedicamento.csv"))
   die('Arquivo não existe!');

    header('Content-type: octet/stream');
    // Indica o nome do arquivo como será "baixado". Você pode modificar e colocar qualquer nome de arquivo
    header('Content-disposition: attachment; filename="'.$filename.'";'); 
    // Busca todo o arquivo e joga o seu conteúdo para que possa ser baixado
    readfile($filename);

    exit;
}

function exportcsvClasse(){
    
    include('config.php');
    
    @unlink("exportClasse.csv");

    $filename = "exportClasse.csv";
    $handle = fopen ($filename ,'a+');

    $query = "SELECT * FROM classe WHERE id_classe > 0 AND ativo = 1";
    $result = mysqli_query($con, $query);

    while ($coluna=mysqli_fetch_array($result)) {

        $id_classe = $coluna['id_classe'];
        $nome_classe = $coluna['nome_classe'];
        $funcao = $coluna['funcao'];
        $quando = $coluna['quando'];
        $como = $coluna['como'];

    
        $exportacao = $id_classe.";".$nome_classe.";".$funcao.";".$quando.";".$como."\r\n";
        fwrite($handle, $exportacao);
    }

    
    fclose($handle);

    if (!file_exists("exportClasse.csv"))
    die('Arquivo não existe!');

    header('Content-type: octet/stream');
    // Indica o nome do arquivo como será "baixado". Você pode modificar e colocar qualquer nome de arquivo
    header('Content-disposition: attachment; filename="'.$filename.'";'); 
    // Busca todo o arquivo e joga o seu conteúdo para que possa ser baixado
    readfile($filename);

    exit;
}

function exportcsvUsuario(){
    
    include('config.php');
    
    @unlink("exportUsuario.csv");

    $filename = "exportUsuario.csv";
    $handle = fopen ($filename ,'a+');

    $query = "SELECT * FROM usuario WHERE id_user > 0 AND ativo = 1";
    $result = mysqli_query($con, $query);

    while ($coluna=mysqli_fetch_array($result)) {

        $id_user = $coluna['id_user'];
        $nome = $coluna['nome'];
        $login = $coluna['login'];

        if($coluna['perfil'] == 1){
            $admin = 'Administrador';
        } else{
            $admin = 'Usuário';
        }

    
        $exportacao = $id_user.";".$nome.";".$login.";".$admin."\r\n";
        fwrite($handle, $exportacao);
    }

    
    fclose($handle);

    if (!file_exists("exportUsuario.csv"))
    die('Arquivo não existe!');

    header('Content-type: octet/stream');
    // Indica o nome do arquivo como será "baixado". Você pode modificar e colocar qualquer nome de arquivo
    header('Content-disposition: attachment; filename="'.$filename.'";'); 
    // Busca todo o arquivo e joga o seu conteúdo para que possa ser baixado
    readfile($filename);

    exit;
}

?>