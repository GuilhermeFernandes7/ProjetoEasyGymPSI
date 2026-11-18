# ProjetoEasyGymPSI

# Easy Gym Leiria - PLSI (Fase 1)

Grupo: [Guilherme Fernandes - nº2024144331] 

## Requisitos
PHP 8.x, MySQL 8, Apache com mod_rewrite (WAMP).

## Instalação
1. Extrair o ZIP para o servidor (ex.: C:\wamp64\www\).
2. Criar uma BD vazia (utf8mb4) e importar database/gestao_ginasio.sql.
3. Colocar o nome da BD, utilizador e password em
   EasyGymPSI/common/config/main-local.php.
4. (Só se a pasta vendor não vier no ZIP) composer install.

## Endereços (ajustar ao caminho do servidor)
- Front-office: http://localhost/ProjetoEasyGymPSI/EasyGymPSI/frontend/web/
- Back-office:  http://localhost/ProjetoEasyGymPSI/EasyGymPSI/backend/web/

## Credenciais de acesso ao back-office
| Role        | Username | Password  | Estado  |
|-------------|----------|-----------|---------|
| Admin       | admin    | password  | Active  |
| Staff / PT  | rei1     | 12345678  | Active  |
| Client      | cliente2 | 123456789 | Active  |
| Client      | Ddinis   | 12345678  | Pending (não consegue entrar até o admin ativar) |

## Roles e permissões (RBAC)
- Admin: tudo, incluindo a gestão de utilizadores.
- Staff / PT: entra no back-office, sem gestão de utilizadores.
- Client: entra no back-office (portal do cliente).
- Pendente, Suspenso ou Inativo: não consegue iniciar sessão.

## Registo
Em Memberships (cliente) e Careers (funcionário) cria-se uma conta em estado
Pending, que o admin ativa em "Users and access".

## Fase 1 - implementado
RBAC, registo integrado no RBAC, gestão de utilizadores com soft delete
(Deactivate/Activate/Delete), página de detalhe do utilizador (View), AdminLTE no back-office com menu por role,
template do front-office.

## Notas
- O envio de emails grava em ficheiro (frontend/runtime/mail).
- Delete = soft delete (estado 0): a linha fica na BD.