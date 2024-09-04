<?php
require_once '../app/models/Contact.php'; // Inclua o modelo de contato
require_once '../config.php'; // Inclua a configuração do banco de dados
$db = getDB(); 
$contactModel = new Contact($db);
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $contact = $contactModel->getContactById($id);
    if ($contact) {
        ?>
        <div class="container">
        <form action="index.php?action=update" method="POST">
            <input type="hidden" name="id" value="<?php echo $contact['id']; ?>">
            <div class="form-group">
                <label class="lbl-input" for="nome_completo">Nome Completo</label>
                <input type="text" class="form-control input-bottom-only" id="nome_completo" name="nome_completo" value="<?php echo htmlspecialchars($contact['nome_completo']); ?>" required>
            </div>
            <div class="form-group">
                <label class="lbl-input" for="data_nascimento">Data de Nascimento</label>
                <input type="date" class="form-control input-bottom-only" id="data_nascimento" name="data_nascimento" value="<?php echo $contact['data_nascimento']; ?>" required>
            </div>
            <div class="form-group">
                <label class="lbl-input" for="email">E-mail</label>
                <input type="email" class="form-control input-bottom-only" id="email" name="email" value="<?php echo htmlspecialchars($contact['email']); ?>" required>
            </div>
            <div class="form-group">
                <label class="lbl-input" for="profissao">Profissão</label>
                <input type="text" class="form-control input-bottom-only" id="profissao" name="profissao" value="<?php echo htmlspecialchars($contact['profissao']); ?>">
            </div>
            <div class="form-group">
                <label class="lbl-input" for="telefone">Telefone</label>
                <input type="text" class="form-control input-bottom-only" id="telefone" name="telefone" value="<?php echo htmlspecialchars($contact['telefone']); ?>">
            </div>
            <div class="form-group">
                <label class="lbl-input" for="celular">Celular</label>
                <input type="text" class="form-control input-bottom-only" id="celular" name="celular" value="<?php echo htmlspecialchars($contact['celular']); ?>">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="celular_possui_whatsapp" name="celular_possui_whatsapp" <?php echo $contact['celular_possui_whatsapp'] ? 'checked' : ''; ?>>
                <label class="form-check-label" for="celular_possui_whatsapp">Celular possui WhatsApp</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="notificacao_email" name="notificacao_email" <?php echo $contact['notificacao_email'] ? 'checked' : ''; ?>>
                <label class="form-check-label" for="notificacao_email">Notificar por Email</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="notificacao_sms" name="notificacao_sms" <?php echo $contact['notificacao_sms'] ? 'checked' : ''; ?>>
                <label class="form-check-label" for="notificacao_sms">Notificar por SMS</label>
            </div>
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
        </div>
        <?php
    } else {
        echo 'Contato não encontrado.';
    }
} else {
}
?>
