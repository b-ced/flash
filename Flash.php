<style>
    @import url('https://fonts.googleapis.com/css2?family=Athiti:wght@500&display=swap');

    body {
        font-family: 'Athiti', sans-serif;
    }

    .flash_info,
    .flash_success,
    .flash_error,
    .flash_warn,
    .flash_normal,
    .flash_custom {
        padding: 10px;
        margin: 10px;
        background-color: rgb(242, 247, 242);
        border-radius: 5px;
        display: flex;
        align-items: center;
    }

    p {
        margin: 0;
    }

    .flash_icon {
        width: 10px;
        height: 26px;
        margin: 0 10px 0 0;
    }

    .flash_info {
        border: 2px solid rgb(81, 113, 165);
        color: rgb(81, 113, 165);
    }

    .flash_success {
        border: 2px solid rgb(76, 149, 108);
        color: rgb(76, 149, 108);
    }

    .flash_error {
        border: 2px solid rgb(223, 41, 53);
        color: rgb(223, 41, 53);
    }

    .flash_warn {
        border: 2px solid rgb(223, 90, 0);
        color: rgb(223, 90, 0);
    }

    .flash_normal {
        border: 2px solid rgb(0, 0, 0);
        color: rgb(0, 0, 0);
    }

    .flash_custom {
        border: 2px solid rgb(89, 46, 1310);
        color: rgb(89, 46, 131);
    }
</style>

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
    private $template = '<div class="flash_%s">%s<div>%s</div></div>';

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
    private $iconDefault = '<svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path fill="currentColor" d="M176 432c0 44.112-35.888 80-80 80s-80-35.888-80-80 35.888-80 80-80 80 35.888 80 80zM25.26 25.199l13.6 272C39.499 309.972 50.041 320 62.83 320h66.34c12.789 0 23.331-10.028 23.97-22.801l13.6-272C167.425 11.49 156.496 0 142.77 0H49.23C35.504 0 24.575 11.49 25.26 25.199z"></path></svg>';

    /**
     * icon<type> - icon files to customize Specific messages types
     *
     * @var mixed
     */
    private $iconInfo;
    private $iconSuccess;
    private $iconError;
    private $iconWarn;
    private $iconNormal;
    private $iconCustom;

    public function __construct(bool $icon)
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
     * setIconFile
     *
     * Function tu change the icon file for a given type
     * 
     * @param  string $type
     * @param  string $data
     * @return void
     */
    public function setIconFile(string $type, string $data): void
    {
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
            $icon = sprintf('<div class="flash_icon">%s</div>', $iconFile);
        }

        if (is_array($data)) {
            $data = '<p>' . implode('</p><p>', $data) . '</p>';
        }
        printf($this->template, $type, $icon, $data);
    }
}


$flash = new Flash(TRUE);
$flash->info('texte');
$flash->success('texte');
$flash->error('Line with long text just to try it out !');
$flash->warn(['texte', 'texte']);
$flash->normal(['texte']);
$flash->custom(['line 1', 'line 2', 'line 3']);
