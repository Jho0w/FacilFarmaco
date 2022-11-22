<?php


function exportcsv(){
    
include('config.php');

    @unlink("export.csv");

    $filename = "export.csv";
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

   if (!file_exists("export.csv"))
   die('Arquivo não existe!');

    header('Content-type: octet/stream');

    // Indica o nome do arquivo como será "baixado". Você pode modificar e colocar qualquer nome de arquivo
    header('Content-disposition: attachment; filename="'.$filename.'";'); 

    // Indica ao navegador qual é o tamanho do arquivo
    //header('Content-Length: '.filesize($caminho_download));

    // Busca todo o arquivo e joga o seu conteúdo para que possa ser baixado
    readfile($filename);

    exit;

}


?>