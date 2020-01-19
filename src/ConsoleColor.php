<?php

/**
 * Мой маленький хелпер по работе с коммандной строкой
 * выводит цветастый текст в коммандную строку
 *
 */

namespace w1575\ConsoleColor;

class ConsoleColor
{
    /**
     * Срдержит массив с цветами для самого текста и для фона
     *
     * @var [type]
     */
    protected const COLORS = [
      'text' => [
        'Black'=>	'0;30',
        'Dark Grey'=>	'1;30',
        'Red'=>	'0;31',
        'Light Red'=>	'1;31',
        'Green'=>	'0;32',
        'Light Green'=>	'1;32',
        'Brown'=>	'0;33',
        'Yellow'=>	'1;33',
        'Blue'=>	'0;34',
        'Light Blue'=>	'1;34',
        'Magenta'=>	'0;35',
        'Light Magenta'=>	'1;35',
        'Cyan'=>	'0;36',
        'Light Cyan'=>	'1;36',
        'Light Grey'=>	'0;37',
        'White'=>	'1;37',
      ],
      'bg' => [
        'Black' => 40,
        'Red' => 41,
        'Green' => 42,
        'Yellow' => 43,
        'Blue' => 44,
        'Magenta' => 45,
        'Cyan' => 46,
        'Light Grey' => 47,
      ]
    ];

    /**
     * Максимальная длинна линнии текста
     * если переданный для отображения текст будет привышать данное значение,
     * значит он будет перенесен на отдельные строки
     * @var [type]
     */
    protected $lineWidth = 100;

    /**
     * Тема, которую будет использовать класс
     * @var [type]
     */
    protected $theme = 'default';

    /**
     * Значение фона для заголовка
     * @var [type]
     */
    private $titleBg;

    /**
     * Цвет текста заголовка
     * @var [type]
     */
    private $titleColor;

    /**
     * Цвет фона обычного текста
     * @var [type]
     */
    private $regularBg;

    /**
     * Цвет обычного текста
     * @var [type]
     */
    private $regularColor;

    /**
     * Цвет фона успешного сообщения. успешное сообщение лол
     * @var [type]
     */
    private $successBg;

    /**
     * Цвет успешного сообщения
     * @var [type]
     */
    private $successColor;

    /**
     * Цвет фона информационного сообщения
     * @var [type]
     */
    private $infoBg;

    /**
     * Цвет информационного сообщения
     * @var [type]
     */
    private $infoColor;

    /**
     * Цвет фона предупреждения
     * @var [type]
     */
    private $warningBg;

    /**
     * Цвет предупреждения
     * @var [type]
     */
    private $warningColor;

    /**
     * Цвет фона КРУПНОГО :) предупреждения
     * @var [type]
     */
    private $dangerBg;

    /**
     * Цвет КРУПНОГО :) предупреждения
     * @var [type]
     */
    private $dangerColor;

    /**
     * Цвет фона разделительной линии
     * @var [type]
     */
    private $lineBg;

    /**
     * Цвет разделительной линии
     * @var [type]
     */
    private $lineColor;

    /**
     * Внезапно конструктор
     * @param [type] $params [description]
     */
    public function __construct(string $theme=null, int $lineWidth = null)
    {
        $this->lineWidth = $lineWidth ?? $this->lineWidth;
        $this->theme = $theme ?? $this->theme;
        $this->setTheme();
    }

    /**
     * Устанавливает цвета, в соответствии с выбранной темой
     *
     */
    private function setTheme():void
    {
        switch ($this->theme) {

          case 'invert':
              $this->titleBg = $this->getBackgroundColor('Light Grey');
              $this->titleColor = $this->getTextColor('Black');
              $this->regularBg = $this->getBackgroundColor('Light Grey');
              $this->regularColor = $this->getTextColor('Black');
              $this->successBg = $this->getBackgroundColor('Green');
              $this->successColor = $this->getTextColor('White');
              $this->infoBg = $this->getBackgroundColor('Blue');
              $this->infoColor = $this->getTextColor('White');
              $this->warningBg = $this->getBackgroundColor('Yellow');
              $this->warningColor = $this->getTextColor('Black');
              $this->dangerBg = $this->getBackgroundColor('Red');
              $this->dangerColor = $this->getTextColor('White');
              $this->lineBg = $this->getBackgroundColor('Light Grey');
              $this->lineColor = $this->getTextColor('Black');
            break;

          default:
              $this->titleBg = $this->getBackgroundColor('Black');
              $this->titleColor = $this->getTextColor('Light Magenta');
              $this->regularBg = $this->getBackgroundColor('Black');
              $this->regularColor = $this->getTextColor('Light Grey');
              $this->successBg = $this->getBackgroundColor('Black');
              $this->successColor = $this->getTextColor('Light Green');
              $this->infoBg = $this->getBackgroundColor('Black');
              $this->infoColor = $this->getTextColor('Light Cyan');
              $this->warningBg = $this->getBackgroundColor('Black');
              $this->warningColor = $this->getTextColor('Yellow');
              $this->dangerBg = $this->getBackgroundColor('Black');
              $this->dangerColor = $this->getTextColor('Light Red');
              $this->lineBg = $this->getBackgroundColor('Black');
              $this->lineColor = $this->getTextColor('Dark Grey');
            break;
        }
    }


    /**
     * Возвращает код выбранного цвета для текста
     * @return string [description]
     */
    protected function getTextColor(string $colorName):string
    {
        return
          isset($this::COLORS['text'][$colorName])
          ? $this::COLORS['text'][$colorName]
          : $this::COLORS['text']['Black']
        ;
    }

    /**
     * Возвращает код выбранного цвета фона
     * @param  string $colorName название фона
     * @return integer           код фона
     */
    protected function getBackgroundColor(string $colorName):int
    {
        return
          isset($this::COLORS['bg'][$colorName])
          ? $this::COLORS['bg'][$colorName]
          : $this::COLORS['bg']['Black']
        ;
    }

    /**
     * Отображает все возможные цветовые варианты
     * @param [type] $text [description]
     */
    public function showAll($text):void
    {
        foreach ($this::COLORS['bg'] as $bgKey => $bgValue) {
          foreach ($this::COLORS['text'] as $key => $value) {
            echo "\e[$value;" . $bgValue ."m$bgKey - $key\e[0m" . PHP_EOL;
          }
        }
    }

    /**
     * Непосредственно вывод строки в консоль
     * @return [type] [description]
     */
    private function echoColor($text, string $type)
    {
        echo "\e[" . $this->{$type."Color"} . ";" . $this->{$type."Bg"} ."m{$text}\e[0m";
    }

    /**
     * Предворительная работа со строкой: обрезка / заполнение пробелами (при
     * условии, что длина строки меньше, а у нас выбрана тема, в которой есть фон)
     * дабы все смотрелось красиво и вывод строки
     *
     * @param mixed  $text текст, который стоит отобразить
     * @param string $type тип сообщения
     */
    private function show($text, string $type):void
    {

        $maxLength = $this->lineWidth - 2;
        // -2 пробела начала строки

        while (\mb_strlen($text) > $maxLength) {
          // пока у нас в строке есть символы, которые не помещаются
          // вырезаем столько символов, сколько можно показать
          // и показываем их
          $this->echoColor(' ', $type);
          $this->echoColor(' ', $type);

          $this->echoColor(mb_substr($text, 0, $maxLength), $type);
          $text = mb_substr($text, $maxLength);

          $this->echoColor(' ', $type);
          $this->echoColor(' ', $type);

          // вырезаем оставшуюся часть строки
          echo PHP_EOL;
        }

        $this->echoColor(' ', $type);
        $this->echoColor(' ', $type);

        $this->echoColor($text, $type);
        $emptyLine = '';
        $symbolsRemains = $maxLength - mb_strlen($text);
        for ($i=0; $i < $symbolsRemains; $i++) {
          $emptyLine .= ' ';
          //$this->echoColor(' ', $type);
        }
        $this->echoColor($emptyLine, $type);

        $this->echoColor(' ', $type);
        $this->echoColor(' ', $type);

    }

    /**
     * Тек
     * @param [type] $a [description]
     */
    public function title($text):void
    {
        echo PHP_EOL;
        $this->line('=');
        $this->show(\mb_strtoupper($text), 'title');
        echo PHP_EOL;
        $this->line('=');

    }

    /**
     * Обычное сообщение
     * @param mixed $text [description]
     */
    public function text($text):void
    {
        $this->show($text, 'regular');
        echo PHP_EOL;
    }

    /**
     * Успешное :) сообщение
     * @param mixed $text [description]
     */
    public function success($text):void
    {
        $this->show($text, 'success');
        echo PHP_EOL;
    }

    /**
     * Информационное сообщение
     * @param mixed $text [description]
     */
    public function info($text):void
    {
        $this->show($text, 'info');
        echo PHP_EOL;
    }

    /**
     * Отображение предупреждения
     * @param mixed $text [description]
     */
    public function warning($text):void
    {
        $this->show($text, 'warning');
        echo PHP_EOL;
    }

    /**
     * Отображение сообщения об ошибке
     * @param mixed $text [description]
     */
    public function danger($text):void
    {
        $this->show($text, 'danger');
        echo PHP_EOL;
    }

    /**
     * Отображение линии
     * @param mixed $text [description]
     */
    public function line($line = '-'):void
    {
        $showLine = '';
        while (\mb_strlen($showLine) < $this->lineWidth-2) {
          $showLine .= $line;
        }

        $this->show($showLine, 'line');
        echo PHP_EOL;
    }
}
