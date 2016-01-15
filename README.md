Form Parser
===========

A simple utility to read a form template and pull out 
information useful to validators and from verifiers.

**Not Yet - Installation
------------
```bash
// $ composer require laverboy/form-parser
```

Usage
-----------
```php
<?php

use FormParser\FormParser;

// read a new template
$fp = new FormParser('../contact-form.php');

// check for the existence of a field
$fp->inputExists('firstname'); // returns true or false

// find all the required fields
$fp->getRequiredFields(); // returns ['firstname', 'lastname', 'email'];

// find all the email fields
$fp->getEmailFields(); // returns array

// find all the labels (labels need to have a 'for' attribute)
$fp->getLabels(); // returns array 
```

Todo
----

* test with php generated forms
* test labels with array named fields
