<?php

namespace intradarma\sweetalert2;

use Yii;
use yii\bootstrap\Widget;
use yii\helpers\Json;

/**
 * Alert widget renders a message from session flash or custom messages.
 * @package intradarma\sweetalert2
 */
class Alert extends Widget {

    //modal type
    const TYPE_INFO = 'info';
    const TYPE_ERROR = 'error';
    const TYPE_SUCCESS = 'success';
    const TYPE_WARNING = 'warning';
    const TYPE_QUESTION = 'question';
    //input type
    const INPUT_TYPE_TEXT = 'text';
    const INPUT_TYPE_EMAIL = 'email';
    const INPUT_TYPE_PASSWORD = 'password';
    const INPUT_TYPE_NUMBER = 'number';
    const INPUT_TYPE_TEL = 'tel';
    const INPUT_TYPE_RANGE = 'range';
    const INPUT_TYPE_TEXTAREA = 'textarea';
    const INPUT_TYPE_SELECT = 'select';
    const INPUT_TYPE_RADIO = 'radio';
    const INPUT_TYPE_CHECKBOX = 'checkbox';
    const INPUT_TYPE_FILE = 'file';
    const INPUT_TYPE_url = 'url';

    /**
     * All the flash messages stored for the session are displayed and removed from the session
     * Defaults to false.
     * @var bool
     */
    public $useSessionFlash = false;

    /**
     * @var string alert callback
     */
    public $callback = 'function() {}';

    /**
     * Initializes the widget
     */
    public function init() {
        parent::init();
        $this->registerAssets();
    }

    /**
     * @return string|void
     */
    public function run() {
        $view = $this->getView();
        if ($this->useSessionFlash) {
            $session = Yii::$app->getSession();
            $flashes = $session->getAllFlashes();

            $steps = [];
            foreach ($flashes as $type => $data) {
                $data = (array) $data;
                foreach ($data as $message) {
                    array_push($steps, ['type' => $type, 'text' => $message]);
                }
                $session->removeFlash($type);
            }
            $js = "swal.queue(" . Json::encode($steps) . ");";
            $view->registerJs($js, $view::POS_END);
        } else {
            $js = "swal({$this->getOptions()}).then({$this->callback}).catch(swal.noop);";
            $view->registerJs($js, $view::POS_END);
        }
    }

    /**
     * Register client assets
     */
    protected function registerAssets() {
        $view = $this->getView();
        SweetAlert2Asset::register($view);
    }

    /**
     * Get plugin options
     *
     * @return string
     */
    protected function getOptions() {
        unset($this->options['id']);
        return Json::encode($this->options);
    }

}
