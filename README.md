form
====

### Binding Data To Your Form

When ``toArray()`` is called you will have a data key for ``username`` which will match the name of the text field added named ``username``.

``` php
<?php
$form = new Form();
$form->text('username');

$entity = new UserEntity($userHelper->getByID($userID));
$form->bind($entity->toArray());

echo $form->text('username');
```
