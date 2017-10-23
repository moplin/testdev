**NOTAS**  
- Ver conf para configuraciones de Apache  
- para actualizar hosts: C:\Windows\System32\drivers\etc\hosts 


# Installing Xdebug for XAMPP with PHP 7.x

## Requirements

* XAMPP for Windows: https://www.apachefriends.org/download.html

## Setup

* Download Xdebug for:
  * PHP 7.0.x: https://xdebug.org/files/php_xdebug-2.5.5-7.0-vc14.dll
  * PHP 7.1.x: https://xdebug.org/files/php_xdebug-2.5.5-7.1-vc14.dll
  
* Copy file `php_xdebug-2.5.5-7.1-vc14.dll` to: `C:\xampp\php\ext`

* Open file with Notepad++: `C:\xampp\php\php.ini`

* Disable output buffering: `output_buffering = Off`

* Scroll down to the `[XDebug]` section and copy this lines:

```ini
[XDebug]
zend_extension = "c:\xampp\php\ext\php_xdebug-2.5.5-7.1-vc14.dll"
xdebug.remote_autostart = 1
xdebug.profiler_append = 0
xdebug.profiler_enable = 0
xdebug.profiler_enable_trigger = 0
xdebug.profiler_output_dir = "c:\xampp\tmp"
;xdebug.profiler_output_name = "cachegrind.out.%t-%s"
xdebug.remote_enable = 1
xdebug.remote_handler = "dbgp"
xdebug.remote_host = "127.0.0.1"
xdebug.remote_log="c:\xampp\tmp\xdebug.txt"
xdebug.remote_port = 9000
xdebug.trace_output_dir = "c:\xampp\tmp"
; 3600 (1 hour), 36000 = 10h
xdebug.remote_cookie_expire_time = 36000
```

* Stop/Start Apache
