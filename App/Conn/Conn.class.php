<?php

/**
 * Conn.class { CONEXÃO }
 * Classe responsável por fazer conexão com o banco de dados
 * Classe responsável por fazer operações no banco com o método CRUD (Create, Read, Update e Delete)
 *
 * @copyright (c) 2022, Julio Ferro
 */

class Conn
{

    /**
     * Host de conexão com o banco de dados
     * @var string
     */
    const HOST = 'localhost';

    /**
     * Nome do banco de dados
     * @var string
     */
    const NAME = 'espro';

    /**
     * Usuário do banco
     * @var string
     */
    const USER = 'root';

    /**
     * Senha de acesso ao banco de dados
     * @var string
     */
    const PASS = '';

    /**
     * Nome da tabela a ser manipulada
     * @var string
     */
    private $table;

    /**
     * Instancia de conexão com o banco de dados
     * @var PDO
     */
    private $connection;

    /**
     * Define a tabela e instância e conexão
     * @param string $table
     */
    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * Método responsável por criar uma conexão com o banco de dados
     */
    private function setConnection()
    {
        try {
            $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    /**
     * Método responsável por executar queries dentro do banco de dados
     * @param  string $query
     * @param  array  $params
     * @return PDOStatement
     */
    public function execute($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    /**
     * Método responsável por inserir dados no banco
     * @param  array $values [ field => value ]
     * @return integer ID inserido
     */
    public function ExeCreate($values)
    {
        //DADOS DA QUERY
        $fields = array_keys($values);
        $binds  = array_pad([], count($fields), '?');

        //MONTA A QUERY
        $query = 'INSERT INTO ' . $this->table . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';

        //EXECUTA O INSERT
        $this->execute($query, array_values($values));

        //RETORNA O ID INSERIDO
        return $this->connection->lastInsertId();
    }

    /**
     * Método responsável por executar uma consulta no banco
     * @param  string $where
     * @param  string $order
     * @param  string $limit
     * @param  string $fields
     * @return PDOStatement
     */
    public function ExeRead($where = null, $order = null, $limit = null, $fields = '*')
    {
        //DADOS DA QUERY
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        //MONTA A QUERY
        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

        //EXECUTA A QUERY
        return $this->execute($query);
    }

    /**
     * Método responsável por executar atualizações no banco de dados
     * @param  string $where
     * @param  array $values [ field => value ]
     * @return boolean
     */
    public function ExeUpdate($where, $values)
    {
        //DADOS DA QUERY
        $fields = array_keys($values);

        //MONTA A QUERY
        $query = 'UPDATE ' . $this->table . ' SET ' . implode('=?,', $fields) . '=? WHERE ' . $where;

        //EXECUTAR A QUERY
        $this->execute($query, array_values($values));

        //RETORNA SUCESSO
        return true;
    }

    /**
     * Método responsável por deletar (logicamente) dados do banco
     * @param  string $where
     * @param  array $values [ field => value ]
     * @return boolean
     */
    public function ExeDelete($where, $values)
    {
        //DADOS DA QUERY
        $fields = array_keys($values);

        //MONTA A QUERY
        $query = 'UPDATE ' . $this->table . ' SET ' . implode('=?,', $fields) . '=? WHERE ' . $where;

        //EXECUTAR A QUERY
        $this->execute($query, array_values($values));

        //RETORNA SUCESSO
        return true;
    }

    /**
     * Método responsável por retornar o número do id a ser inserido
     * @param string $table
     * @param string $fields
     * @return PDOStatement
     */
    public function ExeLastId($table, $fields)
    {

        //MONTA A QUERY
        $query = 'SELECT ' . $fields . ' FROM ' . $table . ' ' . ' WHERE table_name = "' . $this->table . '" AND table_schema = "' . self::NAME . '"';

        //EXECUTA A QUERY
        return $this->execute($query);
    }
}
