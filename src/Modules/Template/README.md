# MicxTemplate

## Template Inheritance (<file>.html)

main.html
```
<html>
    <head>
        <title><slot:title>Default Value to show</slot></title>
    </head>
    <body>
        <slot></slot>
    </body>
</html>
```


page.html
```
<extends name="main">
    <with:title>Dies ist ein Titel</with:title>
    <h1>Dies ist Header</h1>
    <p> Content </p>
</extends>
```

## Markdown Templates (<file>.md)

See [Markdown Documentation](https://michelf.ca/projects/php-markdown/extra/)

```
---
extends: main.html
title: Welcome to this site
---

# Welcome

This is some code

<div class="" markdown="1">
This is *embedded*
Markdown Text
</div>
```