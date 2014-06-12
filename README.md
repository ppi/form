form
====

### Creating Elements

To create elements, you access the appropriate method for that element type. Alternatively you can use the underlying ``add()`` method which these ``text`` and ``password`` methods proxy to.

``` php
<?php
$form = new Form();
$form->text('username')

$form->password('password');
$form->password('confirm_password');

$form->submit('submit_button', 'Click to Continue');
```

### Getting Elements
``` php
<?php
$form = new Form();
// ... add elements

$usernameElement = $form->getElement('username');
$passwordElement = $form->getElement('confirm_password');

```

### Rendering Elements

Each element object has a ``__toString()`` method aliased to ``render()`` so you can just echo the objects to render them

``` php
<?php
// Controller Code
$form = new Form();
// ... add elements
return $this->render('....', compact('form'));
?>

<div class="username-container">
<?= $form->getElement('username'); ?>
</div>
```


### Binding Data To Your Form

When ``toArray()`` is called you will have a data key for ``username`` which will match the name of the text field added named ``username``.

``` php
<?php
$form = new Form();
$form->text('username');

$entity = new UserEntity($userHelper->getByID($userID));
$form->bind($entity->toArray());

echo $form->getElement('username');
```
