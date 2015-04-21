<?php

/**
 * Class Skeleton
 *
 * Данный класс является точкой входа в компонент
 */
class Skeleton extends Admin_Controller {

    /**
     * Подключаем модель работы с базой данных
     */
    public function _before()
    {
        $this->load->model('component/'.strtolower(__CLASS__).'/database', __CLASS__.'DB');
    }

    /**
     * Главная страница компонента
     */
    public function index()
    {
        $this->load->view('backend/template/layout', array(
            /*
             * По умолчанию во всех методах должны быть активированы следующие стили и скрипты
             * 'css' => $this->asset->css(array('uikit.min', 'style')),
             * 'js' => $this->asset->js(array('jquery.min', 'uikit.min', 'moment'),
             */
            'css' => $this->asset->css(array(/*...подключаем необходимые стили...*/)),
            'js' => $this->asset->js(array(/*...подключаем необходимые скрипты...*/)),
            'content' => $this->load->view('backend/dashboard', array(
                'component_menu' => $this->component->get_navigation(), // формируем  навигационное меню
                'component' => $this->component->run(strtolower(__CLASS__)) // запускаем компонент
            ), true)
        ));
    }

    /**
     * Установка комонента
     */
    public function setup()
    {
        if($this->component->status(strtolower(__CLASS__)) != 1) // Проверка установлен ли компонет
        {
            $this->load->view('backend/template/layout', array(
                'css' => $this->asset->css(array(/*...подключаем необходимые стили...*/)),
                'js' => $this->asset->js(array(/*...подключаем необходимые скрипты...*/)),
                'content' => $this->load->view('backend/dashboard', array(
                    'component_menu' => $this->component->get_navigation(),
                    'component' => $this->component->run(strtolower(__CLASS__), 'setup') // Инициализируем установку
                ), true)
            ));
        }

        redirect('admin/components/'.strtolower(__CLASS__));
    }
}