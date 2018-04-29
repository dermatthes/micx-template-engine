# MicxTemplate

## Template Inheritance

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