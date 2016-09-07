        <?php
        $id = $_POST['id'];
        $nome_instituicao = utf8_decode($_POST['nome_instituicao']);
        $responsavel_instituicao = utf8_decode($_POST['responsavel_instituicao']);
        $endereco = utf8_decode($_POST['endereco']);
        $telefone = $_POST['telefone'];
        $email = utf8_decode($_POST['email']);
        $site = $_POST['site'];
        $evento = utf8_decode($_POST['evento']);
        $responsavel_evento = utf8_decode($_POST['responsavel_evento']);
        $contato_responsavel_evento = utf8_decode($_POST['contato_responsavel_evento']);
        $instituicao_parceira = utf8_decode($_POST['instituicao_parceira']);
        $data_evento = $_POST['data_evento'];
        /* $data_evento = implode("-", array_reverse(explode("/", $data_evento))); */
        $hora_evento = $_POST['hora_evento'];
        $local_evento = utf8_decode($_POST['local_evento']);
        $como_chegar = utf8_decode($_POST['como_chegar']);
        $descricao_evento = utf8_decode($_POST['descricao_evento']);
        $publico = utf8_decode($_POST['publico']);
        $legenda = utf8_decode($_POST['legenda']);
        $creditos = utf8_decode($_POST['creditos']);
        $foto = $_FILES['foto'];
        $estado = utf8_decode($_POST['estado']);
        $link = '';
        $erro = 0;

// Nome do evento n�o pode ser nulo
        if (($evento == "")) {
            echo "<script>alert('O nome do evento deve ser preenchido.');</script>";

            echo "<script>history.go(-1);</script>";
            $erro = 1;
        } elseif
// Respons�vel pelo evento n�o pode ser nulo
        (empty($responsavel_evento)) {
            echo "<script>alert('Informe quem &eacute; o respons&aacute;vel pelo evento.');</script>";

            echo "<script>history.go(-1);</script>";
            $erro = 1;
        } elseif
// Contato do respons�vel pelo evento n�o pode ser nulo
        (empty($contato_responsavel_evento)) {
            echo "<script>alert('Informe o contato do respons&aacute;vel pelo evento.');</script>";

            echo "<script>history.go(-1);</script>";
            $erro = 1;
        } elseif

// Validando e-mail
        (($email != "") and (substr_count($email, "@") == 0 || substr_count($email, ".") == 0)) {
            echo "<script>alert('Por favor, utilize um e-mail v&aacute;lido!');</script>";

            echo "<script>history.go(-1);</script>";
            $erro = 1;
        } elseif
// Email n�o pode ser nulo
        (empty($email)) {
            echo "<script>alert('O e-mail deve ser informado.');</script>";

            echo "<script>history.go(-1);</script>";
            $erro = 1;
        } elseif

// Validando a URL
        /* 	function validar_url($site) {
          return preg_match('|^http(s)?://[a-z0-9-]+(\.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $site);
          } */
        (($site != "") and (!preg_match('|^http(s)?://[a-z0-9-]+(\.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $site))) {
            echo "<script>alert('Por favor, digite uma URL v&aacute;lida!');</script>";

            echo "<script>history.go(-1);</script>";
            $erro = 1;
        } elseif

// Validando Telefone
        (($telefone != "") and !eregi("^\([0-9]{2}\) [0-9]{4}-[0-9]{4}$", $telefone)) {
            echo "<script>alert('Telefone inv&aacute;lido! Por favor, informe novamente.');</script>";

            echo "<script>history.go(-1);</script>";
            $erro = 1;
        } elseif

// Numero do telefone n�o pode ser nulo
        (empty($telefone)) {
            echo "<script>alert('O n�&uacute;mero do telefone deve ser informado.');</script>";

            echo "<script>history.go(-1);</script>";
            $erro = 1;
        } elseif

// Validando Hora
        (($hora_evento != "") and !ereg("^([0-1][0-9]|[2][0-3]):[0-5][0-9]$", $hora_evento)) {
            echo "<script>alert('Hora Inv&aacute;lida!');</script>";

            echo "<script>history.go(-1);</script>";
            $erro = 1;
        } elseif
// Hora do evento n�o pode ser nulo
        (empty($hora_evento)) {
            echo "<script>alert('Informe o hor&aacute;rio do evento.');</script>";

            echo "<script>history.go(-1);</script>";
            $erro = 1;
        } elseif

// Data do evento n�o pode ser nulo
        (empty($data_evento)) {
            echo "<script>alert('A data do evento deve ser informada!');</script>";

            echo "<script>history.go(-1);</script>";
            $erro = 1;
        } elseif
// Validando DATA
        /* function ValidaData($data_evento){
          $data = explode("/","$data_evento"); // fatia a string $dat em pedados, usando / como refer�ncia
          $d = $data[0];
          $m = $data[1];
          $y = $data[2];

          // verifica se a data � v�lida!
          // 1 = true (v�lida)
          // 0 = false (inv�lida)
          $res = checkdate($m,$d,$y);
          if ($res == 1){
          echo "data ok!";
          } else {
          echo "data inv�lida!";
          }
          } */

// Local do evento n�o pode ser nulo
        (empty($local_evento)) {
            echo "<script>alert('Informe o local do evento.');</script>";

            echo "<script>history.go(-1);</script>";
            $erro = 1;
        } elseif

// Descri��o do evento n�o pode ser nulo
        (empty($descricao_evento)) {
            echo "<script>alert('Por favor, informe a descri&ccedil;&atilde;o do evento.');</script>";

            echo "<script>history.go(-1);</script>";
            $erro = 1;
        } elseif

        // FOTOS - Se o usu�rio clicou no submit efetua as a��es
        // Se a foto estiver sido selecionada
        (!empty($foto["name"])) {

            // Largura m�xima em pixels
            $largura = 1000;
            // Altura m�xima em pixels
            $altura = 960;
            // Tamanho m�ximo do arquivo em bytes
            $tamanho = 2097152;

            // Pega as dimens�es da imagem
            $dimensoes = getimagesize($foto["tmp_name"]);

            // Verifica se o arquivo � uma imagem
            if (!preg_match("/^image\/(pjpeg|jpeg|jpg)$/", $foto["type"])) {
                $error[1];
                echo "<script>alert('Arquivo de imagem n&atilde;o &eacute; v&aacute;lido.');</script>";
                echo "<script>history.go(-1);</script>";
                $erro = 1;
            } elseif



            // Verifica se a largura da imagem � maior que a largura permitida
            ($dimensoes[0] > $largura) {
                $error[2];
                echo "<script>alert('A largura da imagem n&atilde;o deve ultrapassar " . $largura . " pixels');</script>";
                echo "<script>history.go(-1);</script>";
                $erro = 1;
            } elseif

            // Verifica se a altura da imagem � maior que a altura permitida
            ($dimensoes[1] > $altura) {
                $error[3];
                echo "<script>alert('Altura da imagem n&atilde;o deve ultrapassar " . $altura . " pixels');</script>";
                echo "<script>history.go(-1);</script>";
                $erro = 1;
            } elseif

            // Verifica se o tamanho da imagem � maior que o tamanho permitido
            ($foto["size"] > $tamanho) {
                $error[4];
                echo "<script>alert('A imagem deve ter no máximo " . $tamanho . " bytes');</script>";
                echo "<script>history.go(-1);</script>";
                $erro = 1;
            } elseif

            // Cr�ditos da foto n�o podem ser nulos
            ((empty($creditos))) {
                $error[5];
                echo "<script>alert('Informe os cr&eacute;ditos da fotografia.');</script>";

                echo "<script>history.go(-1);</script>";
                $erro = 1;
            } elseif

            // Se n�o houver nenhum erro
            (count($error) == 0) {

                // Pega extens�o da imagem
                preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

                // Gera um nome �nico para a imagem
                $nome_imagem = "foto" . md5(uniqid(time())) . "." . $ext[1];

                // Caminho de onde ficar� a imagem
                $caminho_imagem = "upload/" . $nome_imagem;

                // Faz o upload da imagem para seu respectivo caminho
                //move_uploaded_file($foto["tmp_name"], $caminho_imagem);


if ((($_FILES["foto"]["type"] == "image/gif")
|| ($_FILES["foto"]["type"] == "image/jpeg")
|| ($_FILES["foto"]["type"] == "image/pjpeg"))
&& ($_FILES["foto"]["size"] <= 2097152))
  {
  if ($_FILES["foto"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["foto"]["error"] . "<br />";
    }

  }
else
  {
  echo "Invalid file";
  }
  move_uploaded_file($foto["tmp_name"], $caminho_imagem);


                $dbc = mysqli_connect('localhost', 'userflu', 'userflu123', 'semanaflu2012')
                //$dbc = mysqli_connect('localhost', 'root', '', 'cadastrofiocruz')
                        or die('Error connecting to MySQL server.');

                $query = "INSERT INTO contato (id, nome_instituicao, responsavel_instituicao, endereco, telefone, email, site, evento, responsavel_evento, contato_responsavel_evento," .
                        "instituicao_parceira, data_evento, hora_evento, local_evento, como_chegar, descricao_evento, publico, legenda, creditos, foto) " .
                        "VALUES ('$id', '$nome_instituicao', '$responsavel_instituicao', '$endereco', '$telefone', '$email', '$site', '$evento', '$responsavel_evento', '$contato_responsavel_evento', " .
                        "'$instituicao_parceira', '$data_evento', '$hora_evento', '$local_evento', '$como_chegar', '$descricao_evento', '$publico', '$legenda', '$creditos', '$nome_imagem')";
// echo $query; exit;
                $result = mysqli_query($dbc, $query)
                        or die(mysqli_error($dbc));
                        //or die('Error querying database.');

                mysqli_close($dbc);

                echo "<script>alert('Obrigado por participar!');</script>";

                echo "<script>location.href='http://www.patrimoniofluminense.rj.gov.br/index.php?lang=br';</script>";

                // Insere os dados no banco
                /* 	$sql = "INSERT INTO contato (id, nome_instituicao, responsavel_instituicao, endereco, telefone, email, site, evento, responsavel_evento, contato_responsavel_evento," .
                  "instituicao_parceira, data_evento, hora_evento, local_evento, como_chegar, descricao_evento, publico, legenda, creditos, foto) " .
                  "VALUES ('$id', '$nome_instituicao', '$responsavel_instituicao', '$endereco', '$telefone', '$email', '$site', '$evento', '$responsavel_evento', '$contato_responsavel_evento', " .
                  "'$instituicao_parceira', '$data_evento', '$hora_evento', '$local_evento', '$como_chegar', '$descricao_evento', '$publico', '$legenda', '$creditos', '$nome_imagem')";
                 */

                // Se os dados forem inseridos com sucesso
                /* if ($sql){
                  echo "Foto inclu�da com sucesso.";
                  } */
            }

            // Se houver mensagens de erro, exibe-as
            /* if (count($error) != 0) {
              foreach ($error as $erro) {
              echo $erro . "<br />";
              }
              } */
        } elseif ($erro == 0) {
            $dbc = mysqli_connect('localhost', 'userflu', 'userflu123', 'semanaflu2012')
            //$dbc = mysqli_connect('localhost', 'root', '', 'cadastrofiocruz')
                    or die('Error connecting to MySQL server.');

            $query = "INSERT INTO contato (id, nome_instituicao, responsavel_instituicao, endereco, telefone, email, site, evento, responsavel_evento, contato_responsavel_evento," .
                    "instituicao_parceira, data_evento, hora_evento, local_evento, como_chegar, descricao_evento, publico, legenda, creditos, foto, estado) " .
                    "VALUES (NULL, '$nome_instituicao', '$responsavel_instituicao', '$endereco', '$telefone', '$email', '$site', '$evento', '$responsavel_evento', '$contato_responsavel_evento', " .
                    "'$instituicao_parceira', '$data_evento', '$hora_evento', '$local_evento', '$como_chegar', '$descricao_evento', '$publico', '$legenda', '$creditos', '$foto', '$estado')";


            $result = mysqli_query($dbc, $query)
                    or die('Error querying database.');

            mysqli_close($dbc);

            echo "<script>alert('Obrigado por participar!');</script>";

            echo "<script>location.href='http://www.patrimoniofluminense.rj.gov.br/';</script>";
        }
        ?>
