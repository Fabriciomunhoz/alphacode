<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Contatos</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
</head>
<body>
    <div class="titulo">
        <a href="">
            <img src="../assets/logo_alphacode.png" alt="Logo AlphaCode">
        </a>
        <h2 class="">Cadastro de Contatos</h2>
    </div>
    <br>
    <div class="container">
        <form action="index.php?action=create" method="POST">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="lbl-input" for="nome_completo">Nome Completo</label>
                    <input type="text" class="form-control input-bottom-only" id="nome_completo" name="nome_completo"
                        placeholder="Ex.: Letícia Pacheco dos Santos" required>
                </div>
                <div class="col-md-6">
                    <label class="lbl-input" for="data_nascimento">Data de nascimento</label>
                    <input type="date" class="form-control input-bottom-only" id="data_nascimento"
                        name="data_nascimento" placeholder="Ex.: 03/10/2003" required>
                </div>
                <div class="col-md-6">
                    <label class="lbl-input" for="email">E-mail</label>
                    <input type="email" class="form-control input-bottom-only" id="email" name="email"
                        placeholder="Ex.: leticia@gmail.com" required>
                </div>
                <div class="col-md-6">
                    <label class="lbl-input" for="profissao">Profissão</label>
                    <input type="text" class="form-control input-bottom-only" id="profissao" name="profissao"
                        placeholder="Ex.: Desenvolvedor Web">
                </div>
                <div class="col-md-6">
                    <label class="lbl-input" for="telefone">Telefone</label>
                    <input type="text" class="form-control input-bottom-only" id="telefone" name="telefone"
                        placeholder="Ex.: (11) 4033-2019">
                </div>
                <div class="col-md-6">
                    <label class="lbl-input" for="celular">Celular</label>
                    <input type="text" class="form-control input-bottom-only" id="celular" name="celular"
                        placeholder="(11) 98493-2039">
                </div>
                <div class="col-md-6">
                    <input type="checkbox" class="form-check-input" id="celular_possui_whatsapp"
                        name="celular_possui_whatsapp">
                    <label class="form-check-label" for="celular_possui_whatsapp">Celular possui WhatsApp</label>
                </div>
                <div class="col-md-6">
                    <input type="checkbox" class="form-check-input" id="notificacao_email" name="notificacao_email">
                    <label class="form-check-label" for="notificacao_email">Notificar por Email</label>
                </div>
                <div class="col-md-3">
                    <input type="checkbox" class="form-check-input" id="notificacao_sms" name="notificacao_sms">
                    <label class="form-check-label" for="notificacao_sms">Notificar por SMS</label>
                </div>
            </div>
            <br>
            <div class="text-end">
                <button type="submit" class="btn btn-primary btn-cadastro">Cadastrar Contato</button>
            </div>
        </form>
        <h2 class="my-4">Contatos Cadastrados</h2>
        <table class="table">
            <thead>
                <tr>
                    <th class="lista-cabeca">Nome Completo</th>
                    <th class="lista-cabeca">Data de Nascimento</th>
                    <th class="lista-cabeca">E-mail</th>
                    <th class="lista-cabeca">Celular para contato</th>
                    <th class="lista-cabeca">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($contact['nome_completo']); ?></td>
                        <td><?php $date = new DateTime($contact['data_nascimento']);
                        echo htmlspecialchars($date->format('d/m/Y'));
                        ?></td>
                        <td><?php echo htmlspecialchars($contact['email']); ?></td>
                        <td>
                            <?php
                            $phoneNumber = preg_replace('/\D/', '', $contact['celular']);
                            if (strlen($phoneNumber) == 11) {
                                echo '(' . substr($phoneNumber, 0, 2) . ') ' . substr($phoneNumber, 2, 5) . '-' . substr($phoneNumber, 7);
                            } else {
                                echo htmlspecialchars($contact['celular']);
                            }
                            ?>
                        </td>
                        <td>
                            <a href="update.php?id=<?php echo $contact['id']; ?>" class="btn btn-sm">
                                <img src="../assets/editar.png" alt="Editar" style="width: 16px; height: 16px;">
                            </a>
                            <a class="btn btn-sm" onclick="confirmDelete(<?php echo $contact['id']; ?>)">
                                <img src="../assets/excluir.png" alt="Deletar" style="width: 16px; height: 16px;">
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include 'update.php'; ?>
    <footer class="footer mt-auto py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <a href="#">Termos | Políticas</a>
                </div>
                <div class="col-md-4 text-center">
                    <span>&copy; 2022 Desenvolvido por <a href=""> <img src="../assets/logo_rodape_alphacode.png"
                                alt="Logo" style="width: 100px;"></a></span>
                </div>
                <div class="col-md-4 text-right">
                    <span>@Alphacode IT Solutions 2022</span>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="./js/script.js"></script>
</body>
</html>