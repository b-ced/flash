<?php
/**
 * Flash
 */
class Flash
{

    /**
     * template - template of the message
     * 
     * @var string
     */
    private $template = '<div class="flash flash_%s">%s<div>%s</div></div>';

    /**
     * useIcon - Use or not the icon
     *
     * @var bool
     */
    private $useIcon = TRUE;

    /**
     * iconDefault - default icon shown in case there is no  icon set for a specific message type
     * SVG icon is from FontAwesome
     * 
     * @var string
     */
    private $iconDefault = '<path fill="currentColor" d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 110c23.196 0 42 18.804 42 42s-18.804 42-42 42-42-18.804-42-42 18.804-42 42-42zm56 254c0 6.627-5.373 12-12 12h-88c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h12v-64h-12c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h64c6.627 0 12 5.373 12 12v100h12c6.627 0 12 5.373 12 12v24z"></path>';

    /**
     * icon<type> - icon files to customize Specific messages types
     * Fell free to modify the 6 types below
     * If no icon file is set, the iconDefault will be used instead
     * @var mixed
     */
    private $iconInfo;
    private $iconSuccess = '<path fill="currentColor" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path>';
    private $iconError = '<path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z"></path>';
    private $iconWarn = '<path fill="currentColor" d="M504 256c0 136.997-111.043 248-248 248S8 392.997 8 256C8 119.083 119.043 8 256 8s248 111.083 248 248zm-248 50c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z"></path>';
    private $iconNormal;
    private $iconCustom;


    public function __construct(bool $icon = TRUE)
    {
        $this->useIcon = $icon;
    }


    /**
     * info
     *
     * Prepares an informational message
     * 
     * @param  array|string $data
     * @return void
     */
    public function info(array|string $data): void
    {
        $this->sendFlash('info', $data);
    }


    /**
     * success
     *
     * Prepares a success message
     * 
     * @param  array|string $data
     * @return void
     */
    public function success(array|string $data): void
    {
        $this->sendFlash('success', $data);
    }
    /**
     * error
     *
     * Prepares an error message
     * 
     * @param  array|string $data
     * @return void
     */
    public function error(array|string $data): void
    {
        $this->sendFlash('error', $data);
    }


    /**
     * warn
     *
     * Prepares a warning message
     * 
     * @param  array|string $data
     * @return void
     */
    public function warn(array|string $data): void
    {
        $this->sendFlash('warn', $data);
    }


    /**
     * warn
     * 
     * Prepares a normal message
     * 
     * @param  array|string $data
     * @return void
     */
    public function normal(array|string $data): void
    {
        $this->sendFlash('normal', $data);
    }


    /**
     * custom
     *
     * Prepares a custom message
     * 
     * @param  array|string $data
     * @return void
     */
    public function custom(array|string $data): void
    {
        $this->sendFlash('custom', $data);
    }

    /**
     * sendFlash
     *
     * The function that sends the message
     * 
     * @param  string $type
     * @param  array|string $data Can be string or array, array will generate multiple lines of text
     * @param  string $icon
     * @return void
     */
    private function sendFlash(string $type, array|string $data, string $icon = ''): void
    {

        if ($this->useIcon) {
            $iconFile = 'icon' . ucfirst($type);
            $iconFile = isset($this->$iconFile) ? $this->$iconFile : $this->iconDefault;
            $icon = sprintf('<div class="flash_icon"><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">%s</svg></div>', $iconFile);
        }

        if (is_array($data)) {
            $data = '<p>' . implode('</p><p>', $data) . '</p>';
        }
        printf($this->template, $type, $icon, $data);
    }
}
