<?php
// 1. Configurações via Variáveis de Ambiente (Segurança e Portabilidade)
$host = getenv('DB_HOST') ?: '127.0.0.1';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';
$db   = getenv('DB_NAME') ?: 'meu_banco';

// 2. Identificação do Container (Para provar o Load Balancing)
$node_name = gethostname();
// Gera uma cor única para cada container baseada no seu nome
$bg_color = substr(md5($node_name), 0, 6); 

// 3. Conexão com tratamento de erro real
mysqli_report(MYSQLI_REPORT_OFF); // Evita expor detalhes internos se falhar
$link = mysqli_connect($host, $user, $pass, $db);

if (!$link) {
    die("<body style='background:#fdd'><h1>Erro de Conexão:</h1><p>" . mysqli_connect_error() . "</p></body>");
}

// 4. Lógica simplista mantida
$valor_rand1 =  rand(1, 999);
$valor_rand2 = strtoupper(substr(bin2hex(random_bytes(4)), 1));
$query = "INSERT INTO dados (id, nome, valor) VALUES ('$valor_rand1' , '$valor_rand2', '$valor_rand1')";

$res = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>PoC Load Balancer</title>
    <style>
        body { 
            font-family: sans-serif; 
            text-align: center; 
            padding-top: 50px;
            background-color: #<?php echo $bg_color; ?>22; /* Cor suave baseada no container */
        }
        .container-info { 
            border: 2px solid #<?php echo $bg_color; ?>; 
            display: inline-block; padding: 20px; border-radius: 10px;
            background: white;
        }
    </style>
</head>
<body>
    <div class="container-info">
        <h1>Node: <?php echo $node_name; ?></h1>
        <p>Status da Inserção: <strong><?php echo $res ? "Sucesso" : "Falha"; ?></strong></p>
        <p>Dados: ID(<?php echo $valor_rand1; ?>) | Valor(<?php echo $valor_rand2; ?>)</p>
    </div>
</body>
</html>