<?php

/**
 * Class Setup
 *
 * Установка компонента
 */
class Setup extends CI_Model {

    protected $_table = 'skeleton'; // Название таблицы, возможно указание нескольких таблиц
    protected $_fields = array();

    /*
     * Если для компонента необходимо две или более таблицы, то необходимо это указать
     *
     * protected $_table = 'skeleton';
     * protected $_fields = array();
     * protected $_table_1 = 'skeleton_1';
     * protected $_fields_1 = array();
     *
     * и т.д.
     */

    /**
     * @param $component
     * @param bool $reinstall
     *
     * Создание необходимых таблиц и активация компонента
     */
    public function install($component, $reinstall = false)
    {
        /*
         * Если необходимо пересоздать таблицу, то вторым параметром указывается значение true
         *
         * WARNING: Все данные в таблице будет уничтожены
         * TODO: Сделать резервировнаие существующих данных
         */
        if($reinstall === true)
        {
            $this->dbforge->drop_table($this->_table);
        }

        /*
         * Пример таблицы для компонента
         * Подробнее о вариантах составления таблицы http://www.codeigniter.com/user_guide/database/forge.html
         */
        $this->_fields = array(
            'skeleton_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'skeleton_title' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
        );

        $this->dbforge->add_field($this->_fields);
        $this->dbforge->add_key('skeleton_id', TRUE);
        $this->dbforge->create_table($this->_table, true, array('ENGINE' => 'InnoDB'));

        /**
         * Активация компонента
         */
        $this->db->insert('components', array('name' => $component));
        log_message('info', 'Компонет '.$component.' успешно установлен.');
    }
}