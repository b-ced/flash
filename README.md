# flash
Display flash messages 


**Use :**

```php
$flash = new Flash(TRUE);
$flash->info('Some text with a <a href="#">link</a>');
$flash->success('Some text again');
$flash->error('Line with long text just to try it out !');
$flash->warn(['Some text', 'Some more text']);
$flash->normal(['The normal one']);
$flash->custom(['line 1', 'line 2', 'line 3']);
```
