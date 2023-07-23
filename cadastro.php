<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <?php 
    $servidor = "localhost";
    $user = "Dns";
    $passoword = "123456";
    $bd = "cadlogin";

    $conn = new mysqli ($servidor,$user,$passoword,$bd);

    if(!$conn){

        echo "<p style='color:red; text-aling:center; font-size:25px;'>Erro de conexão!</p>";
    }

    //verifica se o formulario foi submetido.
    if($_SERVER["REQUEST_METHOD"] =="POST"){
        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];
        $confirmasenha = $_POST["confirmasenha"];

        //verificar se a senha e igual.

        if($senha === $confirmasenha){
            $sql = "SELECT * FROM usuario WHERE usuario = 'usuario'";
            $retorno = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($retorno);

            if($row){
                echo "<p style='color:red; text-aling:center; font-size:25px;'>Usuario já existe!</p>";
            }else{
                $hashsenha = password_hash($senha, PASSWORD_BCRYPT);
                $sql = "INSERT INTO usuario (usuario, senha) values ('$usuario', '$hashsenha')";
                $retorno = mysqli_query($conn, $sql);

                if($retorno === true){
                    echo "<p style='color:green; text-aling:center; font-size:25px;'>Cadastro realizado!</p>";
                }else{
                    echo "Erro ao cadastrar o usuario:". $conn->error;

                }
            }
        }else{
            echo "<p style='color:blue; text-aling:center; font-size:25px;'>As senhas nao sao iguais!</p>";
        }
    }

    $conn->close();

    ?>
</body>
</html>