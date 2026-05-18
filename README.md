# Format Microsoft Protected Links TextFormatter module

Module for [ProcessWire CMS](https://www.processwire.com/)  
Copyright (c) 2026 Commonwealth of Australia

This module will format a textfield on output, replacing any [Microsoft Protected Links](https://learn.microsoft.com/en-us/defender-office-365/safe-links-about) with their original URL, preventing unintentional leaking of internal email addresses and other data.

If you instead would prefer to hook the page save and permenently update any protected links then you can use our companion module [FormatMicrosoftProtectedLinks](https://github.com/AustralianAntarcticDivision/FormatMicrosoftProtectedLinks).

## Requirements

- PHP 7.3+
- Processwire 3.X

## Installing

This module is installed just like any other ProcessWire module: copy or clone the directory containing this module to your /site/modules/ directory, log in, go to Admin > Modules, click "Check for new modules", and install "Replace Microsoft Protected Links" from the TextFormatter category.

## How to use

After installing this module, enable the "Replace Microsoft Protected Links" TextFormatter on any text/textarea fields required under the 'details' tab.