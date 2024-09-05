<?php
class Contact
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Método para obter todos os contatos
    public function getAllContacts()
    {
        $query = "SELECT * FROM cadastro";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function getNextId()
    {
        $query = "SELECT MAX(id) as max_id FROM cadastro";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

    
        if ($result && isset($result['max_id'])) {
            return $result['max_id'] + 1;
        }


        return 1;
    }



    public function addContact($data)
    {
        $data['celular_possui_whatsapp'] = isset($data['celular_possui_whatsapp']) ? true : false;
        $data['notificacao_email'] = isset($data['notificacao_email']) ? true : false;
        $data['notificacao_sms'] = isset($data['notificacao_sms']) ? true : 
        $nextId = $this->getNextId();
        $query = "INSERT INTO cadastro (id, nome_completo, data_nascimento, email, profissao, telefone, celular, celular_possui_whatsapp, notificacao_email, notificacao_sms) 
              VALUES (:id, :nome_completo, :data_nascimento, :email, :profissao, :telefone, :celular, :celular_possui_whatsapp, :notificacao_email, :notificacao_sms)";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':id', $nextId, PDO::PARAM_INT);
        $stmt->bindParam(':nome_completo', $data['nome_completo']);
        $stmt->bindParam(':data_nascimento', $data['data_nascimento']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':profissao', $data['profissao']);
        $stmt->bindParam(':telefone', $data['telefone']);
        $stmt->bindParam(':celular', $data['celular']);
        $stmt->bindParam(':celular_possui_whatsapp', $data['celular_possui_whatsapp'], PDO::PARAM_BOOL);
        $stmt->bindParam(':notificacao_email', $data['notificacao_email'], PDO::PARAM_BOOL);
        $stmt->bindParam(':notificacao_sms', $data['notificacao_sms'], PDO::PARAM_BOOL);

        return $stmt->execute();
    }

    function formatPhoneNumber($number)
    {
         $number = preg_replace('/\D/', '', $number);
         if (strlen($number) == 11) {
             // Formata como (xx) xxxxx-xxxx
             return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $number);
         }
         return $number;
    }
    public function getContactById($id)
    {
        $query = "SELECT * FROM cadastro WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $contact = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($contact) {
            $date = new DateTime($contact['data_nascimento']);
            $contact['data_nascimento'] = $date->format('d/m/Y');

        }
        return $contact;
    }
    public function updateContact($data)
    {
        $query = "UPDATE cadastro SET
                    nome_completo = :nome_completo,
                    data_nascimento = :data_nascimento,
                    email = :email,
                    profissao = :profissao,
                    telefone = :telefone,
                    celular = :celular,
                    celular_possui_whatsapp = :celular_possui_whatsapp,
                    notificacao_email = :notificacao_email,
                    notificacao_sms = :notificacao_sms
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
        $stmt->bindParam(':nome_completo', $data['nome_completo']);
        $stmt->bindParam(':data_nascimento', $data['data_nascimento']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':profissao', $data['profissao']);
        $stmt->bindParam(':telefone', $data['telefone']);
        $stmt->bindParam(':celular', $data['celular']);
        $stmt->bindParam(':celular_possui_whatsapp', $data['celular_possui_whatsapp'], PDO::PARAM_INT);
        $stmt->bindParam(':notificacao_email', $data['notificacao_email'], PDO::PARAM_INT);
        $stmt->bindParam(':notificacao_sms', $data['notificacao_sms'], PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function deleteContact($id)
    {
        $query = "DELETE FROM cadastro WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
