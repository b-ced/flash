# Flash
Display flash messages in your app

## Requirements
You need PHP8 to run this code

## Use

**To get started, just call the class and try it out**  
```
$flash = new Flash();
```

**Optional : you can add a boolean parameter; if set to TRUE (this is the default state), the script will show a nice icon**

Icons used here come from FontAwesome
```
$flash = new Flash(TRUE/FALSE);
```

**Examples :**

```php
$flash = new Flash();
$flash->info('Some text with a <a href="#">link</a>');
$flash->success('Some text again');
$flash->error('Line with long text just to try it out !');
$flash->warn(['Some text', 'Some more text']);
$flash->normal(['The normal one']);
$flash->custom(['line 1', 'line 2', 'line 3']);
```




**Result :**

![Screen Class Flash](Class_Flash_screen.png)
